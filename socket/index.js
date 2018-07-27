var fs = require('fs'),
    express = require('express'),
    socketio = require('socket.io'),
    ioRedis = require('ioredis');
    config = require('./config');


var serverPort = config.socket.port || 6001, // Listen port
    secure = config.socket.secure || false; // use HTTPS/SSL

var app = express();

if (secure)
{
    var options = {
        key: fs.readFileSync(config.socket.secure_key),
        cert: fs.readFileSync(config.socket.secure_cert)
    };
    var server = require('https').createServer(options, app);
} else
{
    var server = require('http').createServer(app);
}

server.listen(serverPort, function() {
    var addr = server.address();
    console.log('   app listening on ' + (secure ? 'https://' : 'http://') + addr.address + ':' + addr.port);
});


var io = socketio(server);
var redis = new ioRedis(config.redis);

io.on('connection', function (socket) {
   console.log('New connection:', socket.id);
});

redis.psubscribe('*', function(err, count) {
    console.log('Subscribed');
    console.log(count);
});

redis.on('pmessage', function(subscribed, channel, data) {
    data = JSON.parse(data);
    console.log(new Date);
    console.log(data);
    console.log(channel);

    io.emit(channel + ':' + data.event, data.data);
});
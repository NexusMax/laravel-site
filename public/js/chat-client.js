let extraMode = false;

$(document).ready(function () {

    initChat();

    $('#message').keydown(function (e) {
        // Enter was pressed without shift key
        if (e.keyCode == 13 && !e.shiftKey) {
            // prevent default behavior
            e.preventDefault();
            sendMessage();

        }
    });

    $('.emoji-wysiwyg-editor').keydown(function (e) {
        // Enter was pressed without shift key
        if (e.keyCode == 13 && !e.shiftKey) {
            // prevent default behavior
            e.preventDefault();
            sendMessage();

        }
    });

    // Listen socket and update chat
    socket.on("private-chat:App\\Events\\ChatMessageSentEvent", function (data) {
        console.log(data);
        if (data.user_id != user) {
            appendMessage(data);

        } else {
            if (!isMessageDelivered(data)) {
                appendSelfMessage(data);
            }
        }

        updateScroll();
    });


    // Ban user from chat
    socket.on("private-chat:App\\Events\\ChatUserBanEvent", function (data) {
        if (user == data.user_id) {
            $('#send').attr("style", "cursor:not-allowed!important");
            $('#message').attr("disabled", true);
            $('.chat-body').append(
                '<div class="chat-info"><p>Модератор <span>запретил</span> вам писать в этот чат :(</p></div>'
            );

            updateScroll();
        }

    });

    // Delete message from chat
    socket.on("private-chat:App\\Events\\ChatMessageDeleteEvent", function (data) {
        deleteMessage(data);
    });

    function deleteMessage(data) {
        $('.chat-body').find('.chat-user-row').each(function () {
            if ($(this).attr('data-hash') == data.message_id) {
                $(this).remove();
            }
        })
    }


    // Send new message to chat
    $('#send').click(function () {
        sendMessage();
    });

    function sendMessage() {
        let text = $('#message').val();
        if (text !== '') {
            let id = MD5(user + text + Date.now());

            pushData('/learner/chat/send', {message: text, id: id, chat_id:chatId});
            appendSelfMessage({message: text, message_id: id});

            $('#message').val('');
            $('.emoji-wysiwyg-editor').text('');
        }
    }

    function isMessageDelivered(data) {
        let hash = data.message_id;
        let result = false;

        $(".chat-body").find(".chat-user-row").each(function (index) {
            if ($(this).attr('data-hash') == hash) {
                result = true;
            }
        });

        return result;
    }

    function appendMessage(data) {

        data.message = emojione.shortnameToUnicode(data.message);

        let role = 'users';

        if (data.user_role == 1) {
            role = 'admin';
        }

        let additions = '';

        if (extraMode) {
            additions = getAdditionalElements(data);
        }

        let time = getMessageTime(data);
        let avatar = '<div class="chat-img"><img src="' + data.user_avatar + '" alt=""></div>';
        let heading = '<div class="chat-heading"><span class="user-name">' + data.username + '</span><span class="time">' + time + '</span></div>';
        let msg = '<p class="message">' + data.message + '</p>';

        $('.chat-body').append(
            '<div class="chat-user-row ' + role + '" data-hash="' + data.message_id + '">' + avatar + '<div class="chat-message">' + heading + msg + additions + '</div></div>'
        );

        if (extraMode) {
            registerAdditionEvents(data);
        }


    }

    function appendSelfMessage(data) {
        data.message = emojione.shortnameToUnicode(data.message);

        $('.chat-body').append(
            '<div class="chat-user-row you" data-hash="' + data.message_id + '"><div class="chat-message"><p class="message">' + data.message + '</p></div></div>'
        )
    }

    function updateScroll() {
        $container = $('.chat-body');
        $container.animate({scrollTop: $container[0].scrollHeight}, "slow");
    }

    function initChat() {
        $container = $('.chat-body');
        $container[0].scrollTop = $container[0].scrollHeight;

        if (typeof getAdditionalElements !== "undefined" &&
            typeof registerAdditionEvents !== "undefined") {
            extraMode = true;
        }

        convert();
    }

    function getMessageTime(data) {
        let date = new Date(data.ts * 1000);
        let hours = date.getHours();
        let minutes = "0" + date.getMinutes();
        let seconds = "0" + date.getSeconds();

        let formattedTime = hours + ':' + minutes.substr(-2);

        return formattedTime;
    }

    function convert() {
        let messages = document.getElementsByClassName('message');

        $('.message').each(function (index) {
            let msgText = $(this).text();
            $(this).text(emojione.shortnameToUnicode(msgText));
        });

    }



});
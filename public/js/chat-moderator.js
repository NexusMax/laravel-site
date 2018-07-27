let deleteFromChat = function () {
    let messageId = $(this).attr('chat');

    if (confirm('Вы точно хотитие удалить сообщение?')) {
        pushData('/learner/chat/delete', {id: messageId,chat_id:chatId});
        console.log('delete: ' + messageId);
    }
};

let banFromChat = function () {

    let userId = $(this).attr('user');

    if (confirm('Вы точно хотитие ограничить пользователю возможность писать в чат?')) {
        pushData('/learner/chat/ban', {id: userId,chat_id:chatId});
        console.log('ban: ' + userId);
    }
};


function getAdditionalElements(data) {
    let deleteLink = '<span id="delete-' + data.message_id + '" class="moderator-btn" chat="' + data.message_id + '">удалить</span>';
    let banLink = '<span id="ban-' + data.message_id + '" class="moderator-btn" user="' + data.user_id + '">бан</span>'
    return deleteLink + '&nbsp;' + banLink;
}

function registerAdditionEvents(data) {
    $('#ban-' + data.message_id).click(banFromChat);
    $('#delete-' + data.message_id).click(deleteFromChat);
}


// For message history deletion from
$('.ban').click(banFromChat);
$('.delete').click(deleteFromChat);





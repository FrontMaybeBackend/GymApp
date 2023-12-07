//Przekazanie danych po kliknęciu w div z wiadomościa do formularza
document.addEventListener('DOMContentLoaded', function () {
    let messageDivs = document.querySelectorAll('.message');
    let formMessagesDiv = document.querySelector('#formMessages');
    let toUserInput = document.querySelector('input[name="toUser"]');
    let titleInput = document.querySelector('input[name="title"]');

    messageDivs.forEach(function (messageDiv) {
        messageDiv.addEventListener('click', function () {
            let userData = JSON.parse(messageDiv.getAttribute('data-user'));

            toUserInput.value = userData.toUser;
            titleInput.value = userData.title;

            let h6 = formMessagesDiv.querySelector('h6');
            let h5 = formMessagesDiv.querySelector('h5');
            let textarea = formMessagesDiv.querySelector('textarea');

            h6.textContent = "Username: " + userData.toUser;
            h5.textContent = "Title: " + userData.title;
            textarea.textContent = "Description: " + userData.description;

        });
    });
});


let send = document.getElementById('send').addEventListener('click', showSendMessages);
let inbox = document.getElementById('inbox').addEventListener('click', showMessages);

function showSendMessages() {
    document.getElementById('leftDiv').hidden = true;
    document.getElementById('myMessages').hidden = false;
    document.getElementById('sendDiv').hidden = true;
}

function showMessages() {
    document.getElementById('myMessages').hidden = true;
    document.getElementById('leftDiv').hidden = false;
    document.getElementById('sendDiv').hidden = false;
}



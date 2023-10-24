document.addEventListener('DOMContentLoaded', function () {
    let messageDivs = document.querySelectorAll('.message');
    let testDiv = document.querySelector('#test');
    let toUserInput = document.querySelector('input[name="toUser"]');
    let titleInput = document.querySelector('input[name="title"]');

    messageDivs.forEach(function (messageDiv) {
        messageDiv.addEventListener('click', function () {
            let userData = JSON.parse(messageDiv.getAttribute('data-user'));

            toUserInput.value = userData.fromUser;
            titleInput.value = userData.title;

            let h6 = testDiv.querySelector('h6');
            let h5 = testDiv.querySelector('h5');
            let textarea = testDiv.querySelector('textarea');

            h6.textContent = "Username: " + userData.fromUser;
            h5.textContent = "Title: " + userData.title;
            textarea.textContent = "Description: " + userData.description;
        });
    });
});


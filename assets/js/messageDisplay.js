document.addEventListener('DOMContentLoaded', function () {
    let messageDivs = document.querySelectorAll('.message'); // Znajdź wszystkie elementy o klasie "message"
    let testDiv = document.querySelector('#test'); // Znajdź div o id "test"
    console.log('Skrypt został załadowany.');

    messageDivs.forEach(function (messageDiv) {
        messageDiv.addEventListener('click', function () {
            let userData = JSON.parse(messageDiv.getAttribute('data-user'));

            // Znajdź istniejące elementy h6, h5,p,span i h4 w divie "test"
            let testDiv = document.getElementById('test');
            let h6 = testDiv.querySelector('h6');
            let h5 = testDiv.querySelector('h5');
            let h4 = testDiv.querySelector('h4');
            let p = testDiv.querySelector("p");
            let span = testDiv.querySelector('span');


            h6.textContent =  "Username: "  + userData.fromUser;
            h5.textContent = "Title: " + userData.title;
            h4.textContent = "Description: " +  userData.description;

            let usernameLabel = testDiv.querySelector('label[for="toUser"]');
            let titleLabel = testDiv.querySelector('label[for="title"]');
            usernameLabel.textContent = "Username: " + userData.fromUser;
            titleLabel.textContent = "Title: " + userData.title;
        });
    });
});

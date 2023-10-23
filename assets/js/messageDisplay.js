document.addEventListener('DOMContentLoaded', function () {
    let messageDivs = document.querySelectorAll('.message'); // Znajdź wszystkie elementy o klasie "message"
    let testDiv = document.querySelector('#test'); // Znajdź div o id "test"
    console.log('Skrypt został załadowany.');

    messageDivs.forEach(function (messageDiv) {
        messageDiv.addEventListener('click', function () {
            let userData = JSON.parse(messageDiv.getAttribute('data-user'));

            // Znajdź istniejące elementy h6, h5 i h4 w divie "test"
            let h6 = testDiv.querySelector('h6');
            let h5 = testDiv.querySelector('h5');
            let h4 = testDiv.querySelector('h4');

            // Aktualizuj zawartość istniejących elementów h6, h5 i h4 z danymi użytkownika
            h6.textContent = userData.fromUser;
            h5.textContent = userData.title;
            h4.textContent = userData.description;
        });
    });
});

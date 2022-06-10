// module app
const app = {

    // méthode init() qui sera appelée au chargement de la page
    init: function() {

        // on initialise notre composant newItemForm
        newItemForm.init();

        // on initialise notre composant itemsList
        itemsList.init();
    }

};

// quand la page est chargée, l'event DOMContentLoaded est déclenché
document.addEventListener('DOMContentLoaded', app.init);

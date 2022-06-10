
const itemsList = {

    init: function() {
        itemsList.loadItemsFromAPI();
    },

    bindAllItemsEvents: function() {
        // appelant bindSingleTaskEvents sur chacune des tâches de la liste

        // on va commencer par récupérer toutes les éléments grace à leur classe .task
        const itemsList = document.querySelectorAll('.tasks .task');

        // on boucle sur l'ensemble des tâches récupérées
        for(const itemElement of itemsList) {
            // on appelle bindSingleItemEvents sur chaque élément de la liste de courses
            item.bindSingleItemEvents(itemElement);
        }
    }, 

    addItemToItemsList: function(newItemElement) {

        // on ajoute nos écouteurs d'évènements en appelant la méthode bindSingleItemEvents
        item.bindSingleItemEvents(newItemElement);

        // on récupère le div qui contient TOUTES les tâches
        const itemsList = document.querySelector('.tasks');
        // on ajoute notre fragment à ce div
        itemsList.prepend(newItemElement);
    },

    loadItemsFromAPI: function() {
       console.info("Chargement des éléments de la liste de courses depuis l'API ..."); 

       // On prépare la configuration de la requête HTTP
        let config = {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache'
        };

        // On déclenche la requête HTTP (via le moteur sous-jacent Ajax)
        fetch('api.php', config)
        // Ensuite, lorsqu'on reçoit la réponse au format JSON
        .then(function(response) {
            // On convertit cette réponse en un objet JS et on le retourne
            return response.json();
        })
        // Ce résultat au format JS est récupéré en argument ici-même
        .then(function(data) {
            console.log(data);

            // on parcourt le tableau
            for(const itemToAdd of data) {
                // on créé un nouvel élément
                const newItemElement = item.createNewItemElement(itemToAdd.name, itemToAdd.id);
                // on ajoute cet élément à la liste de courses
                itemsList.addItemToItemsList(newItemElement);
            }
            
        });
    }

}
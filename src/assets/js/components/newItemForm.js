
const newItemForm = {

    init: function() {
        // on récupère le formulaire
        const itemForm = document.querySelector('.task--add form');
        // on ajoute notre écouteur d'évènement
        itemForm.addEventListener('submit', newItemForm.handleNewItemFormSubmit);
    },

    handleNewItemFormSubmit: function(evt) {
        // on bloque le comportement par défaut du navigateur
        evt.preventDefault();

        // on récupère le formulaire avec currentTarget
        const newItemFormElement = evt.currentTarget;

        // on récupère le titre saisi par l'user
        const itemName = newItemFormElement.querySelector('.task__title-field').value;  

        // ------------------- REQUETE API -------------------

        // On stocke les données à transférer
        const data = {
            name: itemName,
        };
        
        // on converti sous la bonne forme
        // TODO : à virer si passage en JSON
        var formBody = [];
        for (var property in data) {
            var encodedKey = encodeURIComponent(property);
            var encodedValue = encodeURIComponent(data[property]);
            formBody.push(encodedKey + "=" + encodedValue);
        }
        formBody = formBody.join("&");

        // On prépare les entêtes HTTP (headers) de la requête
        // afin de spécifier que les données sont en JSON
        const httpHeaders = new Headers();
        httpHeaders.append("Content-Type", "application/x-www-form-urlencoded;charset=UTF-8");
        
        // On prépare les options de fetch
        const fetchOptions = {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            // On ajoute les headers dans les options
            headers: httpHeaders,
            // On ajoute les données, encodées en JSON, dans le corps de la requête
            //body: JSON.stringify(data)
            body: formBody
        };
        
        // Envoyer la requête HTTP avec FETCH
        fetch('api.php', fetchOptions)
        .then(
            function(response) {
                // console.log(response);
                // Si HTTP status code à 201 => OK
                if (response.status == 201) {
                    console.info('Élément ajouté à la liste de courses !');

                    // On convertit cette réponse en un objet JS et on le retourne
                    return response.json();
                }
                else {
                    console.error("Erreur lors de l'ajout d'un élément à la liste ...");

                    return null;
                }
            }
        )
        .then(function(data) {
            if(data !== null) {
                // ------------------- MODIFICATION DU DOM -------------------

                // on créé notre nouvelle tâche
                const newItemElement = item.createNewItemElement(data.name, data.id);
                // on l'ajoute à la liste
                itemsList.addItemToItemsList(newItemElement);        

                // si on veut vider le champ titre dans le formulaire
                newItemFormElement.querySelector('.task__title-field').value = '';
            }
        });
        
        
    }
}
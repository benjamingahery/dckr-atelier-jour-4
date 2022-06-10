
const item = {

    bindSingleItemEvents: function(itemElement) {
        // on récupère le titre de notre taskElement
        // const taskElementTitle = taskElement.querySelector('.task__title-label');
        // // on ajoute notre écouteur d'évènement sur le titre
        // taskElementTitle.addEventListener('click', task.handleEnableTaskTitleEditMode);

        // // on récupère le bouton de modification de notre taskElement
        // const taskElementModifyButton = taskElement.querySelector('.task__button--modify');
        // // on ajoute notre écouteur d'évènement sur le clic du bouton
        // taskElementModifyButton.addEventListener('click', task.handleEnableTaskTitleEditMode);

        // // on récupère le boutun de validation d'une tâche (pour indiquer qu'elle est complète)
        // const taskElementValidateButton = taskElement.querySelector('.task__button--validate');
        // // on ajoute notre écouteur d'évènement sur le clic de ce bouton
        // taskElementValidateButton.addEventListener('click', task.handleCompleteTask);

        // // on récupère le boutun de réouverture d'une tâche (pour indiquer qu'elle est incomplète)
        // const taskElementReopenButton = taskElement.querySelector('.task__button--incomplete');
        // // on ajoute notre écouteur d'évènement sur le clic de ce bouton
        // taskElementReopenButton.addEventListener('click', task.handleIncompleteTask);

        // // on récupère le champ titre qui a la classe task__title-field
        // const taskElementTitleField = taskElement.querySelector('.task__title-field');
        // // on ajoute un écouteur d'évènement sur la perte de focus du champ titre
        // taskElementTitleField.addEventListener('blur', task.handleValidateNewTaskTitle);
        // // on ajoute un écouteur d'évènement sur l'appui sur une touche dans le champ titre
        // taskElementTitleField.addEventListener('keydown', task.handleValideNewTaskTitleOnEnterKey);
    },

    createNewItemElement: function(itemTitle, itemId = 0) {
        // on récupère notre template
        const templateElement = document.querySelector("#taskTemplate");
        const itemFragment = templateElement.content.cloneNode(true);

        // on modifie le titre et l'ID
        item.updateItemTitle(itemFragment, itemTitle);
        item.setItemId(itemFragment, itemId);
        
      
        return itemFragment;        
    },

    setItemId: function(itemElement, itemId) {
        const itemElem = itemElement.querySelector('.task');
        itemElem.dataset.itemId = itemId;
    },

    updateItemTitle: function(itemElement, itemTitle) {
        // et le label de notre fragment
        const itemFragmentTitleLabel = itemElement.querySelector('.task__title-label');
        // on vient mettre à jour les valeurs
        itemFragmentTitleLabel.innerHTML = itemTitle;
    }
}
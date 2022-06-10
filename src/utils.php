<?php

function isShoppingListElementValid($element) {
    if(empty($element)) {
        // l'élément ne peut pas être vide
        return false;
    } else {
        return true;
    }
}
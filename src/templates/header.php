<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>O'ShoppingList</title>
  <link rel="stylesheet" href="assets/css/font-awesome.css" />
  <!-- L'intégration repose en partie sur le framework CSS Bulma :
    - Bulma propose uniquement des styles CSS
    - Bulma ne gère pas les interactions Javascript contrairement à Bootstrap
    - Si on veut gérer des interactions, il faudra donc les écrire nous même en Javascript
    - Documentation : https://bulma.io/documentation/
  -->
  <link rel="stylesheet" href="assets/css/bulma.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <div class="container">
    <header class="header">
      <div class="logo">
        <a href=".">
          <h1 class="logo__title title is-3">O'ShoppingList v2</h1>
        </a>
        <p>Pour ne rien oublier en allant faire les courses !</p>
        <?php if (isset($_SESSION['user'])) : ?>
          <p>Bonjour <?= $_SESSION['user']['login'] ?></p><em>(<a href="logout.php">déconnexion</a>)</em>
        <?php endif; ?>
      </div>
    </header>
    <main>
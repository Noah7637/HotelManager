<?php
ob_start();

if (!isset($_SESSION['user'])) {
    header('Location: /auth/login/');
}
?>

formulaire creation client

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
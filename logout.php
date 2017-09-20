<?php require_once("include/Session.php"); ?>
<?php require_once("include/Function.php"); ?>
<?php 
    $_SESSION['User_id'] = null;
    session_destroy();
    Redirect_to('login.php');

?>
<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['usertype'])) {
    header('Location: logout.php');
} else {
    header('Location: view_user.php');
}
?>
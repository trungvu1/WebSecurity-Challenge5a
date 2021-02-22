<?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["usertype"]);
unset($_SESSION["fullname"]);
header("Location:login.php");

<?php
$user_account = $_SESSION['user_account'];
$user_name = $_SESSION['user_name'];
$user_phone = $_SESSION['user_phone'];
$longitude = $_SESSION['longitude'];
$latitudde = $_SESSION['latitudde'];
$user_type = $_SESSION['user_type'];
$Authenticated = $_SESSION['Authenticated'];
header("Location: ../nav.php");
exit();
?>
<?php
include 'partials/header.php';
require 'users.php';


if (!isset($_GET['id'])) {
   include 'partials/not_found.php';
   exit;
}



$userId = $_GET['id'];

$user = getUserById($userId);
if (!$user) {
   include 'partials/not_found.php';

   exit;
}

$errors = [
   'name' => "",
   'username' => "",
   'email' => "",
   'phone' => "",
   'website' => "",
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $user = array_merge($user, $_POST);
   $isValid = validateUser($user, $errors);

   if ($isValid) {
      uploadImage($_FILES['picture'], $user);
      updateUser($_POST, $userId);

      header("Location:index.php");
   }
}
?>


<?php include "form.php" ?>
     
<?php
session_start();
if(isset($_SESSION['logged_in'])){
    $_SESSION = [];
    $_SESSION['success_message'] = 'You are logged out, See you soon.';
    header('location: index.php');

}
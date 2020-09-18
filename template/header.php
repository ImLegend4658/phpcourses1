<?php
session_start();


require_once __DIR__ .'/../config/app.php';
error_reporting(E_ALL);
ini_set('display_errors',1);
if(!array_key_exists ("search", $_GET) || $_GET['search'] == NULL || $_GET['search'] == ''){

    $isempty = true;
   
   } else {
           
    // echo '<pre>';
    // echo 'hey ' . $_GET['search']; 
    // This one without filtering
    echo 'hey ' . htmlspecialchars($_GET['search']);
    //This one has filtering from XXS
    // echo '</pre>';
       
   }
?>
<!DOCTYPE html>
<html dir="<?php echo $config['dir'] ?>" lang="<?php echo $config['lang'] ?>" >
<head>
    <title><?php echo $config['app_name']."/". $title ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <meta charset="UTF-8">
    <style>
        .custom-card-image{
            height: 200px;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
 <body>
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
     <a class="navbar-brand" href="<?php echo $config['app_url'] ?>"><?php echo $config['app_name'] ?></a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarNav">
         <ul class="navbar-nav">
             <li class="nav-item active">
                 <a class="nav-link" href="<?php echo $config['app_url'] ?>">Home <span class="sr-only">(current)</span></a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="<?php echo $config['app_url'] ?>/contact.php">Contact</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="<?php echo $config['app_url'] ?>/messages.php">View messages</a>
             </li>

         </ul>
         <form action="" method="get">
          <input type="text" name="search" class="form-control" placeholder="search" id="search"  >
            <button class="btn btn-success">Go!</button>
         </form>
         <ul class="navbar-nav ml-auto">
             <?php if(!isset($_SESSION['logged_in'])): ?>
             <li class="nav-item">
                 <a class="nav-link" href=" <?php echo $config['app_url']?>/login.php">Login</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href=" <?php echo $config['app_url']?>/register.php">Register</a>
             </li>
             
             <?php else: ?>
             <li class="nav-item">
                 <a href="#" class="nav-link"><?php echo $_SESSION['user_name'] ?></a>
             </li>
                 <li class="nav-item">
                     <a class="nav-link" href=" <?php echo $config['app_url']?>/logout.php">LogOut</a>
                 </li>
             <?php endif ?>
              
         </ul>
     </div>
 </nav>
 <div class="container pt-5">
<?php include "message.php"; ?>
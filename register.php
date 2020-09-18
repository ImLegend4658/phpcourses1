<?php
$title = 'Register';
require_once 'template/header.php';
 require_once 'config/app.php';
require_once 'config/database.php';
 if(isset($_SESSION['logged_in'])){
     header('location: index.php');
}


$errors = [];
$email = '';
$name = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){

   $email = mysqli_real_escape_string($mysqli, $_POST['email']);
   $name = mysqli_real_escape_string($mysqli, $_POST['name']);
   $password = mysqli_real_escape_string($mysqli, $_POST['password']);
   $password_confirm = mysqli_real_escape_string($mysqli, $_POST['password_Confirm']);

   if (empty($email)){
       array_push($errors, "Email is required");
   }
   if (empty($name)){
       array_push($errors, "name is required");
   } if (empty($password)){
       array_push($errors, "password is required");
   } if (empty($password_confirm)){
       array_push($errors, "password confirm is required");
   }
   if($password != $password_confirm){
       array_push($errors,"Password dont match");
   }
   $userExsits = $mysqli->query("select id, email from users where email='$email' limit 1");

    if(!count($errors)){
        $userExsits = $mysqli->query("select id, email from users where email='$email' limit 1");
            if($userExsits->num_rows){
                array_push($errors,"Email already registered");
            }
    }

    /// create a new uesr;
    if(!count($errors)){
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "insert into users(email, name, password) values('$email','$name','$password')";
        $mysqli->query($query);
         $_SESSION['logged_in'] = True;
        $_SESSION['user_id'] = $mysqli->insert_id;
        $_SESSION['user_name']= $name;
        $_SESSION['success_message'] = " Welcome and Thank you for your registertion :D . $name ";
        header('location: index.php');
    }
}
?>

<div id="register" >
    <h4>Welcome to our website</h4>
    <h5 class="text-info">Please fill in the form below to register a new account..</h5>
<hr>
    <?php include 'template/errors.php'?>
<form action="" method="post" >
    <div class="form-group">
        <label for="email">your email</label>
        <input type="email" name="email" class="form-control" placeholder="Your email" id="email"value="">
    </div>

    <div class="form-group">
        <label for="name">your name</label>
        <input type="text" name="name" class="form-control" placeholder="Your name" id="name" value="">
    </div>

    <div class="form-group">
        <label for="password">your password</label>
        <input type="password" name="password" class="form-control" placeholder="Your password" id="password">
    </div>

    <div class="form-group">
        <label for="password_Confirm">Confirm password</label>
        <input type="password" name="password_Confirm" class="form-control" placeholder="Confirm your password." id="password_Confirm">
    </div>
    <div class="form-group">
        <button class="btn btn-success">Register!</button>
        <a href="login.php">Already have an account?</a>
    </div>
</form>
</div>
<?php

include 'template/footer.php';
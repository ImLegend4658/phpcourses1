<?php
$title = 'Register';
require_once 'template/header.php';
 require_once 'config/app.php';
require_once 'config/database.php';
//require_once 'template/errors.php';

 if(isset($_SESSION['logged_in'])){
     header('location: index.php');
}


$errors = [];
 $email = '';
 if($_SERVER['REQUEST_METHOD'] == 'POST') {

   $email = mysqli_real_escape_string($mysqli, $_POST['email']);
   $password = mysqli_real_escape_string($mysqli, $_POST['password']);

   if (empty($email)) {
       array_push($errors, "Email is required");
   }
   if (empty($password)) {
       array_push($errors, "password is required");
   }


        if(!count($errors)){
        $userExsits = $mysqli->query("select id, password,email, name, role from users where email='$email'limit 1");
            if(!$userExsits->num_rows){
              array_push( $errors,"your email, $email is not exsist");
            }else{
            $foundUser = $userExsits->fetch_assoc();
            if(password_verify($password, $foundUser['password'])){
                //login
                $_SESSION['logged_in'] = True;
                $_SESSION['user_id'] = $foundUser['id'];
                $_SESSION['user_name']= $foundUser['name'];
                $_SESSION['user_role'] = $foundUser['role'];
                $_SESSION['success_message'] = "Welcome back. Dear: " .$foundUser['name'];
                // if($foundUser['role'] == 'admin'){
                //     header('location: Admin');

                // }else{
                    header('location: index.php');

                // }

            }
    }}
 }
    /// create a new uesr;
//    if(!count($errors)){
//        $password = password_hash($password, PASSWORD_DEFAULT);
//
//        $query = "insert into users(email, name, password) values('$email','$name','$password')";
//        $mysqli->query($query);
//         $_SESSION['logged_in'] = True;
//        $_SESSION['user_id'] = $mysqli->insert_id;
//        $_SESSION['user_name']= $name;
//        $_SESSION['success_message'] = " welcome back. $name ";
//        header('location: index.php');
//    }

?>

<div id="login" >
    <h4>Welcome BACK :D</h4>
    <h5 class="text-info">Please fill in the form below to login</h5>
<hr>
    <?php include 'template/errors.php'; ?>
<form action="" method="post" >
    <div class="form-group">
        <label for="name">user name</label>
        <input type="text" name="email" class="form-control" placeholder="Your email" id="email" value="<?php echo $email ?>">
    </div>

    <div class="form-group">
        <label for="password">your password</label>
        <input type="password" name="password" class="form-control" placeholder="Your password" id="password">
    </div>

    <div class="form-group">
        <button class="btn btn-success">Login!</button>
        <a href="password_reset.php">Forget your password?</a>
    </div>
</form>
</div>
<?php

include 'template/footer.php';
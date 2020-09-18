 <?php
$title = 'Register';
require_once 'template/header.php';
 require_once 'config/app.php';
require_once 'config/database.php';
 if(isset($_SESSION['logged_in'])){
     header('location: index.php');
 }

if(!isset($_GET['token']) || !$_GET['token']){
    die('token parameter is missing.');
}

$new = date('Y-m-d H:i:s');
$stmt = $mysqli->prepare("select * from password_resets where token = ? and  expires_at > '$new'");
$stmt->bind_param('s',$token);
$token = $_GET['token'];
$stmt->execute();

$result = $stmt->get_result();

if (!$result->num_rows){
     die("token is not VALID :D");
 }


$errors = [];
  $password = '';
$token = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
     $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $password_confirm = mysqli_real_escape_string($mysqli, $_POST['password_Confirmation']);


     if (empty($password)){
        array_push($errors, "password is required");
    } if (empty($password_confirm)){
        array_push($errors, "password confirm is required");
    }
    if($password != $password_confirm){
        array_push($errors,"Password dont match");
    }


        if(!count($errors)){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $userID = $result->fetch_assoc()['user_id'];
             $mysqli->query("update users set password = '$hashed_password' where id = '$userID'");
            $mysqli->query("DELETE FROM password_resets where user_id='$userID'");
////
            $_SESSION['success_message'] = 'your password has been changed';

            header('location: login.php');
            die();
            }

//            $_SESSION['success_message'] = 'Please check your email for New password';
//            header('location: password_reset.php');


}
?>

    <div id="password_reset">
        <h4>Creat a new password </h4>
        <h5 class="text-info">Fill in your email to reset your Password!</h5>
        <hr>
        <?php include 'template/errors.php'?>
        <form action="" method="post" >
            <div class="form-group">
                <label for="password">New password: </label>
                <input type="password" name="password" class="form-control" placeholder="Your New password" id="password">
            </div>

            <div class="form-group">
                <label for="password_Confirmation">Confirm New password: </label>
                <input type="password" name="password_Confirmation" class="form-control" placeholder="password_Confirmation" id="password_Confirmation">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">change Password!</button>
            </div>
        </form>
    </div>
<?php
include 'template/footer.php';

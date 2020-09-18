 <?php
$title = 'Register';
require_once 'template/header.php';
 require_once 'config/app.php';
require_once 'config/database.php';
 if(isset($_SESSION['logged_in'])){
     header('location: index.php');
 }


$errors = [];
  $password = '';
  $email = '';
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = mysqli_real_escape_string($mysqli, $_POST['email']);

    if (empty($email)) {
        array_push($errors, "Email is required");
    }


        if(!count($errors)){


            $userExsits = $mysqli->query("select id,email, name from users where email='$email' limit 1");
            if($userExsits->num_rows){
                $userID = $userExsits->fetch_assoc()['id'];
                $tokenExsist = $mysqli->query("delete from password_resets where user_id = '$userID'");


                $token = bin2hex(random_bytes(16));
                 $expiers_at = date('Y-m-d H:i:s',strtotime('+1 day'));

                 $mysqli->query("insert into password_resets (user_id, token, expires_at)
                        values('$userID', '$token', '$expiers_at')");

//                $changePassword = $config['app_url'].'/ChangePassword.php?token='.$token;
//                $headers  = 'MIME-Version: 1.0' . "\r\n";
//                $headers .= 'Content-type: text/html; charset=UFT-8' . "\r\n";
//                $headers .= 'From: '.$config['admin_email']."\r\n".
//                    'Reply-To: '.$config['admin_email']."\r\n" .
//                    'X-Mailer: PHP/' . phpversion();
//
//                $htmlMessage = '<html><body>';
//                $htmlMessage .= '<p style="color: #ff0000;">'.$changePassword.'</p>';
//                $htmlMessage .= '</html></body>';
//
//                 mail($email,'Password reset',$htmlMessage,$headers);
//                    session_destroy();

            }
        }
//            $_SESSION['success_message'] = 'Please check your email for New password';
//            header('location: password_reset.php');

}

?>

    <div id="password_reset">
        <h4>Password reset </h4>
        <h5 class="text-info">Fill in your email to reset your Password!</h5>
        <hr>
        <?php include 'template/errors.php'?>
        <form action="" method="post" >
            <div class="form-group">
                <label for="email">your email</label>
                <input type="email" name="email" class="form-control" placeholder="Your email" id="email" value="<?php echo $email ?>">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">REQUEST PASSWORD RESET LINK!</button>
            </div>
        </form>
    </div>
<?php
include 'template/footer.php';

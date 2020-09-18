<?php
$title = 'create user';
include __DIR__.'/../template/header.php';
//include __DIR__.'/../../config/app.php';
//
// include __DIR__.'/../../config/database.php';

$errors = [];
$email = '';
$name = '';
$role = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $role = mysqli_real_escape_string($mysqli, $_POST['role']);

    if (empty($email)){
        array_push($errors, "Email is required");
    }
    if (empty($name)){
        array_push($errors, "name is required");
    } if (empty($password)){
        array_push($errors, "password is required");
    }
    if (empty($role)){
        array_push($errors, "Role is required");
    }
    /// create a new uesr;
    if(!count($errors)){
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "insert into users(email, name, password,role) values('$email','$name','$password', '$role')";
        $mysqli->query($query);
        if($mysqli->error) {
            array_push($errors, $mysqli->error);
        }else {
            echo "<script>location.href = 'index.php'</script>";
        }
        }
}
?>
 <div class="card">
<div class="content">

    <?php include __DIR__.'/../template/errorsAdmin.php'; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="email">your email</label>
            <input type="email" name="email" class="form-control" placeholder="Your email" id="email" value="<?php echo $email ?>">
        </div>

        <div class="form-group">
            <label for="name">your name</label>
            <input type="text" name="name" class="form-control" placeholder="Your name" id="name" value="<?php echo $name ?>">
        </div>

        <div class="form-group">
            <label for="password">your password</label>
            <input type="password" name="password" class="form-control" placeholder="Your password" id="password">
        </div>
        <div class="form-group">
            <label class="role">Role</label>
            <select name="role" id="role" class="form-control">
                <option value="user"
                <?php if($role == 'user') echo 'selected' ?>
                >User</option>
                <option value="admin"
                    <?php if($role == 'admin') echo 'selected' ?>
                >admin</option>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-success">Create!</button>
         </div>
    </form>
</div>
 </div>
<?php
include __DIR__.'/../template/footer.php';

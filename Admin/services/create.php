<?php
$title = 'create service';
include __DIR__.'/../template/header.php';
//include __DIR__.'/../../config/app.php';
//
// include __DIR__.'/../../config/database.php';

$errors = [];
 $name = '';
 $price ='';
 $description = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){

     $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $price = mysqli_real_escape_string($mysqli, $_POST['price']);
    $description = mysqli_real_escape_string($mysqli, $_POST['describtion']);


    if (empty($name)){
        array_push($errors, "Name is require");
    } if (empty($price)){
        array_push($errors, "price is required");
    }
    if (empty($description)){
        array_push($errors, "describtion is required");
    }
    /// create a new uesr;
    if(!count($errors)){

        $query = "insert into services(Name,describtion, price ) values('$name','$description','$price')";
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
            <label for="name">name: </label>
            <input type="text" name="name" class="form-control" placeholder="Your name" id="name" value="<?php echo $name ?>">
        </div>

        <div class="form-group">
            <label for="describtion">Descrition: </label>
            <textarea name="describtion" id="describtion" cols="30" rows="10" class="form-control"><?php echo $description ?></textarea>
         </div>

        <div class="form-group">
            <label for="price">price: </label>
            <input type="text" name="price" class="form-control"  id="price" value="<?php echo $price ?>">
        </div>

        <div class="form-group">
            <button class="btn btn-success">Create!</button>
         </div>
    </form>
</div>
 </div>
<?php
include __DIR__.'/../template/footer.php';

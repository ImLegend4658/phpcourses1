<?php
$title = 'Edit Service';
include __DIR__.'/../template/header.php';

if(!isset($_GET['id']) || !$_GET['id']){
    die("Die");
}

$st = $mysqli->prepare("select * from services where id_service = ? limit 1");

$st->bind_param('i',$ServiceID);
$ServiceID = $_GET['id'];
$st->execute();
$service = $st->get_result()->fetch_assoc();
 

$name = $service['name'];
$description = $service['describtion'];
$price = $service['price'];

$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){


    if (empty($_POST['name'])){
        array_push($errors, "name is required");
    } if (empty($_POST['price'])){
        array_push($errors, "price is required");
    }
    if (empty($_POST['describtion'])){
        array_push($errors, "describtion is required");
    }

    if (!count($errors)){
        $st = $mysqli->prepare("update services set name = ?, describtion = ?, price = ? where id_service = ?");
        $st->bind_param('ssdi',$dbName, $dbdescribtion, $dbprice, $dbId);
        $dbName = $_POST['name'];
        $dbdescribtion = $_POST['describtion'];
        $dbprice = $_POST['price'];
         $dbId = $_GET['id'];
        
         $st->execute();

        if($st->error){
            array_push($errors, $st->error);
        }else{
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

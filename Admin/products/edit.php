<?php
$title = 'Edit Products';
include __DIR__.'/../template/header.php';
require_once __DIR__.'/../../classes/Upload.php';
if(!isset($_GET['id']) || !$_GET['id']){
    die("Die");
}

$st = $mysqli->prepare("select * from products where id = ? limit 1");

$st->bind_param('i',$ProductsID);
$ProductsID = $_GET['id'];
$st->execute();
$products = $st->get_result()->fetch_assoc();
//This one do filter for sql

// $products = $mysqli->query("select * from products where id = ? limit 1")->fetch_all(MYSQLI_ASSOC);

$name = $products['name'];
$description = $products['describtion'];
$price = $products['price'];
$image = $products['Image'];
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

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $upload = new Upload('uploads/products');
        $upload->file = $_FILES['image'];
        $errors = $upload->upload();

        if(!count($errors)){
            unlink($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'/phpcourses/'.$image);
            $image = $upload->filePath;
        }
    }

    if (!count($errors)){
        $st = $mysqli->prepare("update products set name = ?, describtion = ?, price = ?, Image = ? where id = ?");
     $st->bind_param('ssdsi',$dbName,$dbdescribtion, $dbprice, $dbImage, $dbId);
         $dbName = $_POST['name'];
        $dbdescribtion = $_POST['describtion'];
        $dbprice = $_POST['price'];
        $dbImage = $image;
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

            <form action="" method="POST" enctype="multipart/form-data">
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
                    <img src="<?php echo $config['app_url'].'/'.$image ?>" width="150"alt="">
                    <label for="image">Image: </label>
                    <input type="file" name="image">
                </div>

                <div class="form-group">
                    <button class="btn btn-success">Create!</button>
                </div>
            </form>
        </div>
    </div>

 <?php
include __DIR__.'/../template/footer.php';

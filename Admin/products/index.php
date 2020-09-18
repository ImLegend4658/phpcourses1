<?php
$title = 'products';
include __DIR__.'/../template/header.php';

require_once __DIR__.'/../../classes/Upload.php';
$date = date('Ym');
$upload1 = new Upload('uploads/products/'.$date);
$products = $mysqli->query("select * from products order by id")->fetch_all(MYSQLI_ASSOC);



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $st = $mysqli->prepare("DELETE from products where id = ?");
    $st->bind_param('i',$ProductID);
    $ProductID = $_POST['productID'];
    $st->execute();

    if($_POST['Image']){
        unlink($_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR. 'phpcourses'.$_POST['Image']);
    }


    echo "<script>location.href = 'index.php'</script>";
}


?>
    <div class="card">
        <div class="content">
            <a href="create.php" class="btn btn-success">Create a new products</a>

            <p class="header">Products: <?php echo count($products) ?></p>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th width="0">#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th width="200">Actions</th>
                    </tr>

                    </thead>
                    <tbody>
                    <?php foreach ($products as $products1): ?>
                        <tr>
                            <td><?php echo $products1['id'] ?></td>
                            <td><?php  echo $products1['name'] ?></td>
                            <td><?php echo $products1['describtion']  ?></td>
                            <td><?php echo $products1['price']  ?></td>
                            <td><img scr="<?php echo $config['app_url'].'/uploads/products/'.$date. $products1['Image']?>" width="50" alt=""></td>
                            <td class="form-inline">
                                <a href="edit.php?id=<?php echo $products1['id'] ?>" class="mr-1 btn btn-outline-warning">Edit</a>
                                <form onclick="return confirm('Are you sure?')"   method="post">
                                    <input type="hidden" name="productID" value="<?php echo $products1['id'] ?>">
                                    <input type="hidden" name="Image" value="<?php echo $products1['Image'] ?>">

                                    <button class="btn btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach;  ?>

                    </tbody>
                </table>

            </div>
        </div>

    </div>

<?php

include __DIR__.'/../template/footer.php';

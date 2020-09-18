
<?php
$title = 'Home Page';
require_once 'template/header.php';
require_once 'classes/Service.php';
require_once 'classes/Product.php';
require_once 'classes/Upload.php';
require_once 'config/app.php';
require_once 'config/database.php';

$service = new Service;
$date = date('Ym');
$upload1 = new Upload('uploads/products/'.$date);
 ?>

<?php if($service->available) {?>
<h1>Welcome to our shope</h1>

    <?php $products = $mysqli->query("select * from products ")->fetch_all(MYSQLI_ASSOC) ?>
    <div class="row">
        <?php foreach($products as $product) { ?>
            <div class="col-md-4">
                <div class="card mb-3">
                   <div class="custom-card-image" style="background-image: url(<?php echo $config['app_url'] .'/uploads/products/'.$date. $product['Image']?>)"></div>
 
                    <div class="card-header"> <?php echo $product['name'] ?></div>
                        <div class="card-body">
                        <div> <?php echo $product['describtion'] ?> </div>
                        <div class="text-success" >Price: <?php echo $product['price'] ?> $</div>
                    </div>
                </div>
            </div>


        <?php } ?>
    </div>
<?php }


require_once 'template/footer.php'?>



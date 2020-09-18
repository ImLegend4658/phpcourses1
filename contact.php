
<?php

$title = 'Contact';
 require_once 'template/header.php';
require_once 'includes/uploader.php';
require_once 'classes/Service.php';
// if (isset($_SESSION['contact_form'])){
//    print_r($_SESSION['contact_form']);
// }

$s = new Service;
 
 
$service = $mysqli->query("select  id_service, name, price from services order by name");

$errors =[];
  ?>

<?php if($s->available) {?>
<h1>Contact</h1>


    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <div  class="form-group">
        <label for="name">Your name
            <input type="text" name="name" <?php if(isset($_SESSION['contact_form']['name'])) echo $_SESSION['contact_form']['name'] ?>class="form-control" placeholder="your name">
         <span class="text-danger" <?php echo $nameError ?></span>
        </label>
    </div>

    <div  class="form-group">
        <label for="email">Your email
        <input type="email" name="email" <?php if(isset($_SESSION['contact_form']['email'])) ?> class="form-control" placeholder="your email">
        <span class="text-danger"<?php echo $emailError ?>></span>
        </label>
    </div>

    <div  class="form-group">
        <label for="document">Your Files</label>
        <input type="file" name="document" <?php if(isset($_SESSION['contact_form']['document'])) ?>  >
        <!-- <input type="submit" name="submit"> -->
        <span class="text-danger" <?php echo $documentError ?>></span>
    </div>

    <div  class="form-group">
        <label for="services">Services</label>
        <select name="services_id" id="services" class="form-control">
        <?php foreach($service as $services) {?>
            <option value="<?php echo $services['id_service'] ?>" >
                <?php echo $services['name'] ?>
                (<?php echo $s->price( $services['price']) ?>) SAR
            </option>
         <?php }?>
        </select>


    </div>
    <div  class="form-group">
        <label for="message">Your message:
        <textarea name="message" class="form-control" placeholder="your name"><?php if(isset($_SESSION['contact_form']['message'])) echo $_SESSION['contact_form']['message']?></textarea>
        <span class="text-danger" <?php echo $messageError ?>></span>
        </label>
    </div>
    <button class="btn btn-primary" name="submit">Send</button>
    <?php
    if(isset($_POST['submit'])){
        $_SESSION['success_message'] = " your massege has been sent :D.";
    }
    ?>
</form>

<?php  } ?>
<?php require_once 'template/footer.php'

?>

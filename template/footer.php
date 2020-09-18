<?php
require_once __DIR__.'/../classes/user.php';

$user1 = new User();

?>

</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

</body>
<footer>

    <div class="container">
        <div class=" float-right">
            <?php
            if($user1->isAdmin()){
                ?>
            <a class="btn btn-primary" href="<?php echo $config['app_url'] ?>/Admin">Admin Panle</a>
            <?php
            //if user is not admin, admin panle will not show up, otherwise if you are admin.
            }?>
            
        </div>
        <p>copyright <?php echo $config['app_name'] ?></p>

    </div>



</footer>

</html>
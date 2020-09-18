<?php
$title = 'Services';
include __DIR__.'/../template/header.php';



$services = $mysqli->query("select * from services order by id_service")->fetch_all(MYSQLI_ASSOC);



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $st = $mysqli->prepare("DELETE from services where id_service = ?");
    $st->bind_param('i',$Service_ID);
    $Service_ID = $_POST['id_service'];
    $st->execute();

     echo "<script>location.href = 'index.php'</script>";
}


?>
    <div class="card">
        <div class="content">
            <a href="create.php" class="btn btn-success">Create a new services</a>

            <p class="header">Services: <?php echo count($services) ?></p>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th width="0">#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th width="200">Actions</th>
                    </tr>

                    </thead>
                    <tbody>
                    <?php foreach ($services as $serive3): ?>
                        <tr>
                            <td><?php echo $serive3['id_service'] ?></td>
                            <td><?php  echo $serive3['name'] ?></td>
                            <td><?php echo $serive3['describtion']  ?></td>
                            <td><?php echo $serive3['price']  ?></td>
                            <td class="form-inline">
                                <a href="edit.php?id=<?php echo $serive3['id_service'] ?>" class="mr-1 btn btn-outline-warning">Edit</a>
                                <form onclick="return confirm('Are you sure?')"   method="post">
                                    <input type="hidden" name="id_service" value="<?php echo $serive3['id_service'] ?>">
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

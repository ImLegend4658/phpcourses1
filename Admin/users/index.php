<?php
$title = 'Users';
include __DIR__.'/../template/header.php';



$users = $mysqli->query("select * from users order by id")->fetch_all(MYSQLI_ASSOC);



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $st = $mysqli->prepare("DELETE from users where id = ?");
    $st->bind_param('i',$user_ID);
    $user_ID = $_POST['user_id'];
    $st->execute();

    echo "<script>location.href = 'index.php'</script>";
}


?>
    <div class="card">
        <div class="content">
            <a href="create.php" class="btn btn-success">Create a new uesr</a>

            <p class="header">Users: <?php echo count($users) ?></p>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th width="200">Actions</th>
                    </tr>

                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id'] ?></td>
                            <td><?php  echo $user['email'] ?></td>
                            <td><?php echo $user['name']  ?></td>
                            <td><?php echo $user['role']  ?></td>
                            <td class="form-inline">
                                <a href="edit.php?id=<?php echo $user['id'] ?>" class="mr-1 btn btn-outline-warning">Edit</a>
                                <form onclick="return confirm('Are you sure?')"   method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
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

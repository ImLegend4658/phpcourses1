<?php
require_once 'template/header.php';
require_once 'config/database.php';
require_once 'config/app.php';
require_once 'classes/user.php';

$user = new User;

// if(!$user->isAdmin()){
//     die("you dont have an access to this area :D");
// }
// it shows if the user is admin or not. if is not, page will not display.
//
$query = ("select *, m.id as message_id, s.id_service as service_id from messages1 m
left join services s
on m.id_service = s.id_service
order by m.id");

$messages = $mysqli->query($query);

// $st = $mysqli->prepare( "select *, m.id as message_id, s.id_service as service_id from messages1 m
// left join services s
// on m.id_service = s.id_service
// order by m.id limit ?");
// $st->bind_param('i',$limit);
// isset($_GET['limit']) ? $limit = $_GET['limit'] : $limit = 5;
// $st->execute();
// $messages = $st->get_result()->fetch_all(MYSQLI_ASSOC);

if(!isset($_GET['id'])){

?>
    <h2>Received messages</h2>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
          <tr>
              <th>#</th>
              <th>Sender name</th>
              <th>Sender email</th>
              <th>Service</th>
              <th>document</th>
              <th>Message: </th>
              <th>Actions: </th>
          </tr>
            </thead>
            <tbody>


<?php

foreach($messages as $message){
    ?>
    <tr>
        <td>
          <?php echo $message['message_id'] ?>
        </td>
        <td>
            <?php echo $message['contact_name'] ?>
        </td>
        <td>
            <?php echo $message['email'] ?>
        </td>
        <td>
            <?php echo $message['name'] ?>
        </td>
        <td>
            <?php echo $message['document'] ?>
        </td>
        <td>
            <?php echo $message['message'] ?>
        </td>
        <td>
            <a href="?id=<?php echo $message['message_id']?>" class="btn btn-sm btn-primary" >View</a>
            <form onsubmit="return confirm('Are you sure?')" action="" method="post" style="display: inline-block">
                <input type="hidden" name="message_id" value="<?php echo $message['message_id'] ?>">
                <button class="btn btn-sm btn-danger">Delete</button>
            </form>

        </td>
    </tr>
<?php
}
?>
            </tbody>
        </table>
    </div>
<?php
}else{

    
    $messageQuery = "select * from messages1 m
    left join services s 
    on m.id_service = s.id_service
        where m.id=".$_GET["id"]." limit 1";
    $message = $mysqli->query($messageQuery)->fetch_array(MYSQLI_ASSOC);
    // here is Injected and hacker could have information and gain access.


//    $st1 = $mysqli->prepare("select * from messages1 m
//     left join services s 
//     on m.id_service = s.id_service
//         where m.id=? limit 1");
//         $st1->bind_param('i',$ID);
//         $ID = $_GET["id"];
//         $st1->execute();
//         $message = $st1->get_result()->fetch_array(MYSQLI_ASSOC);

// here makes filter for sqli injetion that not let hacker have senstive information
     ?>
    <div class="card">
        <h5 class="card-header">
            Message from: <?php echo $message['contact_name'] ?></h5>
            <div class="larg">email <?php echo $message['email'] ?></div>
        <div class="card-body">
            <div>Servcie: <?php if($message['name']){echo $message['name'];}else{echo 'No service';} ?></div>
            <?php echo $message['message'] ?>
        </div>
        <?php if($message['document']){ ?>
        <div class="card-footer">
            Attachment: <a href="<?php
            echo $config['app_url']."/"
                .$config['upload_dir']."/"
                .$message['document'] ?>">DOWNLOADS</a>
        </div>
        <?php } ?>
    </div>

<?php
}


if(isset($_POST['message_id'])) {
    $st = $mysqli->prepare("delete from messages1 where id=?");
    $st->bind_param('i', $mssageID);
    $mssageID = $_POST['message_id'];
    $st->execute();
    // $st = $mysqli->query("delete from messages1 where id=?")->fetch_all(MYSQLI_ASSOC);
    // $mssageID = $_POST['message_id'];

    if($_POST['document']){
        unlink($config['upload_dir'].$_POST['document']);
    }
    echo "<script>location.href = 'messages.php'</script>";
}

require_once 'template/footer.php';

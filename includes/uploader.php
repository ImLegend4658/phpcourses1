<?php
 
require_once 'config/database.php';


$uploadDir ='uploads';

// echo getcwd();

function filterString($field){
   $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
   if(empty($field)){
       return false;
   }else{
       return $field;
   }

}

function filterEmail($field){
   $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);

   if(filter_var($field,FILTER_SANITIZE_EMAIL )){
       return $field;
   }else{
       return false;
   }
}

function canUpload($file){
    //allowed
    $allowd = [
        // 'jpg' => 'image/jpeg',
        // 'png' => 'image/png',
        // 'gif' => 'image/gif'
    ];
    $maxFileSIZE = 1000 * 1024;

    // $fileMimeType = mime_content_type($_FILES['document']['tmp_name']);
    // $filesize = $file['size'];
    // if(!in_array($fileMimeType, $allowd)){
    //     return 'File type is not allowd';
    // }

    // if($filesize > $maxFileSIZE){
    //     return 'File size is not allowd';
    // }
    // return true;

}

$nameError = $emailError = $messageError = $documentError = '';
$name = $email = $message = $documents = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

//    $name = filterString($_POST['name']);
    $name = $_POST['name'];
    // $name = stripslashes($name);
    //  $name = htmlspecialchars($name);
     if(!$name){
        $_SESSION['contact_form']['name'] = '';
        $nameError = 'Your name is Require';
    }else{
        $_SESSION['contact_form']['name'] = $name;
    }

//    $email = filterEmail($_POST['email']);
    $email = $_POST['email'];
    // $email = htmlspecialchars($email);
    // $email = stripslashes($email);
     if(!$email){
        $_SESSION['contact_form']['email'] = '';
        $emailError = 'Your email is required';
    }else{
        $_SESSION['contact_form']['email'] = $email;
    }

//    $message = filterString($_POST['message']);
    $message = $_POST['message'];
    // $message = htmlspecialchars($message);
    // $message = stripslashes($message);  
   if(!$message){
        $_SESSION['contact_form']['message']='';
        $messageError = 'Your must enter message';
    }else{
        $_SESSION['contact_form']['message']= $message;
    }

    /// new 
    $documents = $_POST['document'];
    if(!$documents){
        $_SESSION['contact_form']['document'] = '';
        $documentError = 'Error';    
    }else{
        $_SESSION['contact_form']['document'] = $documents;
    }
     
        header('Location: contact.php');

    // if(isset($_FILES['document']) && $_FILES['document']['error'] == 0 ){

    //     $canUpload = canUpload($_FILES['document']);
    //     if($canUpload == true){
    //         if(!is_dir($uploadDir)){
    //             umask(0);
    //             mkdir($uploadDir,0777);
    //         }
    //         $fileName = time().$_FILES['document']['name'];
            
    //          if(file_exists($uploadDir.'/'.$fileName)){
    //             $documentError = 'File is ready exsit';
    //         }else{
    //             move_uploaded_file($_FILES['document']['tmp_name'],$uploadDir.'/'.$fileName);

    //         }

    //     }else
    //     {
    //         $documentError  = $canUpload;
    //     }
    // }
    


//    if(!$nameError && !$emailError && !$messageError && !$documentError){
//        $fileName ? $filePath = $uploadDir.'/'.$fileName : $filePath = '';
    //    $statment = $mysqli->prepare("insert into messages1
    //           ( contact_name, email, message, document,id_service)
    //            values(?,?,?,?,?)");

    //    $statment->bind_param('ssssi', $dbContact_name, $dbEmail, $dbMessage, $dbDocuments,$dbIDService);
    //    $dbContact_name = $name;
    //    $dbEmail = $email;
    //    $dbMessage = $message;
    //    $dbIDService = $_POST['services_id'];
    //    $dbDocuments = $filePath;

    //    $statment->execute();

    if(isset($_POST['submit'])){

        $image = rand(1000,10000)."-".$_FILES['document']['name'];
        $tname = $_FILES['document']['temp_name'];

        $upload_dir = ' uploads';

        move_uploaded_file($tname, $upload_dir.'/'.$image);
        $insertMessage =
        "insert into messages1 ( contact_name, email, message, document, id_service)".
         "values('$name','$email','$message','$image',".$_POST['services_id'].")";
         $mysqli->query($insertMessage);
    }



    //   $insertMessage =
    //       "insert into messages1 ( contact_name, email, message, document, id_service)".
    //        "values('$name','$email','$message','$image',".$_POST['services_id'].")";

        //    $mysqli->query($insertMessage);
  
    //           header('Location: contact.php');
            //   session_destroy();
//        $headers  = 'MIME-Version: 1.0' . "\r\n";
//        $headers .= 'Content-type: text/html; charset=UFT-8' . "\r\n";
//        $headers .= 'From: '.$email."\r\n".
//            'Reply-To: '.$email."\r\n" .
//            'X-Mailer: PHP/' . phpversion();

//        $htmlMessage = '<html><body>';
//        $htmlMessage .= '<p style="color: #ff0000;">'.$message.'</p>';
//        $htmlMessage .= '</html></body>';

//           if( mail($config['admin_email'],'you have a new message',$htmlMessage,$headers)){
//               session_destroy();
//               header('Location: contact.php');
//               die();
        //   }

   
}
//  

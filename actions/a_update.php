<?php
require_once 'db_connect.php';
require_once  'file_upload.php';

if ($_POST) {    
   $name = $_POST['name'];
   $text = $_POST['text'];
   $id = $_POST['ID'];
   //variable for upload pictures errors is initialized
   $uploadError = '';

   $picture = file_upload($_FILES['picture']);//file_upload() called  
   if ($picture->error===0){
       ($_POST["picture"]=="product.png")?: unlink("../pictures/$_POST[picture]");          
       $sql = "UPDATE blog_content SET name = '$name', text = '$text', picture = '$picture->fileName' WHERE ID = {$id}";
   }else{
       $sql = "UPDATE blog_content SET name = '$name', text = '$text' WHERE ID = {$id}";
   }    
   if ($connect->query($sql) === TRUE) {
       $class = "success";
       $message = "The record was successfully updated";
       $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
   } else {
       $class = "danger";
       $message = "Error while updating record : <br>" . $connect->error;
       $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
   }
   $connect->close();    
} else {
   header("location: ../error.php");
}
?>


<!DOCTYPE html>
<html lang= "en">
   <head>
       <meta  charset="UTF-8">
       <title>Update</title>
       <?php require_once '../components/boot.php' ?> 
   </head>
   <body>
       <div  class="container">
           <div class="mt-3 mb-3" >
               <h1>Update request response</h1>
           </div>
            <div class="alert alert-<?php echo $class;?>" role="alert">
               <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='../update.php?id=<?=$id;?>' ><button class="btn btn-warning" type='button'>Back</button></a>
                <a href='../index.php'><button class="btn btn-success"  type='button'>Home</button></a>
            </div>
       </div >
   </body>
</html>
<?php require_once 'actions/db_connect.php';


$sql = "SELECT * FROM blog_content";
$result = mysqli_query($connect ,$sql);
$tbody=''; //this variable will hold the body for the table
if(mysqli_num_rows($result)  > 0) {    
   while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){        
       $tbody .= "<tr>

            <td><img class='img-thumbnail' src='pictures/" .$row['picture']."'</td>
           <td>" .$row['name']."</td>
            <td>" .$row['date']."</td>
            <td>".$row['text']."</td>
           <td><a href='update.php?id=" .$row['ID']."'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
           <a href='delete.php?id=" .$row['ID']."'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
           </tr>";
   };
} else {
   $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

$connect->close();


?>

<!DOCTYPE html>
<html lang="en" >
   <head>
       <meta charset="UTF-8">
       <meta name="viewport"  content="width=device-width, initial-scale=1.0">
       <title>PHP CRUD</title>
       <?php require_once 'components/boot.php' ?>
       <style type= "text/css">
           .manageProduct {          
               margin: auto;
           }
           .img-thumbnail {
               width: 100px !important;
                height: 80px !important;
           }
           td {          
               text-align: left;
               vertical-align: middle;

            }
           tr {
               text-align: center;
           }
       </style>
   </head>
   <body>
       <div class="manageProduct w-75 mt-3" >   
           <div class='mb-3'>

                <a href= "create.php" ><button class='btn btn-primary'type = "button" >Contribute to the blog</button></a>
            </div>
           <p  class='h2'>Blog Posts</p>

            <table class='table table-striped'>
               <thead class='table-success' >
                   <tr>

                        <th>Picture</th>
                       <th>Name of Author</ th>
                       <th>Date Created</th>
                        <th>Text Created</th>
                        <th>Actions</th>
                   </tr>
               </thead>
               <tbody>
               <?php echo $tbody ?>
               </tbody>
            </table>
       </div>
    </body>
</html > 
<?php
session_start();
// intial values 
$insert= false;
$update= false;
$delete= false;
include"parts/conn.php";
$username=$_SESSION['username'];



if(isset($_GET['delete'])){
       $sno=$_GET['delete'];
       $sql="DELETE FROM `notes` WHERE `notes`.`sno` = $sno";
      $result=mysqli_query($con,$sql);
      $delete=true;
     }
     
     
     
     
     
     // //Update the records portion 
     // //upload the record 
if($_SERVER['REQUEST_METHOD']=='POST'){
          if(isset($_POST['snoEdit']))
            { //Update the records portion 
                   //upload the record 
                   $sno=$_POST['snoEdit'];
                   $title=$_POST['titleEdit'];
                 $description=$_POST['descriptionEdit'];
                 $sql="UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`sno` = $sno";
                $result=mysqli_query($con,$sql);
                $update=true;
                  // exit();
                 }
                 
                 //insert the  record portion 
                 
                 if(isset($_POST['title'])){
                      
                      $tit = $_POST['title'];
                      
                      $description=$_POST['description'];
                      
                      $sql="INSERT INTO `notes` ( `USERNAME`, `title`, `description`, `tstamp`) VALUES ( '$username', ' $tit', '$description', current_timestamp())";
                      $result=mysqli_query($con,$sql);
                      if($result)
                      {
                           $insert=true;
                         }} //end insertion 
                    }//end update 
                         
                         ?>

<!doctype html>
<html>
     <!--html start -->
     
<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.rtl.min.css"
          integrity="sha384-+4j30LffJ4tgIMrq9CwHvn0NjEvmuDCOfk6Rpg2xg7zgOxWWtLtozDEEVvBPgHqE" crossorigin="anonymous">
     <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

     <script src="https://code.jquery.com/jquery-3.6.1.min.js"
          integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
     <title>Welcome <?php echo $_SESSION['username'] ?> </title>

</head>

<body>
     <!-- Button trigger modal 
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit modal
</button>-->







<?php
require'parts/_nav.php';

?>
     <!-- Modal for update -->
     <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
               <div class="modal-content">
                    <div class="modal-header" my-2>
                         <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/loginsys/crud.php" method="post">
                         <div class="modal-body">
                              <input type="hidden" name="snoEdit" id="snoEdit">
                              <div class="mb-3">
                                   <label for="titleEdit" class="form-label">Notes Title</label>
                                   <input type="text" class="form-control" id="titleEdit" name="titleEdit"
                                        aria-describedby="emailHelp">
                                   <label for="description">Notes description</label>
                                   <div class="form-floating my-4">

                                        <textarea class="form-control" placeholder="Leave a comment here"
                                             id="descriptionEdit" name="descriptionEdit"
                                             style="height: 100px"></textarea>

                                   </div>

                                   <button type="submit" class="btn btn-primary">Update note</button>
                              </div>

                         </div>
                         <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">save changes
                              </button>
                              <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                         </div>
                    </form>
               </div>
          </div>
     </div>
     <!-- end of update-->

     <!-- Optional JavaScript; choose one of the two! -->

     <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
     </script>

     <!-- Option 2: Separate Popper and Bootstrap JS -->
     <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    -->


     <!-- message of operations compelte  -->
     <?php
//     require'parts/_nav.php';
   if($insert)
   {
    echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success</strong> Your notes is submitted successfully:
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";}
  if($delete)
   {
    echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success</strong> Your notes is deleted successfully:
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";}
  if($update)
   {
    echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success</strong> Your notes is updated  successfully:
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
   }
   ?>
     <!-- end of message of operations compelte  -->


     <h1 class='text-center'>Hello, <?php echo $_SESSION['username'] ?></h1>

     <!-- main form -->
     <div class="container my-4">
          <h1>Add note </h1>

          <form action="/loginsys/crud.php?" method="post">
               <div class="mb-3">
                    <label for="title" class="form-label">Notes Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                    <label for="description">Notes description</label>
                    <div class="form-floating my-4">

                         <textarea class="form-control" placeholder="Leave a comment here" id="description"
                              name="description" style="height: 100px"></textarea>

                    </div>

                    <button type="submit" class="btn btn-primary">Add note</button>
          </form>
          <!-- end of main form -->

     </div>

     <div class="container" my-4>
          <!-- data table -->
          <table class="table" id="myTable">
               <thead>
                    <tr>
                         <th scope="col">S.no</th>
                         <th scope="col">Title</th>
                         <th scope="col">description</th>
                         <th scope="col">Actions</th>
                    </tr>
               </thead>
               <tbody>
                    <?php
$sql= " SELECT * FROM `notes` WHERE `USERNAME`='$username'";
$result= mysqli_query($con,$sql);
$sno=0;
while ($row=mysqli_fetch_assoc($result)) {
  $sno=$sno+1;
  echo"  <tr>
  <th scope='row'>".$sno."</th>
  <td>".$row['title']."</td>
  <td>".$row['description']."</td>
  <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button></td>
</tr>";  
 }?>
                    <!-- end of data table -->


               </tbody>
          </table>
          <hr>
     </div>


</body>
<!-- other scripts-->
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
     $('#myTable').DataTable();
});
</script>
<script>
// js script for edit the records 
edits = document.getElementsByClassName('edit');
Array.from(edits).forEach((element) => {
     element.addEventListener('click', (e) => {
          console.log("edit", );
          tr = e.target.parentNode.parentNode;
          title = tr.getElementsByTagName("td")[0].innerText;
          description = tr.getElementsByTagName("td")[1].innerText;
          console.log(title, description);
          titleEdit.value = title;
          descriptionEdit.value = description;
          snoEdit.value = e.target.id;
          $('#editModal').modal('toggle');
          console.log(e.target.id);
     })
})

// js script for delete the records 

deletes = document.getElementsByClassName('delete');
Array.from(deletes).forEach((element) => {
     element.addEventListener('click', (e) => {
          console.log("edit", );
          sno = e.target.id.substr(1, );
          if (confirm("Are you sure you want to delete this note!")) {
               console.log("yes");
               window.location = `/loginsys/crud.php?delete=${sno}`;
          } else {
               console.log("No")
          }
     })


})
</script>

</html>
<?php
$insert = false;
$update = false;
$delete = false;
include 'partials/_dbconnect.php';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
    header("location: index.php");
    exit;
}
else{
  $email=$_SESSION['email'];
  $sql="Select * from users where email='$email'";
  $result=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($result);
  $username=$row['username'];
  $u_no=$row['u_no'];
  if(isset($_GET['delete'])){
    $s_no = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `notes` WHERE `s_no` = $s_no";
    $result = mysqli_query($conn, $sql);
  }


  if($_SERVER['REQUEST_METHOD']=='POST'){
    if (isset( $_POST['s_noEdit'])){
      // Update the record
        $s_no = $_POST["s_noEdit"];
        $title = $_POST["titleEdit"];
        $note = $_POST["noteEdit"];
    
      // Sql query to be executed
      $sql = "UPDATE `notes` SET `title` = '".addslashes($title)."' , `note` = '".addslashes($note)."',`timestamp`=current_timestamp() WHERE `notes`.`s_no` = $s_no";
      $result = mysqli_query($conn, $sql);
      if($result){
        $update = true;
    }
    else{
        echo "We could not update the record successfully";
    }
    }
      else{    
           $title = $_POST["title"];
            $note = $_POST["note"];

          // Sql query to be executed
          $sql = "INSERT INTO `notes` (`u_no`,`title`, `note`) VALUES ('$u_no','".addslashes($title)."', '".addslashes($note)."')";
          $result = mysqli_query($conn, $sql);

          
          if($result){ 
              $insert = true;
          }
          else{
              echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
          }
      }  
}

}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/index.css" rel="stylesheet">
    <title>My Notes</title>
  </head>
  <body>
     <!-- Edit Modal -->
    <!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/inoteproject/note.php" method="POST">
              <input type="hidden" name="s_noEdit" id="s_noEdit">
              <div class="d-flex justify-content-center">
                <h2>Edit Your Note</h2>
              </div>  
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" placeholder="Add title" id="titleEdit" name="titleEdit" required >
                </div>
                <div class="mb-3">
                    <label for="note">Your Note</label>
                    <textarea class="form-control" placeholder="Enter your note here" id="noteEdit" name="noteEdit" required></textarea>
                </div> 
                </div> 
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
    </div>
  </div>
</div>
<!--modalend-->
    <?php require 'partials/_nav.php' ?>
    <?php
      if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Hurray!</strong> Your Note has been added successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
       }
    ?>
    
    <?php
      if($update){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Hurray!</strong> Your Note has been updated successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
       }
    ?>
    <?php
      if($delete){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Hurray!</strong> Your Note has been deleted successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
       }
    ?>
    <div class="container my-2">
    <form class="d-flex" action="note.php" method="get">
        <input class=" form-control form-control-sm me-2" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-secondary " type="submit">Search</button>
    </form>
    <div class="container my-2">
    <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
    if(isset($_GET['search'])){
      $noresults = true;
                $query = $_GET['search'];
                $sql = "select * from notes where u_no='$u_no' and match (title) against ('$query')"; 
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while($row = mysqli_fetch_assoc($result)){
                    $title = $row['title'];
                    $note = $row['note']; 
                    $u_no= $row['u_no'];
                    $s_no= $row['s_no'];
                    $noresults = false;
                    $sno = $sno + 1;
                    echo
                    "<div class='col'>".
                    "<div class='card boxx border alert  alert-dismissible fade show' >".
                        "<div class='card-header'>".
                            "<h5>".$row['title']."</h5>"."<span style='font-style: italic;font-size: x-small;'
                            >".$row['timestamp']."</span>".
                        "</div>".
                        "<div class='card-body'>".
                
                       "<p class='card-text'>".$row['note']."</p>".
                       "<button class='edit btn btn-sm btn-warning' id=".$row['s_no'].">Edit</button>&emsp;".
                       "<button class='delete btn btn-sm btn-danger' id=d".$row['s_no'].">Delete</button>".
                       " </div>".
                       "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>".
                    "</div>".
                    "</div>";
                  }
                  if ($noresults){
                    echo '
                    <div class="card alert border-primary alert-dismissible fade show">
                    <div class="card-body">
                      <p class="card-text">No Results Found.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  </div>';
                  }
    }
    ?>
    </div>
    </div>
    </div>
        <div class="container my-4">       
          <form action="/inoteproject/note.php" method="POST">
              <div class="d-flex justify-content-center">
                <h2>Add a Note</h2>
              </div>  
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" placeholder="Add title" id="title" name="title" required >
                </div>
                <div class="mb-3">
                    <label for="note">Your Note</label>
                    <textarea class="form-control" placeholder="Enter your note here" id="note" name="note" required></textarea>
                </div>  
                <button type="submit" class="btn btn-success">+Add Note</button>
            </form>  
            <div class="d-flex justify-content-center my-4">
            <h2>My Notes</h2>
            </div> 
            <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php 
          $sql = "SELECT * FROM `notes` where u_no='$u_no'";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo
            "<div class='col'>".
           /* "<div class='col-sm-6'>".*/
            "<div class='card boxx border-primary' >".
                "<div class='card-header'>".
                    "<h5>".$row['title']."</h5>"."<span style='font-style: italic;font-size: x-small;'
                    >".$row['timestamp']."</span>".
                "</div>".
                "<div class='card-body'>".
        
               "<p class='card-text'>".$row['note']."</p>".
               "<button class='edit btn btn-sm btn-warning ' id=".$row['s_no'].">Edit</button>&emsp;".
               "<button class='delete btn btn-sm btn-danger' id=d".$row['s_no'].">Delete</button>".
               " </div>".
            "</div>".
            "</div>";
          }
            ?>
            </div>
            
        </div>
    </div>  
      
    <?php require 'partials/_foot.php' ?>  

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
          des=e.target.parentNode;
          t=e.target.parentNode.parentNode;
          title=t.getElementsByTagName("h5")[0].innerText;
          note=des.getElementsByTagName("p")[0].innerText;
          console.log(title,note);
          titleEdit.value = title;
          noteEdit.value = note;
          s_noEdit.value = e.target.id;
          console.log(e.target.id);
          var myModal=new bootstrap.Modal(document.getElementById('editModal'));
          myModal.toggle();
        })
      })

      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        s_no = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/inoteproject/note.php?delete=${s_no}`;
        }
        else {
          console.log("no");
        }
      })
    })
    </script>
  </body>
</html>
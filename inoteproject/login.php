<?php
 $login=false;
 $showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    include 'partials/_dbconnect.php';
    $email=$_POST["email"];
    $username=$_POST["username"];
    $password=$_POST["password"];
    
   // $sql="Select * from users where username='$username' and password='$password'";
    $sql="Select * from users where email='$email'";
    $result=mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if($num==1)
    {
        while($row=mysqli_fetch_assoc($result))
        {
            if(password_verify($password,$row['password'])){
            $login=true;
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['email']=$email;
            header("location: note.php"); 
            }
            else{
                $showError="Invalid Credentials";
            }
        }
    }
    else{
        $showError="Invalid Credentials";
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
    <title>Log In</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($login)
    {
    echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sucess!</strong> You are logged in.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if($showError)
    {
    echo'
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> '.$showError.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <div class="container">
        <h1 class="text-center">Log in to our website</h1>
        <form action="/inoteproject/login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter your email address" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
           
            <button type="submit" class="btn btn-lg btn-secondary">Log in</button>
        </form>
    </div>
    <?php require 'partials/_foot.php' ?>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
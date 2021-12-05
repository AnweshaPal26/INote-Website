<?php
 $showAlert=false;
 $showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    include 'partials/_dbconnect.php';
    $username=$_POST["username"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $cpassword=$_POST["cpassword"];
    //$exists=false;
    $existSql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows > 0)
    {
       // $exists=true;
       $showError="Email Address already exists";
    }
    else
    {
        $exists=false;
    
        if(($password == $cpassword))
        {
            $hash= password_hash($password, PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` ( `username`,`email`, `password`) VALUES ( '$username','$email', '$hash')";
            $result=mysqli_query($conn,$sql);
            if($result)
            {
                $showAlert=true; 
            }
        }
        else{
            $showError="Passwords do not match ";
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
    <title>Sign Up</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($showAlert)
    {
    echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sucess!</strong> Your account is now created and you can login.
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
        <h1 class="text-center">Signup to our website</h1>
        <form action="/inoteproject/signup.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Your name</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your full name" required >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter your email address" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" minlength="8" name="password" 
                placeholder="Enter a password according to your choice (should be of minimum 8 character)" required>
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword"
                placeholder="Re enter your password" required>
                <div id="emailHelp" class="form-text">Make sure to type the same password</div>
            </div>
           
            <button type="submit" class="btn btn-lg btn-secondary">Sign up</button>
        </form>
    </div>




    <?php require 'partials/_foot.php' ?>

    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
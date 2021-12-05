 <?php
 if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
}
else{
  $loggedin = false;
}
 
 echo'<nav class="navbar navbar-expand-lg navbar-light ">
 <div class="container-fluid">
   <a class="navbar-brand" href="/inoteproject/index.php">INote</a>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse " id="navbarSupportedContent">
     <ul class="navbar-nav ms-auto mb-2 mb-lg-0">';
       if($loggedin){
         echo
       '<li class="nav-item">
         <a class="nav-link" href="/inoteproject/logout.php">Logout</a>
       </li>';
       }
       else{
        echo
        '<li class="nav-item ">
          <a class="nav-link" href="/inoteproject/login.php">Login</a>
        </li>';
       }
     echo '</ul>
     
   </div>
 </div>
</nav>';

  ?>

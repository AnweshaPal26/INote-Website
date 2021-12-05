<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/index.css" rel="stylesheet">
    <title>index</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <!--picture-->
    <div class="container">
      <div class="row">
        <div class="col-8">
          <h1 id="heading">Welcome to INote Website!</h1>
          <p id="description">Now you can save your important short notes securely with our INote website! You can add your notes with titles and later you can edit , delete and search your notes.Have fun with INote.....</p>
          <div class="my-5">
            <a href="login.php" class="btn btn-lg btn-secondary" role="button">Log In</a><span> &emsp;</span>
            <a href="signup.php" class="btn btn-lg btn-secondary" role="button">Sign Up</a>
          </div>
        </div>
        <div class="col-4"><img src="img/note.jpg"></div>
      </div>
    </div>
    <!--footer-->
    <?php require 'partials/_foot.php' ?>
      

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>

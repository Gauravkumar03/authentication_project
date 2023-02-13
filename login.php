<?php 

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $showErr = "";
  include 'connection.php';
  $email = $_POST['email'];
  $password = $_POST['password'];
  $login = false;

  $sql = "SELECT * FROM `new_user_data` WHERE `email`='$email' AND `password`='$password'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if($num == 1) {
      $login = true;
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['emailid'] = $email;
      header("location: welcome.php");
  }
  else {
      $showErr = 'Invalid Credentials';
  }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <style>
      /* .navbar {
        margin-bottom: 50px;
      } */
      form {
        width: 50%;
        margin: auto;
      }
      h1 {
        text-align: center;
      }
    </style>
</head>
<body>   
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Gloify</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="welcome.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signup.php">Signup</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <?php 
  if($showAlert) {

    echo '<div class="alert alert-success" role="alert">
            Success! You are now logged in!
         </div>';
   }

   if($showErr) {
       echo '<div class="alert alert-danger" role="alert">
                Invalid credentials!
            </div>';
     
   }

   ?>
  <h1>Login</h1>
  <form method="post" action="login.php">
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</body>
</html>
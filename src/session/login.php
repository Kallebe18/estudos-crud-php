<?php
  include(__DIR__.'/../database/connection.php');

  session_start();

  if ($_SESSION['user']) {
    header("Location: http://localhost/home/index.php");
  }

  $email = $_POST["email"];
  $pass = $_POST["password"];

  if ($email && $pass) {
    $sql = "SELECT email, password FROM users WHERE email=:email";
    $query = $connection->prepare($sql);
    $query->execute([ 'email' => $email ]);

    if ($query) {
      if(password_verify($pass, $query->fetch()[1])) {
        $_SESSION['user'] = $email;
        header("Location: http://localhost/home/index.php");
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
  <form action="login.php" method="POST" class="col-3 m-3">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <a href="/session/register.php">Registrar</a>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>


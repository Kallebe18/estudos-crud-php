<?php
  include(__DIR__.'/../database/connection.php');

  $email = $_POST["email"];
  $pass = $_POST["password"];

  if($email && $pass) {
    $hash_options = array('cost' => 12);
    $hash = password_hash($pass, PASSWORD_BCRYPT, $hash_options);
    $sql = "INSERT INTO users (email, `password`) VALUES (:email, :hash)";
    $query = $connection->prepare($sql);
    $query->execute([
      'email'=>$email,
      'hash'=>$hash
    ]);
    header('Location: http://localhost/session/login.php');
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
  <form action="register.php" method="POST" class="m-3 col-3">
    <div class="mb-3">
      <label for="inputEmail" class="form-label">Email address</label>
      <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="inputPassword" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="inputPassword">
    </div>
    <div class="mb-3">
      <label for="inputPasswordConfirm" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" id="inputPasswordConfirm">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <a href="/session/register.php">Logar</a>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
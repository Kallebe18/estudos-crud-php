<?php
  // RECEIVE A PIZZA DESCRIPTION AND ADD IT TO THE DATABASE 
  // A PIZZA CONTAINS - NAME, DESCRIPTION, PRICE
  include(__DIR__.'/../../database/connection.php');

  $id = $_GET['id'];

  $mysql_query = "DELETE FROM pizzas WHERE id=:id";

  $query = $connection->prepare($mysql_query);
  $query_success = $query->execute([
    'id' => $id,
  ]);

  header('Location: http://localhost/panel');
?>
<?php
  // RECEIVE A PIZZA DESCRIPTION AND ADD IT TO THE DATABASE 
  // A PIZZA CONTAINS - NAME, DESCRIPTION, PRICE
  include(__DIR__.'/../../database/connection.php');

  $request = file_get_contents('php://input');
  $body = json_decode($request);

  $name = $body->{'name'};
  $description = $body->{'description'};
  $price = number_format($body->{'price'}, 2);

  $mysql_query = "INSERT INTO pizzas (name, description, price) VALUES (:name, :description, :price)";

  $query = $connection->prepare($mysql_query);
  $query_success = $query->execute([
    'name' => $name,
    'description' => $description,
    'price' => $price
  ]);

  header("Content-type: application/json; charset=utf-8");
  if ($query_success) {
    $response = json_encode(["message" => "pizza added successfull"]);
    echo $response;
  } else {
    header("Content-type: application/json; charset=utf-8", true, 500);
    $response = json_encode([ "message" => "fail to add pizza" ]);
    echo $response;
    exit;
  }

  exit
?>
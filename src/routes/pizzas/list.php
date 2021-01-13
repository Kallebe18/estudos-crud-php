<?php
  include(__DIR__.'/../../database/connection.php');

  $request = file_get_contents('php://input');
  $max_price = (float)$_GET['max_price'];

  $mysql_query = "SELECT * FROM pizzas WHERE price < :max_price";

  $query = $connection->prepare($mysql_query);
  if($max_price) {
    $query_success = $query->execute([ 'max_price' => $max_price ]);
  } else {
    $query_success = $query->execute([ 'max_price' => 9999999 ]);
  }

  header("Content-type: application/json; charset=utf-8");
  if ($query_success) {
    $response = json_encode(["pizzas" => $query->fetchAll()]);
    echo $response;
  } else {
    header("Content-type: application/json; charset=utf-8", true, 500);
    $response = json_encode([ "message" => "fail to add pizza" ]);
    echo $response;
    exit;
  }

  exit
?>
<?php
  $request = file_get_contents('php://input');
  $body = json_decode($request);

  $params = explode('/', $_SERVER['REQUEST_URI']);

  $response = json_encode(["parameters" => $params]);
  
  header("Content-type: application/json; charset=utf-8");
  echo $response;
  exit
?>
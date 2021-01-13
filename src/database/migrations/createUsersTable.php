<?php
  include(__DIR__.'/../connection.php');
  
  $mysql_query = "CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT, 
  name VARCHAR(40), email VARCHAR(40) NOT NULL, password CHAR(60) NOT NULL, primary key (id))";
   
  if($connection->query($mysql_query)){  
    echo "Table created successfully" . PHP_EOL;  
  } else {  
    echo "Table is not created successfully " . PHP_EOL;  
  }
?>
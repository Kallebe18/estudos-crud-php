<?php
  include(__DIR__.'/../connection.php');
  
  $mysql_query = "CREATE TABLE IF NOT EXISTS pizzas (id INT AUTO_INCREMENT, 
  name VARCHAR(40) NOT NULL, description TEXT, price FLOAT(2) NOT NULL, img_link VARCHAR(60), primary key (id))";
   
  if($connection->query($mysql_query)){  
    echo "Table created successfully" . PHP_EOL;  
  } else {  
    echo "Table is not created successfully " . PHP_EOL;  
  }
?>
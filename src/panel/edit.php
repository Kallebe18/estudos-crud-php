<?php
  $id = $_GET['id'];
  $name = $_GET['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <h1 class="m-2">Pizza: <?= $name ?></h1>
  <form onsubmit="handleSubmitEditPizza(event, <?= $id ?>)" action="/routes/pizzas/create.php" method="POST" class="m-3 col-6">
    <div class="form-group">
      <label for="name">Name</label>
      <input id="pizza-name" type="text" name="name" class="form-control">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <input id="pizza-desc" type="text" name="description" class="form-control">
    </div>
    <div class="form-group">
      <label for="price">Price</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">$</span>
        </div>
        <input id="pizza-price" type="number" name="price" class="form-control" min="0" step="any">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Adicionar</button>
  </form>
  <form action="/routes/pizzas/upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="hidden" name="id" value="<?= $id ?>" >
    <input type="submit" value="Upload Image" name="submit">
  </form>

  <script>
    function handleSubmitEditPizza(e, id) {
      e.preventDefault();
      const pizzaName = document.getElementById('pizza-name').value;
      const pizzaDesc = document.getElementById('pizza-desc').value;
      const pizzaPrice = document.getElementById('pizza-price').value;
      const xmlhttp = new XMLHttpRequest();

      const body = JSON.stringify({id, name: pizzaName, description: pizzaDesc, price: pizzaPrice});

      xmlhttp.open('POST', 'http://localhost/routes/pizzas/edit.php');
      xmlhttp.send(body);
    }
  </script>
</body>
</html>

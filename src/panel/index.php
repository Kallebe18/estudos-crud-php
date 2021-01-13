<?php
  session_start();
  if ($_SESSION['user'] !== 'admin@gmail.com') {
    header('Location: http://localhost/session/login.php');
  };
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
  <header class="bg-secondary p-3">
    <h3>Bem vindo <?= $_SESSION['user'] ?></h3>
    <form action="/session/logout.php">
      <button class="btn btn-primary" type="submit">Sair</button>
    </form>
  </header>
  <section class="m-2 p-3">
    <h2>Aqui voce pode editar e adicionar novas pizzas</h2>
  </section>
  <form onsubmit="handleSubmitAddPizza(event)" action="/routes/pizzas/create.php" method="POST" class="m-3 col-6">
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
  <ul id="lista-de-pizzas" class="d-flex flex-row flex-wrap">
  </ul>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script>
    let currentPizzaEdit = 0;

    function loadList(max_price='') {
      const xmlhttp = new XMLHttpRequest()
      xmlhttp.onload = function() {
        const pizzaList = document.getElementById('lista-de-pizzas');
        const response = JSON.parse(this.response);
        const pizzas = response.pizzas;
        document.getElementById('lista-de-pizzas').innerHTML = '';
        console.log(pizzas);
        pizzas.forEach((pizza) => {
          document.getElementById('lista-de-pizzas').innerHTML += `
          <div class="card m-2" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">${pizza.name}</h5>
              <img class="card-img-top" src="/img/pizzas/${pizza.img_link}" alt="Card image cap">
              <p class="card-text">${pizza.description}</p>
              <p class="card-text">R$ ${pizza.price}</p>
              <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
              <a href="http://localhost/panel/edit.php?id=${pizza.id}&name=${pizza.name}" class="btn btn-warning m-2">
                <i class="bi-pen"></i>
              </a>
              <a href="/routes/pizzas/delete.php?id=${pizza.id}" class="btn btn-danger m-2">
                <i class="bi-x"></i>
              </a>
            </div>
          </div>
          `
        })
      }
      xmlhttp.open('GET', `http://localhost/routes/pizzas/list.php?max_price=${max_price}`);
      xmlhttp.send();
    }

    function handleFilteredLoadList(e) {
      e.preventDefault();
      const max_price = document.getElementById('pizza-price').value
      loadList(max_price)
    }

    function handleSubmitAddPizza(e) {
      e.preventDefault();
      const pizzaName = document.getElementById('pizza-name').value;
      const pizzaDesc = document.getElementById('pizza-desc').value;
      const pizzaPrice = document.getElementById('pizza-price').value;
      const xmlhttp = new XMLHttpRequest()
      xmlhttp.onload = function() {
        loadList();
      }

      const body = JSON.stringify({name: pizzaName, description: pizzaDesc, price: pizzaPrice});
      console.log(body)
      xmlhttp.open('POST', 'http://localhost/routes/pizzas/create.php');
      xmlhttp.send(body);
    }

    loadList()
  </script>
</body>
</html>
<?php
  session_start();
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
  <header class="bg-secondary p-3 d-flex justify-content-lg-between">
    <h3>Bem vindo <?= $_SESSION['user'] ?></h3>
    <div style="width: 200px;" class="d-flex justify-content-lg-between">
      <form action="/session/logout.php">
        <button class="btn btn-primary" type="submit">Sair</button>
      </form>
      <?php if($_SESSION['user'] === 'admin@gmail.com'): ?>
        <form action="/panel/index.php">
          <button class="btn btn-warning" type="submit">Painel</button>
        </form>
      <?php endif; ?>
    </div>
  </header>
  <section class="m-2 p-3">
    <h2>As melhores pizzas da sua região</h2>
  </section>
  <main>
    <div class="input-group m-2">
      <div class="input-group-prepend">
        <span class="input-group-text">$</span>
      </div>
      <input placeholder="Preço máximo" id="pizza-price" type="number" name="price" class="form-control" min="0" step="any">
      <button class="btn btn-primary input-group-addon mr-4" onclick="handleFilteredLoadList(event)">Filtrar</button>
    </div>
    </form>
    <ul id="lista-de-pizzas" class="d-flex flex-row flex-wrap"></ul>
  </main>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script>
    function loadList(max_price=null) {
      const xmlhttp = new XMLHttpRequest()
      xmlhttp.onload = function() {
        const pizzaList = document.getElementById('lista-de-pizzas');
        const response = JSON.parse(this.response);
        const pizzas = response.pizzas;
        document.getElementById('lista-de-pizzas').innerHTML = '';
        pizzas.forEach((pizza) => {
          document.getElementById('lista-de-pizzas').innerHTML += `
          <div class="card m-2" style="width: 18rem;">
            <div class="card-body">
              <img class="card-img-top" src="/img/pizzas/${pizza.img_link}" alt="Card image cap">
              <h5 class="card-title">${pizza.name}</h5>
              <p class="card-text">${pizza.description}</p>
              <p class="card-text">R$ ${pizza.price}</p>
              <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
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
      console.log(e)
      const max_price = document.getElementById('pizza-price').value
      loadList(max_price)
    }

    loadList()
  </script>
</body>
</html>
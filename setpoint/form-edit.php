<?php
require 'init.php';

// pega o ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

// valida o ID
if (empty($id))
{
    echo "ID para alteração não definido";
    exit;
}

// busca os dados do registro a ser editado
$PDO = db_connect();
$sql = "SELECT nome, valor, date_alt, date_fim, tag_ref, area FROM setpoint_db WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

// se o método fetch() não retornar um array, significa que o ID não corresponde a um usuário válido
if (!is_array($user))
{
    echo "Nenhum registro encontrado";
    exit;
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">

        <title>Edição de parâmetro - Dohlerpi Setpoint</title>

            <link href="css/bootstrap.min.css" rel="stylesheet">

    </head>

    <body>
      <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Dohlerpi Setpoint</a>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <ul class="navbar-nav px-3">
          <li class="nav-item text-nowrap">
            <a class="nav-link" href="#">Sign out</a>
          </li>
        </ul>
      </nav>

      <div class="container-fluid">
        <div class="row">
          <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" href="index.php">
                    <span data-feather="home"></span>
                    Dohlerpi Setpoint <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php">
                    <span data-feather="file"></span>
                    Home
                  </a>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span data-feather="bar-chart-2"></span>
                    Dohlerpi
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span data-feather="users"></span>
                    Menu do usuário
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span data-feather="layers"></span>
                    Manutenção
                  </a>
                </li>
              </ul>

              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Saved reports</span>
                <a class="d-flex align-items-center text-muted" href="#">
                  <span data-feather="plus-circle"></span>
                </a>
              </h6>
              <ul class="nav flex-column mb-2">
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Em brancos
                  </a>
                </li>
              </ul>
            </div>
          </nav>
          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
              <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
        <h1>Dohlerpi Setpoint</h1>
                </div>

              </div>
            </div>




        <h2>Edição de parâmetro</h2>

        <form action="edit.php" method="post">
            <label for="nome">Nome: </label>
            <br>
            <input type="text" name="nome" id="nome" value="<?php echo $user['nome'] ?>">

            <br><br>

            <label for="valor">Valor: </label>
            <br>
            <input type="text" name="valor" id="valor" value="<?php echo $user['valor'] ?>">

            <br><br>

            <label for="tag_ref">TAG de Referência: </label>
            <br>
            <input type="text" name="tag_ref" id="tag_ref" value="<?php echo $user['tag_ref'] ?>">

            <br><br>

            <label for="area">Area / Linha: </label>
            <br>
            <input type="text" name="area" id="area "value="<?php echo $user['area'] ?>">

            <br><br>

            <label for="date_alt">Data Inicio & Data final do parâmetro: </label>
            <br>
            <input type="datetime-local" name="date_alt" id="date_alt" value="<?php echo dateConvert ($user['date_alt']) ?>">
            <input type="datetime-local" name="date_fim" id="date_fim" value="<?php echo dateConvert ($user['date_fim']) ?>">

            <br><br>

            <input type="hidden" name="id" value="<?php echo $id ?>">

            <input type="submit" value="Alterar">
        </form>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-slim.min.js"><\/script>')</script>
        <script src="js/vendor/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <!-- Icons -->
        <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
        <script>
          feather.replace()
        </script>
    </body>
</html>

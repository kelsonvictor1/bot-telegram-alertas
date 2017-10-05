<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Últimos 15 cadastros</h2>          
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Evento</th>
        <th>Operador</th>
        <th>Data/Hora de Cadastro</th>
      </tr>
    </thead>
    <tbody>

    <?php

    require_once '../galaxy/saturno-pdo.php';

        $sql = "SELECT nome,operador,timestamp FROM eventos ORDER BY id DESC LIMIT 15";

        $q = $conn->query($sql);

        foreach ($q as $row) {

            echo "

                  <tr>
        <td>".$row["nome"]."</td>
        <td>".$row["operador"]."</td>
        <td>".$row["timestamp"]."</td>
      </tr>



            ";

        }

        ?>

    </tbody>
  </table>
</div>

</body>
</html>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><center><img src="loading1.gif" /></center>

<?php

include("functions.php");


$banco = ["mysql.hostinger.com.br", "u487330816_banco", "NGnaRDxbAfC7", "u487330816_banco"];


$con=mysqli_connect($banco[0],$banco[1],$banco[2],$banco[3]); 

$nome = mysqli_real_escape_string($con, $_POST["nome"]);

$operador = mysqli_real_escape_string($con, $_POST["operador"]);

$data1 = mysqli_real_escape_string($con, $_POST["data"]);

$hora = mysqli_real_escape_string($con, $_POST["hora"]);


$data2 = substr($data1, 8, 2)."/".substr($data1, 5, 2)."/".substr($data1, 0, 4);

$hora = substr($data1, 11,5);

#echo $data2;
#echo "<br/>";
#echo $hora;

armazenaEventoAlerta($nome, $operador, $data2, $hora); 







?>
<?php

function status(){


include '../galaxy/saturno-pdo.php';

 $sql = "SELECT status1,status2 FROM alertas WHERE id_evento = 45";

 $q = $conn->query($sql);


 foreach ($q as $row) {

 	echo $row["status1"]."<br/>".$row["status2"];




}




}
 


?>


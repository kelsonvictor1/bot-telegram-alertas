<?php

$data = "30/06/2019";


$dd = substr($data, 0, 2);
$mm = substr($data, 3, 2);
$aaaa = substr($data, 6, 4);

echo $dd."<br/>";
echo $mm."<br/>";
echo $aaaa;


incrementa24Horas($dd, $mm, $aaaa);


function incrementa24Horas($dd, $mm, $aaaa){
 
	if(mesesComTrinta($mm) == false){ // PARA FEVEIREIRO E MESES COM 31 DIAS

		if($mm == "02" and $dd == "28" ){

			$dd = "01";
			$mm = $mm + 1;
			if(strlen($mm) == 1){
				$mm = "0".$mm;
			}

		}elseif($dd == "31"){
			$dd = "01";
			if ($mm == "12"){
				$mm = "01";
				$aaaa = $aaaa + 1;
			}else{

			$mm = $mm + 1;
			if(strlen($mm) == 1){
				$mm = "0".$mm;
			}	
			}
			
		}else{
			$dd = $dd + 1;
			if(strlen($dd) == 1){
				$dd = "0".$dd;
			}
		}

		if($dd == "31" and $mm == "12"){
			$aaaa = $aaaa + 1;
		}

		echo "<br/> Incrementado:  ".$dd."/".$mm."/".$aaaa;

	}else{ // PARA MESES COM 30 DIAS
 

		if($dd == "30"){
			$dd = "01";
			$mm = $mm + 1;
			if(strlen($mm) == 1){
				$mm = "0".$mm;
			}
		}else{
			$dd = $dd + 1;
			if(strlen($dd) == 1){
				$dd = "0".$dd;
			}

		}

		echo "<br/> Incrementado2:  ".$dd."/".$mm."/".$aaaa;

	}
}

function mesesComTrinta($mm){

	$meses = array("04", "06", "09", "11");

	if(in_array($mm, $meses)){
		return true;
	}else{
		return false;
	}

}
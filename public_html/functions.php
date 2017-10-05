<?

##############################################################################################
######################## PROCESSAMENTO #######################################################
##############################################################################################

function getStatus(){

 require_once '../galaxy/saturno-pdo.php';

 $sql = "SELECT status1,status2 FROM alertas WHERE id_evento = 45";

 $q = $conn->query($sql);


 foreach ($q as $row) {

 	echo $row["status1"]."<br/>".$row["status2"];




}


	
}



##############################################################################################
######################### ARMAZENAMENTO ######################################################
##############################################################################################


function armazenaEventoAlerta($nome, $operador, $data, $hora){

		require_once '../galaxy/saturno-pdo.php';

		$timestamp = pegaHora(); 

		$sql = "INSERT INTO eventos (nome, operador, data, hora, timestamp) VALUES (:nome, :operador, :data, :hora, :timestamp)";
		$q = $conn->prepare($sql);
		$q->execute(array(
			':nome'=>$nome,
			':operador'=>$operador,
			':hora'=>$hora,
			':data'=>$data,
			':timestamp'=>$timestamp

			));

		$id_evento = $conn->lastInsertId();

		$dd = substr($data, 0, 2);
		$mm = substr($data, 3, 2);
		$aaaa = substr($data, 6, 4);

		

		#incrementa24Horas($dd, $mm, $aaaa);

		#echo "<br/>Dataa:  ".incrementa24Horas($dd, $mm, $aaaa);

		$dataIncrementada = incrementa24Horas($dd, $mm, $aaaa);

		#echo $dataIncrementada;

		$sql = "INSERT INTO alertas (id_evento, data, hora) VALUES (:id_evento, :dataIncrementada, :hora)";
		$q = $conn->prepare($sql);
		$q->execute(array(
			':id_evento'=>$id_evento,
			':dataIncrementada'=>$dataIncrementada,
			':hora'=>$hora

			));



		echo '<meta http-equiv="refresh" content=1;url="form.php?alert=cadastrado">';

}



function incrementa24Horas($dd, $mm, $aaaa){
 
	if(mesesComTrinta($mm) == false){ // PARA FEVEIREIRO E MESES COM 31 DIAS

		if($mm == "02" and $dd == "28" ){ // FIM DE FEVEREIRO

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

		#echo "<br/> Incrementado:  ".$dd."/".$mm."/".$aaaa;
		$dataIncrementada = $dd."/".$mm."/".$aaaa;

		return $dataIncrementada;

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

		#echo "<br/> Incrementado2:  ".$dd."/".$mm."/".$aaaa;
		$dataIncrementada = $dd."/".$mm."/".$aaaa;
		return $dataIncrementada;

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

function pegaHora(){

error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1);

date_default_timezone_set("America/Sao_Paulo");

/* Query a time server (C) 1999-09-29, Ralf D. Kloth (QRQ.software) <ralf at qrq.de> */
function query_time_server ($timeserver, $socket)
{
    $fp = fsockopen($timeserver,$socket,$err,$errstr,5);
        # parameters: server, socket, error code, error text, timeout
    if($fp)
    {
        fputs($fp, "\n");
        $timevalue = fread($fp, 49);
        fclose($fp); # close the connection
    }
    else
    {
        $timevalue = " ";
    }

    $ret = array();
    $ret[] = $timevalue;
    $ret[] = $err;     # error code
    $ret[] = $errstr;  # error text
    return($ret);
} # function query_time_server


$timeserver = "time-c.nist.gov";
$timercvd = query_time_server($timeserver, 37);

//if no error from query_time_server
if(!$timercvd[1])
{
    $timevalue = bin2hex($timercvd[0]);
    $timevalue = abs(HexDec('7fffffff') - HexDec($timevalue) - HexDec('7fffffff'));
    $tmestamp = $timevalue - 2208988800; # convert to UNIX epoch time stamp
    $datum = date("Y-m-d (D) H:i:s",$tmestamp - date("Z",$tmestamp)); /* incl time zone offset */
    $doy = (date("z",$tmestamp)+1);

    #echo "Time check from time server ",$timeserver," : [<font color=\"red\">",$timevalue,"</font>]";
    #echo " (seconds since 1900-01-01 00:00.00).<br>\n"; 
    #echo "The current date and universal time is ",$datum," UTC. ";
    #echo "It is day ",$doy," of this year.<br>\n";
    #echo "The unix epoch time stamp is $tmestamp.<br>\n";


    return date("d/m/Y H:i:s", $tmestamp);
}
else
{
    #echo "Unfortunately, the time server $timeserver could not be reached at this time. ";
    #echo "$timercvd[1] $timercvd[2].<br>\n";
}



} 
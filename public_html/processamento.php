  <meta charset="UTF8" />

    <?php

    $diaHora = pegaHora();

    alerta30min($diaHora);

    alerta11pm($diaHora);


    function alerta11pm($diaHora){

    	$diaAtual = substr($diaHora, 0,10);
        $horaAtual =  substr($diaHora,11,5);


        if(diffTime($horaAtual, "23:00:00") < 5 and diffTime($horaAtual, "23:00:00") > -2 ){

        	enviaAlerta("ATENÇÃO PLANTONISTA: Verificar se todos os jogos adiados/abandonados foram adicionados ao bot. Grato. Boa noite! (:");
        } 




    }

    function alerta30min($diaHora){

        $diaAtual = substr($diaHora, 0,10);
        $horaAtual =  substr($diaHora,11,5);


        require_once '../galaxy/saturno-pdo.php';

        $sql = "SELECT id_evento FROM alertas WHERE data = '$diaAtual'";

        $q = $conn->query($sql);

        $ids =  array();

        foreach ($q as $row) {

            array_push($ids, $row['id_evento']);

        }

        foreach ($ids as $key) {

            $sql = "SELECT id,nome,data,hora FROM eventos WHERE id = $key";

            $q = $conn->query($sql);

            foreach ($q as $row) {


                if(diffTime($horaAtual, $row["hora"]) < 31 and diffTime($horaAtual, $row["hora"]) > 5){



                    if(status("1", $row["id"]) != "STATUS_1"){

                        enviaAlerta("[PRIMEIRO AVISO] ATENÇÃO: Cancelar o resultado do evento ".strtoupper($row["nome"])." às ".$row["hora"]. " caso não tenha ocorrido.");

                        $sql2 = "UPDATE alertas SET status1 = 'OK' WHERE id_evento = ".$row["id"];

                        $q2 = $conn->exec($sql2);



                    }


            }

             if(diffTime($horaAtual, $row["hora"]) < 6){
               

                if(status("2", $row["id"]) != "STATUS_2"){


                    enviaAlerta("[ÚLTIMO AVISO] ATENÇÃO: Cancelar o resultado do evento ".strtoupper($row["nome"])." às ".$row["hora"]. " caso não tenha ocorrido.");

                    $sql2 = "UPDATE alertas SET status2 = 'OK' WHERE id_evento = ".$row["id"];

                    $q2 = $conn->exec($sql2); 


                }


            }




        }

    }

}




function status($status, $id_evento){


    include '../galaxy/saturno-pdo.php';

    $sql = "SELECT status1,status2 FROM alertas WHERE id_evento = $id_evento";

    $q = $conn->query($sql);


    foreach ($q as $row) {

        if($status == "1" and $row["status1"] == 'OK'){
            return "STATUS_1";

        }
        if($status == "2" and $row["status2"] =='OK'){

          #  echo "aqui?";
            return "STATUS_2";

        }




    }

}

function enviaAlerta($mensagem){

    $token = "bot412315291:AAHZu9sVpfs_gwKluPyDAKDQV6STQ-Vo-8g";
    $chatid = "-191300466";
    sendMessage($chatid,$mensagem,$token);

}

function sendMessage($chatID, $messaggio, $token) {
    echo "sending message to " . $chatID . "\n";


    $url = "https://api.telegram.org/" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
        );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
}

function diffTime($hora1, $hora2){

    $time = $hora1;
    $seconds = strtotime("1970-01-01 $time UTC");
    # echo $seconds."<br/>";


    $time2 = $hora2;
    $seconds2 = strtotime("1970-01-01 $time2 UTC");
    # echo $seconds2."<br/>";

    return ($seconds2 - $seconds) / 60;


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
} 


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

<meta charset='UTF8' />

<?php

#header("Content-Type: application/json");

$url = "https://api.telegram.org/bot361550708:AAHOojGX5PJLi4LpTbaVrbT4scKQuFX8Ys0/getUpdates";
$json = file_get_contents($url);


#$qtd = substr_count($json, '"text":');


$posicao = strrpos($json, '"text":');

echo substr($json, $posicao+7, -4); 


function pegarUltimoTexto(){

	$posicao = strrpos($json, '"text":');

	echo substr($json, $posicao+7, -4); 
}

function verificarUltimoUpdateID(){

}



#for ($i = 1; $i <= $qtd ; $i++) { 
#    echo "oi"."<br/>";
#}




/*$data = json_decode($json, TRUE);


echo $data['']

foreach ($data as $indiceDoArray) {
    #echo "Elemento na posição {$indiceDoArray} tem valor {$valorDoArray}<br>";

    echo $indiceDoArray."<br/>"; 
}



#echo $json;

#$data = json_decode($json, TRUE);

#echo $data->text;


#echo json_encode($data);

/*
$needle   = 'fr243f4';

$pos      = strripos($json, $needle);

if ($pos === false) {
    echo "Sinto muito, nós não encontramos";
} else {
    echo "Parabéns!\n";
}




/*$json = array
(
    'text' => $_GET['text']
);

foreach($results['json'] as $result) {
    echo $result['json'], '<br>';
}



/*$json_data = json_decode($json, true);
#echo $json_data;


foreach ($json_data as $value) {
    echo $value;
}*/

?>
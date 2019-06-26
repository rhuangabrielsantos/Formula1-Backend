<?php

//$carro = array(
//    'id'   => '002',
//    'piloto'     => 'Rhuan',
//    'marca' => 'Ferrari',
//    'modelo' => 'AA',
//    'cor' => 'Red',
//    'ano' => '2019'
//);
//
//$dados_json = json_encode($carro);
//
//$fp = fopen("carros.json", "a");
//
//$escreve = fwrite($fp, $dados_json);
//
//fclose($fp);

$arquivo = file_get_contents('carros.json');

// Decodifica o formato JSON e retorna um Objeto
$json = json_decode($arquivo);
unlink("carros.json");

$json[] = [
    'codigo' => '006',
    'nome' => 'Radsdan',
    'telefone' => '448877445577'
];

$json = json_encode($json);

$fp = fopen("carros.json", "a");

$escreve = fwrite($fp, $json);
fclose($fp);

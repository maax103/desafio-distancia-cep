<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

echo json_encode([
    'id' => 1,
    'cep1' => $_POST['cep1'],
    'cep2' => $_POST['cep2'],
    'data_cadastro' => '29/06/2024 21:20',
    'data_alteracao' => '29/06/2024 21:21',
]);
?>
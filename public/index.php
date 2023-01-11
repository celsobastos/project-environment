<?php

/**
 * @file
 * Dd safasdf asdfasd.
 */

require __DIR__ . '/../vendor/autoload.php';

use Celso\Environment\Structure\UserMapper;

// $dotenv = new Dotenv();
// $dotenv->load(__DIR__ . '/../.env');
// environment:
// USUARIO: 'root'
// SENHA: 'password'
// JDBC_CONNECTION_STRING: 'jdbc:mysql://beanstalk_mysql:3306/casadocodigo'.
// $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
// $dotenv->load();
// $s3_bucket = getenv('DB_HOST');
// echo 'Test: ' . $s3_bucket;
// echo '<pre>';
// $env = getenv();
// print_r($env);
// echo '<hr>';
// print_r($_ENV);
// echo '<hr>';
// print_r($_SERVER);
// exit;
// Try {
//     $x = 80 / 0;
//     echo $x;
// }
// catch(DivisionByZeroError $e) {
//     echo $e->getMessage();
// }
// ini_set('memory_limit', '-1');
// $flatArray = new ProfileAnalisePerformance(
//     [
//         [1717171,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,0],
//         [1,2],
//         [3,4],
//         [5,6],
//         [7,8],
//         [9,777],
//     ]
// );.
// foreach($flatArray as $key => $all) {
//     echo '<br>';
//     echo $key . '<hr>';
//     foreach($all as $item) {
//         echo $item . ', ';
//     }
// }.
// die;.
// Echo phpinfo();
// exit;
// xdebug_info();
// $cliente = new Cliente(
//     '123456788/0001',
//     'Bastos',
//     new Endereco('123', 'Rua das Flores', '08050-58')
// );
// $cliente->addFone(new Fone('011', '92545-2222'));
// $cliente->addFone(new Fone('011', '4714-3333'));
// echo '<pre>';
// var_dump($cliente);
// echo '<hr>';
// exit;
// Process new salario
// $salario = new ProcessSalario();
// $estagiario = new Estagiario(
//     'Pablo Scobar',
//     1530.52,
//     new Endereco(
//         '123',
//         'Rua das Flores',
//         '08050-58',
//     )
// );.
// $estagiario->addFone(new Fone('011', '92545-2222'));
// $estagiario->addFone(new Fone('011', '4714-3333'));
// $newSalario = $salario->calcSalario(funcionario: $estagiario);
// echo "New Salario: " . $newSalario;
// echo '<pre>';
// print_r($estagiario);
// echo '<hr>';
// // Search data base.
$users = (new UserMapper())->all();

foreach ($users as $user) {
  echo $user->getName() . '<br>';
}
echo '<pre>';
var_dump($users);

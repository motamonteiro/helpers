<?php

require_once __DIR__ . '/../vendor/autoload.php';

$api = new \MotaMonteiro\Helpers\ApiHelper();
$api->setTokenKey('PORTAL_TOKEN_DEV');
$data = ['nme_email' => 'test@test.com', 'nme_senha' => 'secret'];

$resposta = $api->request('http://localhost:8001/api/login', 'POST', $data, 'f9deab02e02646e698ac6026c7429ac4');

if ($api->existsRequestError()) {
    $error = $api->getRequestErrorArray();

    if ($error['status_code'] == 500) {
        echo 'send  mail to server responsable<br>';
    } else {
        echo 'send  mail to api responsable<br>';
        echo $error['status_code'] . '<br>';
        echo $error['messages'][1];
    }
    exit;

}

echo 'StatusCode OK:' . $resposta['header_code'] . '<br>';
echo 'Json:' . '<br>';
print_r($resposta['json']);

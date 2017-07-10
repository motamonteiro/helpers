<?php

require_once __DIR__ . '/../vendor/autoload.php';

$api = new \MotaMonteiro\Helpers\ApiHelper('http://localhost:8000/api/', 'Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiYWRtaW4iOnRydWV9.TJVA95OrM7E2cBab30RMHrHDcEfxjoYZgeFONFh7HgQ');

$data = ['login' => 'test_user', 'mail' => 'test@test.com', 'password' => 'secret'];

$resposta = $api->request('user', 'POST', $data);

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
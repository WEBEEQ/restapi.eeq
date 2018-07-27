<?php
declare(strict_types = 1);

require('../lib/core.php');

use Library\TopPerson\Order;

$data = array();

$data['name'] = 'Imię';
$data['surname'] = 'Nazwisko';
$data['province'] = 1;
$data['city'] = 1;
$data['description'] = 'Opis.';

$response = Order::addUser($data);
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8" />
        <title>Add User</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>Add User</h1>
            </div>
<?php
if ($response['code'] == 200 && $response['response']['success']) {
?>
            <div class="alert alert-success">SUCCESS</div>
<?php
} else {
?>
            <div class="alert alert-danger">DEFEAT</div>
<?php
}

if ($response['response']['message']) {
?>
            <pre><?php echo str_replace("\r\n", '<br />', $response['response']['message']); ?></pre>
<?php
}
?>
            <h1>Request</h1>
            <div>
<?php
var_dump($data);
?>
            </div>
            <h1>Response</h1>
            <div>
<?php
var_dump($response);
?>
            </div>
        </div>
    </body>
</html>

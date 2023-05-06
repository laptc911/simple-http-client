<?php

require_once 'src/Http/Client.php';

use Http\Client;

/**
 * Submit assessment.
 */
function submitAssessment()
{
    $tokenResponse = Client::options('https://corednacom.corewebdna.com/assessment-endpoint.php');

    $response = Client::post(
        'https://corednacom.corewebdna.com/assessment-endpoint.php',
        [
            'name' => 'Lap Truong',
            'email' => 'laptc@smartosc.com',
            'url' => 'https://github.com/laptc911/simple-php-http-client',
        ],
        [
            'Authorization' => 'Bearer ' . $tokenResponse->getBody(),
            'content-type' => 'application/json',
        ]
    );
    echo '<pre>';
    print_r($response->getHeaders());
    print_r($response->getBody());
    echo '</pre>';
}

$hasResponse = false;
try {
    if (!empty($_POST["method"]) && !empty($_POST["url"])) {
        $payload = "";
        $headers = [];
        if (!empty($_POST["custom_header"])) {
            $headers = json_decode($_POST['custom_header'], true);
        }
        if (!empty($_POST["request_body"])) {
            try {
                $payload = json_decode($_POST['request_body'], true);
                if (!$payload) {
                    $payload = $_POST['request_body'];
                }
            } catch (\Exception $e) {
                $payload = $_POST['request_body'];
            }
        }
        $response = Client::send($_POST["method"], $_POST["url"], $payload, $headers);
        $hasResponse = true;
    }
} catch (\Exception $e) {
    echo '<pre>';
    print_r($e);
    echo '</pre>';
}
?>
<?php if ($hasResponse && isset($response)) : ?>
    <h1>Response headers:</h1>
    <pre>
        <?php print_r($response->getHeaders()) ?>
    </pre>
    <h1>Response body:</h1>
    <pre>
        <?php print_r($response->getBody()) ?>
    </pre>
<?php else : ?>
    <h1>Simple HTTP Client</h1>
    <form action="/index.php" method="POST">
        <label for="method">Method</label>
        <select id="method" name="method">
            <option value="GET">GET</option>
            <option value="POST">POST</option>
            <option value="PUT">PUT</option>
            <option value="DELETE">DELETE</option>
            <option value="HEAD">HEAD</option>
            <option value="OPTIONS">OPTIONS</option>
        </select><br>
        <label for="url">URL</label>
        <input type="url" id="url" name="url" required><br>
        <label for="request_body">Request Body</label>
        <input type="text" id="request_body" name="request_body" placeholder="text/json string"><br>
        <label for="custom_header">Custom Header</label>
        <input type="text" id="custom_header" name="custom_header" placeholder="json string"><br>
        <button type="submit">Send</button>
    </form>
<?php endif; ?>
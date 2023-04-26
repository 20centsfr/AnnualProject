<?PHP
function sendMessage() {
    $heading = array(
        "fr" => 'Together&Stronger'
    );

    $content = array(
        "fr" => 'Merci de votre confiance.'
    );

    $fields = array(
        'app_id' => "520b99ae-d13d-4591-b03d-07dc5d11d02b",
        'included_segments' => array('Subscribed Users'),
        'data' => array("foo" => "bar"),
        'contents' => $content,
        'headings' => $heading
    );
    
    $fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic ZDJhNjcyMDgtODgzZC00ODk3LWI2YTMtZDkxNjE5NmRiMmFm'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}

$response = sendMessage();
$return["allresponses"] = $response;
$return = json_encode($return);

$data = json_decode($response, true);
print_r($data);
$id = $data['id'];
print_r($id);

print("\n\nJSON received:\n");
print($return);
print("\n");
?>
<?PHP

$auth = base64_encode('admin:admin');
$header = array("Authorization: Basic $auth");
$postData = array('idAsset'=>strval ('6734189'), 'IdVerizon'=>strval ('123456789'), 'estatus'=>strval ('completo'), 'programa'=>strval ('entretenimiento'));
$context = stream_context_create(array(
    'http' => array(
        'method' => 'POST',
        'header' => $header,
        'content' => json_encode($postData)
        )
    )
);
$response = file_get_contents('http://10.67.58.96/ApiIungoDalet/api/v2/ApiIungoVerizonBS/', FALSE, $context);
//echo ($response);
$responseData = json_decode($response, TRUE);
var_dump($responseData);
//echo ($responseData);

?>
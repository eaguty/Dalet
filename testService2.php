<?PHP

//$header = array("Authorization: Basic $auth");
$host= "http://ip/ApiIungoDalet/api/v2/ApiIungoVerizonBS/";
$postData = json_encode(array('idAsset'=>intval('6734189'), 'IdVerizon'=>strval ('123456789'), 'estatus'=>strval ('completo'), 'programa'=>strval ('entretenimiento')));
$ch = curl_init($host);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_USERPWD,"admin:admin");
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$return = curl_exec($ch);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
$body = substr($response, $header_size);
//echo $return;
curl_close($ch);
//echo $return;
echo($body);







/*$url = 'http://10.64.95.191:30204/api/v2/ApiIungoVerizonBS/';

//create a new cURL resource
$ch = curl_init($url);

//setup request to send json via POST
$data = array(
    'username' => 'admin',
    'password' => 'admin'
);
$payload = json_encode(array('idAsset'=>strval ('6734189asdf'), 'IdVerizon'=>strval ('123456789'), 'estatus'=>strval ('completo'), 'programa'=>strval ('entretenimiento')));

curl_setopt($ch, CURLOPT_USERPWD,"admin:admin");
//attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

//set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

//return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//execute the POST request
$result = curl_exec($ch);


//close cURL resource
curl_close($ch);
echo $result;*/
?>
<?PHP

include("Videos.php");

$videos = new Video();

$video = $videos->obtenerVideosNuevos();

foreach ($video as $asset ) {
        //echo $asset->name;
        $media= new Video();
        $media=$asset;
        logging($media->getName());
        $instruccion='sh /home/videoonline/uplynk_slicer2/envioVideo.sh '.$media->getPath() .' '. $media->getName();
        $media->actualizarEstado("UPLOADING");
        exec($instruccion, $respuesta);
        foreach ($respuesta as $value) {
                echo "\n".$value;
                if($value == 'Slicing and encoding done'){
                        echo "\n **********************************************Proceso Finalizado **********************************************\n";
                        logging("Uploaded to Verizon");
                        $file = fopen($media->getIdfile(), "r") or exit("Unable to open file!");
                        $id=trim(fgets($file));
                        echo "\nidVerizon: ".$id."\n";
                        $media->actualizarIdVerizon($id);
                        $videoId = explode(".", $media->getName());
                        $auth = base64_encode('admin:admin');
                        $header = array("Authorization: Basic $auth");
                        //$postData = array('NEGOCIO'=>strval ('NOTICIAS'), 'OPERACION'=>strval ('ACTUALIZAR'), 'VIDEOID'=>strval ($videoId[0]), 'ENTRYID'=>strval ($id));
                        $context = stream_context_create(array(
                            'http' => array(
                                'method' => 'GET',
                                'header' => $header
                                //'content' => json_encode($postData)
                            )
                        ));
                        $response = file_get_contents('http://10.64.95.191:30204/api/v2/ApiIungoVerizonBS/', FALSE, $context);
                        //logging($response);
                        $responseData = json_decode($response, TRUE);
                        logging($responseData['mensaje']);
                        if($response === FALSE){
                            die('Error');
                            logging("error al mandar POST");
                            $media->actualizarEstado("ERROR_POST");
                        }
                        elseif($responseData['mensaje'] == "Registro exitoso."){
                                $instruccion = "mv ".$media->getPath()." /media/verizon/videosAMZ/uploaded/";
                                exec($instruccion, $resp);
                                print_r($resp);
                                //logging($resp);
                                $media->actualizarEstado("UPLOADED");
                        }
                        else{
                                $media->actualizarEstado("ERROR_POST");
                        }

                        print_r($responseData);
                }
        }

}


function logging($message){
          $logmessage =  '[' . date('Y-m-d h:i:s') ." ". $message. "\n";
         error_log($logmessage, 3,  '/opt/Alexa/logs/logUploadVerizon.log');
      }
?>

<?php

include("conexion.php");

class Video {

        private $idvideos;
        private $name;
        private $porcentaje;
        private $estado;
        private $id_verizon;
        private $fecha;
        private $cuenta;
        private $path;
        private $idfile;

        /*public function __construct($idvideos, $name, $porcentaje, $estado, $id_verizon, $fecha, $cuenta, $path, $idfile){

                $this->idvideos= $idvideos;
                $this->name= $name;
                $this->porcentaje= $porcentaje;
                $this->estado= $estado;
                $this->id_verizon= $id_verizon;
                $this->fecha= $fecha;
                $this->cuenta= $cuenta;
                $this->path= $path;
                $this->idfile= $idfile;


        }*/



        public function getIdvideos(){
                return $this->idvideos;
        }

        public function getName(){
                return $this->name;
        }

        public function getPorcentaje(){
                return $this->porcentaje;
        }

        public function getEstado(){
                return $this->estado;
        }

        public function getIdverizon(){
                return $this->id_verizon;
        }

        public function getFecha(){
                return $this->fecha;
        }

        public function getCuenta(){
                return $this->cuenta;
        }

        public function getPath(){
                return $this->path;
        }

        public function getIdfile(){
                return $this->idfile;
        }

        public function setIdvideos($idvideos){
                $this->idvideos=$idvideos ;
        }

        public function setName($name){
                $this->name= $name;
        }

        public function setPorcentaje($porcentaje){
                $this->porcentaje= $porcentaje;
        }

        public function setEstado($estado){
                $this->estado= $estado;
        }

        public function setIdverizon($id_verizon){
                $this->id_verizon= $id_verizon;
        }

        public function setFecha($fecha){
                $this->fecha= $fecha;
        }

        public function setCuenta($cuenta){
                $this->cuenta= $cuenta;
        }

        public function setPath($path){
                $this->path= $path;
        }

        public function setIdfile($idfile){
                $this->idfile= $idfile;
        }


        public function obtenerVideosNuevos(){

                $conexion = new Conexion();
                $conn=$conexion->conectarse();
                $sql = $conn->prepare("SELECT * FROM videos where estado= 'NEW' and cuenta = 'ALEXA'");
                $ids = array();

                $i=0;
                try {
                        $sql->execute();
                        $result = $sql->fetchAll();
                        foreach ($result as $value) {
                                /*$ids[$i]->idvideos=$value['idvideos'];
                                $ids[$i]->name=$value['name'];
                                $ids[$i]->path=$value['path'];
                                */
                                $video =new Video();
                                $video->setIdvideos($value['idvideos']);
                                $video->setName($value['name']);
                                $video->setPorcentaje($value['porcentaje']);
                                $video->setEstado($value['estado']);
                                $video->setIdverizon($value['id_verizon']);
                                $video->setFecha($value['fecha']);
                                $video->setCuenta($value['cuenta']);
                                $video->setPath($value['path']);
                                $video->setIdfile($value['idfile']);
                                $ids[$i] = $video;
                                $i++;
                        }

                }catch(PDOException $e){

                echo "Connection failed: " . $e->getMessage()."\n";
            }

            return $ids;
        }

        public function obtenerVideosNuevosADN40(){

                $conexion = new Conexion();
                $conn=$conexion->conectarse();
                $sql = $conn->prepare("SELECT * FROM videos where estado= 'NEW' and cuenta = 'ALEXAADN40'");
                $ids = array();

                $i=0;
                try {
                        $sql->execute();
                        $result = $sql->fetchAll();
                        foreach ($result as $value) {
                                /*$ids[$i]->idvideos=$value['idvideos'];
                                $ids[$i]->name=$value['name'];
                                $ids[$i]->path=$value['path'];
                                */
                                $video =new Video();
                                $video->setIdvideos($value['idvideos']);
                                $video->setName($value['name']);
                                $video->setPorcentaje($value['porcentaje']);
                                $video->setEstado($value['estado']);
                                $video->setIdverizon($value['id_verizon']);
                                $video->setFecha($value['fecha']);
                                $video->setCuenta($value['cuenta']);
                                $video->setPath($value['path']);
                                $video->setIdfile($value['idfile']);
                                $ids[$i] = $video;
                                $i++;
                        }

                }catch(PDOException $e){

                echo "Connection failed: " . $e->getMessage()."\n";
            }

            return $ids;
        }


        public function actualizarEstado($estado){
                $conexion = new Conexion();
                $conn=$conexion->conectarse();

                //"UPDATE MyGuests SET lastname='Doe' WHERE id=2";

                //Obtener duracion
                $id= self::getIdvideos();


                $sql = $conn->prepare("UPDATE videos SET estado = '$estado' where idvideos = '$id'");
                $ban=false;
                try {

                        $sql->execute();
                        $ban=true;

                }catch(PDOException $e){

                echo "Connection failed: " . $e->getMessage()."\n";
            }

            return $ban;
        }

        public function actualizarIdVerizon($idVerizon){
                $conexion = new Conexion();
                $conn=$conexion->conectarse();

                //"UPDATE MyGuests SET lastname='Doe' WHERE id=2";

                //Obtener duracion
                $id= self::getIdvideos();


                $sql = $conn->prepare("UPDATE videos SET id_verizon = '$idVerizon', porcentaje = '100' where idvideos = '$id'");
                $ban=false;
                try {

                        $sql->execute();
                        $ban=true;

                }catch(PDOException $e){

                echo "Connection failed: " . $e->getMessage()."\n";
            }

            return $ban;
        }
}




?>

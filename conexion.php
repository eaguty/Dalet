<?php


class Conexion{

        public function conectarse(){

                $servername = "10.64.12.144";
                $username = "elemental";
                $password = "str34m1ng0nl1n32019..";
                $dbname = "alexa";
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //echo "Connected successfully\n";
                    }
                catch(PDOException $e)
                    {
                    echo "Connection failed: " . $e->getMessage()."\n";
                    $conn=null;
                    }

                return $conn;

        }
}


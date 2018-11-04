<?php
class Database
{

    public static function conectar()
    {
        $dbHost = 'localhost';
        $dbName = 'desarrollo_web';
        $dbUser = 'root'; 
        $dbPass = '';
        try {
            $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName",
            $dbUser,
            $dbPass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (Exception $e){
            echo $e->getMessage();
            //log de errores
        }
    }
}
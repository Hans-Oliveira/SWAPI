<?php

class DBConnection {

    private static $pdo = null;


    public static function getConnection() {
        try {
            $pdo = new PDO("mysql:host=db;port=3306;dbname=l5-networks;charset=utf8", "root", "123");
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }

        return $pdo;
    }

}


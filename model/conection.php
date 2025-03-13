<?php

class DBConnection {
    private static $pdo = null;

    public static function getConnection() {
        try {
            $pdo = new PDO("mysql:host=db;port=3306;dbname=l5-networks;charset=utf8", "root", "123");
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }
    }

    public static function logSystem($action, $done, $teste = null) {

        try {
            $pdo = DBConnection::getConnection();

            $sql = $pdo->prepare("INSERT INTO logs (id_user, action, status, date) VALUES (?,?,?,?)");

            $sql->bindValue('1', $_SESSION['id_user']);
            
            $sql->bindValue('2', "Tentou fazer " . $action);

            if ($done) {
                $sql->bindValue('3', "Sucesso!");
            }else {
                $sql->bindValue('3', "Erro!");
            }

            $today = new DateTime();

            $sql->bindValue('4', $today->format('d/m/Y H:i:s'));

            $sql->execute();

        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
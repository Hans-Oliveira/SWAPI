<?php

session_start();

require_once "conection.php";

class Login {
    public static function authenticate($user, $pass) {
        
        try {
            $pdo = DBConnection::getConnection();

            $sql = $pdo->prepare("SELECT * FROM usuarios WHERE usuario LIKE ? AND senha LIKE ?");
    
            $sql->bindValue('1', $user);
            
            $sql->bindValue('2', $pass);
    
            $sql->execute();
            
            $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
    
            if ($sql[0] != "") {
    
                $_SESSION['user'] = $sql[0]['usuario'];
                $_SESSION['id_user'] = $sql[0]['id'];
    
                DBConnection::logSystem("Login", true);

                return true;
            }else {
                return false;
            }
        } catch (Exception $e) {
            DBConnection::logSystem("Login", "Erro: " . $e->getMessage());
            echo "Erro: " . $e->getMessage();
        }
    }
}

class user {
    public static function createUser($user, $pass) {

        try {
            $pdo = DBConnection::getConnection();

            $sql = $pdo->prepare("INSERT INTO usuarios (usuario, senha) VALUES (?,?)");

            $sql->bindValue('1', $user);
            
            $sql->bindValue('2', $pass);

            $sql->execute();

            if($sql->rowCount() == 1) {

                $_SESSION['user'] = $user;
                $_SESSION['id_user'] = $pdo->lastInsertId();
                
                DBConnection::logSystem("Cadastro", true);

                return true;
            }else {
                return false;
            }
        } catch (Exception $e) {
            DBConnection::logSystem("Cadastro", "Erro: " . $e->getMessage());
            echo "Erro: " . $e->getMessage();
        }
    }

    public static function editUser($user, $pass) {

        try {
            $pdo = DBConnection::getConnection();

            $sql = $pdo->prepare("UPDATE usuarios SET usuario = ?, senha = ? WHERE id = " .  $_SESSION['id_user']);
    
            $sql->bindValue('1', $user);
            
            $sql->bindValue('2', $pass);
    
            $sql->execute();
    
            if($sql->rowCount() == 1) {

                $_SESSION['user'] = $user;

                DBConnection::logSystem("Alteracao", true);

                return true;
            }else {
                return false;
            }
        } catch (Exception $e) {
            DBConnection::logSystem("Alteracao", "Erro: " . $e->getMessage());
            echo "Erro: " . $e->getMessage();
        }
    }
}
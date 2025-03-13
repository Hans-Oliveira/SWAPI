<?php

session_start();

require_once "conection.php";

class Api {

    public static function getApi($type, $id = null) {

        try {
            if(is_array($id)) {

                $response = [];
    
                foreach ($id as $key) {

                    DBConnection::logSystem("Solicitacao personagens", true);

                    $url = "https://swapi.py4e.com/api/" . $type . "/" . $key;
    
                    $response[] = json_decode(file_get_contents($url), true);
                }
            }else {
                

                $url = "https://swapi.py4e.com/api/" . $type . "/" . $id;

                DBConnection::logSystem("Solicitacao Filmes ($url)", true);
    
                $response = json_decode(file_get_contents($url), true);
            }

            if(!isset($id)) {
                foreach ($response["results"] as &$key) {
                
                    $releaseDate = new DateTime($key["release_date"]);
                    
                    $key["release_date"] = $releaseDate->format('d/m/Y');
                }
            }else {
                if(isset($response['title'])) {
                    $releaseDate = new DateTime($response["release_date"]);
                    $today = new DateTime();
        
                    $age = $today->diff($releaseDate);
                    $years = $age->y;
                    $months = $age->m;
                    $days = $age->d;
                    
                    $response["release_date"] = $releaseDate->format('d/m/Y'); 
                    $response["age"] = "Dias: $days Meses: $months Anos: $years";
    
                    $pdo = DBConnection::getConnection();
    
                    $sql = $pdo->prepare("SELECT synopsis FROM $type WHERE name LIKE :name");
                    
                    $sql->bindValue(':name', '%' . $response['title'] . '%');
    
                    $sql->execute();
    
                    $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
                    
                    $response['synopsis'] = $sql[0]['synopsis'];
                }
            }
            
            $response = json_encode($response);

            return $response;

        } catch (Exception $e) {
            DBConnection::logSystem("Solicitacao Filmes ($url)", "Erro: " . $e->getMessage());
            echo "Erro: " . $e->getMessage();
        } 
         

    }
}

class Image {

    public static function getImage($image) {

        try {
            $pdo = DBConnection::getConnection();
    
            $sql = $pdo->prepare("SELECT * FROM " . $image);

            $sql->execute();
            
            $sql = $sql->fetchAll(PDO::FETCH_ASSOC);

            return $sql;
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }  
    }
}
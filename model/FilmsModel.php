<?php

include "conection.php";




class Api {
    public function getApi($type, $id = null) {

        if(is_array($id)) {

            $response = [];

            foreach ($id as $key) {
                $url = "https://swapi.py4e.com/api/" . $type . "/" . $key;

                $response[] = json_decode(file_get_contents($url), true);
            }
        }else {
            $url = "https://swapi.py4e.com/api/" . $type . "/" . $id;

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
    }
}

class Image {

    public function getImage($image, $name = null) {

        $pdo = DBConnection::getConnection();

        if (!isset($name)) {

            $sql = $pdo->prepare("SELECT * FROM " . $image);

            $sql->execute();
            
            $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
        }else{

            $sql = $pdo->prepare("SELECT synopsis FROM $image WHERE name LIKE :name");
                
            $sql->bindValue(':name', '%' . $name . '%');
    
            $sql->execute();
    
            $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $sql;
    }
}


/* if($_GET['api']) {
    

}else {
  
    
    echo json_encode($sql);
} */


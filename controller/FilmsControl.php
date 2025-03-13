<?php

require_once __DIR__ . "/../model/FilmsModel.php";


if(isset($_GET['type'])) {
    $data = Api::getApi($_GET['type'], $_GET['id']);
}

if(isset($_GET['typeImage'])){
    $data = Image::getImage($_GET['typeImage']);
}


if (isset($_GET['api'])) {

    header("Content-Type: application/json");

    echo json_encode($data);
}else {
    $data = json_decode($data, true);
}
<?php 

require_once "../model/LoginModel.php";

if ($_POST['login'] == 1) {
    $data = Login::authenticate($_POST['user'], $_POST['pass']);

    echo json_encode($data);
}
if($_GET['create'] == 1){
    $data = User::createUser($_POST['user'], $_POST['pass']);
}
if($_GET['edit'] == 1) {
    $data = User::editUser($_POST['user'], $_POST['pass']);
}


if ($data && $_POST['login'] != 1) {
    header('Location: /?page=home');
}
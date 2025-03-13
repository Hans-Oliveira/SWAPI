<?php
session_start();

if ($_GET['page'] == "") {  
    $page = "login";
}else {
    $page = $_GET['page'];
}

if(isset($_GET['exit'])) {
    session_destroy();
    $_SESSION = [];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href="https://img.icons8.com/color/200/star-wars.png">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/CSS/<? echo $page; ?>.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script src="public/javascript/<? echo $page; ?>.js"></script>

    <title>Star wars l5-networks</title>

</head>
<body style="background-color: black; color: white;">

    <? if (!($page == 'login')) { ?>
        <div class="container">
            <p class="ml-4 mt-3">Usuário: <? echo($_SESSION['user']); ?><p> 
            <a href="/?exit" class="btn btn-danger">Sair</a>
            <button type="button" class="btn btn-light ml-2" data-toggle="modal" data-target="#editUser">Editar usuário</button>
        </div>
    <? } ?>

    <?php require_once "route/rote.php"; ?>

    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" style="color: black;"><? if($_SESSION['user'] != null || isset($_SESSION['user'])) {echo("Editar Usuário");}else{echo("Criar Usuário");} ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../controller/LoginControl.php?<? if($_SESSION['user'] != null || isset($_SESSION['user'])) {echo("edit=");}else{echo("create=");} ?>1" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Login" name="user" value="<? echo($_SESSION['user']); ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="pass" class="form-control" placeholder="Senha" name="pass" required>
                        </div>
                        <button type="submit" class="btn btn-primary d-block mx-auto">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

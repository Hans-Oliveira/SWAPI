<?php
require_once __DIR__ . "/../controller/FilmsControl.php";

echo ("<script>const characters =" . json_encode($data['characters']) . "</script>");
?>

<div class="container mt-5">
    <a href="/?page=home" class="btn btn-primary">Voltar</a>
    <h1>Informações sobre o filme: <? echo $data['title']; ?><h1>
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name:</span>
                </div>
                <input type="text" class="form-control" readonly value="<? echo $data['title']; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Data de lançamento:</span>
                </div>
                <input type="text" class="form-control" readonly value="<? echo $data['release_date']; ?>">

            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Idade do filme:</span>
                </div>
                <input type="text" class="form-control" readonly value="<? echo $data['age']; ?>">
            </div>
        </div>
        <div class="col-xl-12">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Sinopse:</span>
                </div>
                <textarea type="text" class="form-control" readonly rows="8" cols="10"><? echo $data['synopsis']; ?></textarea>
            </div>
        </div>
        <div class="col-md-5">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Diretores:</span>
                </div>
                <input type="text" class="form-control" readonly value="<? echo $data['director']; ?>">
            </div>
        </div>
        <div class="col-md-5">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Produtores:</span>
                </div>
                <input type="text" class="form-control" readonly value="<? echo $data['producer']; ?>">
            </div>
        </div>
        <div class="col-md-2">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Nº episódio:</span>
                </div>
                <input type="text" class="form-control" readonly value="<? echo $data['episode_id']; ?>">
            </div>
        </div>
        <div class="col-md-12 my-5">
            <div class="scroll-container">
                <h3>Personagens:</h3>
                <div class="d-flex scroll-info">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="titeInfoModal" style="color: black;"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="perfil" class="container mb-3">
                </div>
                <div class="container text-center" id="description" style="color: black;"> 
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
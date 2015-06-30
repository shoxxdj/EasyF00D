<?php
session_start();
include('./include/header.php');
?>
    <div class="row">
            <div class="col-md-offset-2">
                <h1>Ajouter un restaurant</h1>
                </br>
                <form method="POST" action="action_restau.php">
                    <div class="row">
                        <div class="col-md-1">
                            <label>Nom: </label>
                        </div>
                        <div class="col-md-4">
                            <input name="nom" type="text" class="form-control" placeholder="Pseudo">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-1">
                            <label>Adresse: </label>
                        </div>
                        <div class="col-md-4">
                            <input name="text" type="adress" class="form-control" placeholder="***">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-1">
                            <label>Téléphone: </label>
                        </div>
                        <div class="col-md-4">
                            <input name="tel" type="text" class="form-control" placeholder="email">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-2 col-md-offset-2">
                            <button type="submit" class="btn btn-success btn-block"> Ajouter </button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
<?php
session_start();
include('./include/header.php');
?>

<div class="row">
            <div class="col-md-offset-2">
                <h1>Ajouter un Menu</h1>
                </br>
                <form method="POST" action="action_menu.php">
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
                            <label>Prix: </label>
                        </div>
                        <div class="col-md-4">
                            <input name="prix" type="adress" class="form-control" placeholder="***">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-1">
                            <label>Description: </label>
                        </div>
                        <div class="col-md-4">
                            <input name="desc" type="text" class="form-control" placeholder="email">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-2 col-md-offset-2">
                            <button type="submit" class="btn btn-success btn-block"> Ajouter </button>
                        </div>
                    </div>
                    <?php echo "<input type='hidden' name='resto_id' value='".$_POST["id_menu"]."'>"?>
                </form>
            </div>
    </div>
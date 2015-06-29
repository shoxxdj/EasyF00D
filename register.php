<?php
    include("./include/header.inc.php");
?>
    <div class="row">
            <div class="col-md-offset-2">
                <h1>Registration</h1>
                </br>
                <form method="POST" action="action.php">
                    <div class="row">
                        <div class="col-md-1">
                            <label>Pseudo: </label>
                        </div>
                        <div class="col-md-4">
                            <input name="pseudo" type="text" class="form-control" placeholder="Pseudo">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-1">
                            <label>Mot de passe: </label>
                        </div>
                        <div class="col-md-4">
                            <input name="password" type="password" class="form-control" placeholder="***">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-1">
                            <label>Email: </label>
                        </div>
                        <div class="col-md-4">
                            <input name="mail" type="text" class="form-control" placeholder="email">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-1 col-md-offset-2">
                            <button type="submit" class="btn btn-success btn-block"> S'inscrire </button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</body>
</html>
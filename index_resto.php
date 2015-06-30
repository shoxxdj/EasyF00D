<?php
  include('./include/header.inc.php');
?>
    <div class="row">
    	<div class="col-md-offset-2 col-md-8">
        <center>
        <?php
          if(isset($_GET["error"]))
          {
            if($_GET["error"]==0)
            {?>
              <div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
              <strong>Success ! </strong> 
              Vous êtes bien enregistré, vous pouvez maintenant vous connecté !  
              </div>
          <?php
            }
            elseif ($_GET["error"]==3) 
            {?>
              <div class='alert alert-danger'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
              <strong>Error ! </strong>   
              Une erreur est survenue lors de l'inscription !
              </div>
            <?php
            }
            elseif ($_GET["error"]==2) 
            {?>
              <div class='alert alert-danger'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
              <strong>Error ! </strong>   
              Vous n'êtes pas enregistré !
              </div>
            <?php
            }
          }
        ?> 
        <br><br>
    		<h1>Easy Food</h1>
        <br><br>
    		<div class="jumbotron">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active"><img src="pictures/food1.jpg"></div>
                  <div class="item"><img src="pictures/food2.jpg"/></div>
                  <div class="item"><img src="pictures/food3.jpg"/></div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
              </div>
              <div class="jumbotron-contents">
                <h1>Faciliter la gestion du déjeuner chez Cdiscount !</h1>
                <h2>Pour les restaurateurs</h2>
                <p>Proposez votre menu du jour et gérer les commandes en avance !</p>
                <h2>Pour les clients (<a href='../index.php'>cliquez ici)</a></h2>
                <p>Facilitez votre commande et réservez votre plat en avance ! Fini la longue file d'attente</p>
              </div>
            </div>
          </center>
    	</div>
    </div>
</body>
</html>
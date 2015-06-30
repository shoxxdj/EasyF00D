<html>
<head>
	<meta charset="utf8">
	<title>Easy Food</title>
	 <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://bootflat.github.io/bootflat/css/bootflat.css">
     <link rel="stylesheet" type="text/css" href="css/css.css">
</head>
<body>
	<!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- Bootflat's JS files.-->
    <script src="https://bootflat.github.io/bootflat/js/icheck.min.js"></script>
    <script src="https://bootflat.github.io/bootflat/js/jquery.fs.selecter.min.js"></script>
    <script src="https://bootflat.github.io/bootflat/js/jquery.fs.stepper.min.js"></script>
	<nav class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
            <div class="row">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header col-md-offset-2">
                    <a class="navbar-brand" href="index_resto.php">Easy Food</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse col-md-4" id="bs-example-navbar-collapse-5">
                    <ul class="nav navbar-nav">
                        <li><a href="contact.php">Contact</a></li>
                        <!-- <li class="disabled"><a href="#">Link</a></li> -->
                        <li class="dropdown">
                          <a class="dropdown-toggle" data-toggle="dropdown">Register<b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="register.php">Client</a></li>
                                <li><a href="register_restau.php">Restorer</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
                <div id="connexion">
                    <form action="connexion_pro.php"  id="form_connexion"method="POST" class="navbar-form navbar-right">
                
                            <input type="text" name="login" placeholder="pseudo"/>
                        
                            <input type="password" name="password" placeholder="****"/>
                            <button class="btn btn-success" type="submit">Connexion</button>
                        
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
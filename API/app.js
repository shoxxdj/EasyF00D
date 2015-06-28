 //Express
var express = require('express');
var session = require('express-session');
var app= express();

app.use(session({
                secret: 'thisisadamnsecret',
                name: 'myApp'
        }));

app.use(express.static(__dirname+'/public'));

//Database
dbLocation='localhost/Resto';
var db = require('monk')(dbLocation);


var async = require('async');

//Body Parser
var bodyParser = require('body-parser');
app.use( bodyParser.json() );       // to support JSON-encoded bodies
app.use(bodyParser.urlencoded({     // to support URL-encoded bodies
  extended: true
})); 

//Models
var users = db.get('users');
var restos = db.get('restos');
var menus = db.get('menus');
var restaurateurs = db.get('restaurateurs');
var orders =db.get('orders');

var isAuthenticated = function (req, res, next) {
  if (req.session.username)
    return next();
  if (req.session.restaurateur)
  	return next();
  res.redirect('/');
}

var isRestaurateur = function (req,res,next){
	if(req.session.restaurateur)
		return next();
	res.redirect('/error');
}


var registringIsOpen= function (req,res,next){
	if(registringIsOpen)
		return next();
	res.redirect('/');
}

Date.prototype.yyyymmdd = function() {
   var yyyy = this.getFullYear().toString();
   var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
   var dd  = this.getDate().toString();
   return yyyy + (mm[1]?mm:"0"+mm[0]) + (dd[1]?dd:"0"+dd[0]); // padding
  };


//Register 
//Register User
app.post('/register',function(req,res){
	var login = req.body.login;
	var password = req.body.password;
	var mail = req.body.mail;

	var status;

	async.series([
		function(callback){
			console.log("search for user");
			users.findOne({'login':login},function(err,utilisateur,done)
			{
				if(err){
					status=0;
					console.log(err);
					callback(null,"status");
				}
				else if(utilisateur==null){
					console.log("no user");
					status=1;
					callback(null,"status");
				}

				else if(utilisateur!=null){
					console.log(utilisateur);
					status=0;
					callback(null,"status");
				}
			});
		},
		function(callback){
			console.log("second function");
			console.log("status : " + status);
			if(status==1){
				users.insert({ login:login, password: password, mail: mail})
					.on('success', function(doc){
							callback(null,"success");
						})
					.on('error',function(doc){
							callback(null,"error");
				});
			}
			else
			{
				callback(null,"error");
			}

		}

	],function(err,results){
		console.log(results);
		res.end(results[1]);
	});
});
//Register Restaurateur
app.post('/restaurateur/register',function(req,res){
	var login = req.body.login;
	var password = req.body.password;
	var mail = req.body.mail;

	var status;

	async.series([
		function(callback){
			console.log("search for user");
			restaurateurs.findOne({'login':login},function(err,utilisateur,done)
			{
				if(err){
					status=0;
					console.log(err);
					callback(null,"status");
				}
				else if(utilisateur==null){
					console.log("no user");
					status=1;
					callback(null,"status");
				}

				else if(utilisateur!=null){
					console.log(utilisateur);
					status=0;
					callback(null,"status");
				}
			});
		},
		function(callback){
			console.log("second function");
			console.log("status : " + status);
			if(status==1){
				restaurateurs.insert({ login:login, password: password, mail: mail})
					.on('success', function(doc){
							callback(null,"success");
						})
					.on('error',function(doc){
							callback(null,"error");
				});
			}
			else
			{
				callback(null,"error");
			}

		}

	],function(err,results){
		console.log(results);
		res.end(results[1]);
	});
});

//Login
//Login User
app.post('/login', function(req, res) {
	//check auth
	var login=req.body.login;
	var password=req.body.password;
	users.findOne({'login':login},function(err,utilisateur,done)
	{
		console.log(utilisateur);
		if(err){
			res.end('Error');
		}
		else if(utilisateur==null){
			res.end('No User');
		}

		else if(utilisateur.password!=password){
			console.log("Bad Password");
			res.end('Bad Password');
		}
		else{
			console.log("Succeed");
			req.session.username=utilisateur._id;
			console.log(req.session.username);
			res.end('Logged');
		}
	});
});
//Login Restaurateur
app.post('/restaurateur/login', function(req, res) {
	//check auth
	var login=req.body.login;
	var password=req.body.password;
	restaurateurs.findOne({'login':login},function(err,utilisateur,done)
	{
		console.log(utilisateur);
		if(err){
			res.end('Error');
		}
		else if(utilisateur==null){
			res.end('No User');
		}

		else if(utilisateur.password!=password){
			console.log("Bad Password");
			res.end('Bad Password');
		}
		else{
			console.log("Succeed");
			req.session.restaurateur=utilisateur._id;
			res.end('Logged');
		}
	});
});


//Disconnect
app.get('/disconnect',isAuthenticated,function(req,res){
	if (req.session.username)
    	req.session.username=null;
  	if (req.session.restaurateur)
  		req.session.restaurateur=null;
  	res.end('done');
});

app.get('/error',function(req,res){
	res.end('error');
});

app.get('/login',function(req,res){
	res.render('login.ejs');
});

//_____________________________________\\
///////////////Utilisateur\\\\\\\\\\\\\\\\
//---------------------------------------\\



//user
//Lister les restaurants
app.get('/restaurants',isAuthenticated,function(req,res){
	console.log("searching all resto");
	restos.find({},function(err,resto,done){
		var myRestos=[];
		async.each(resto,
			function(item,callback){
				console.log(item);
				var actualResto={"id":item._id,"nom":item.nom,"tel":item.tel};
				myRestos.push(actualResto);
				callback();
			},function(){
				res.end(JSON.stringify(myRestos));
		});
	});
});

//Lister les menus d'un resto
app.get('/menus/:idResto',isAuthenticated,function(req,res){
	var idresto = req.params.restaurateur;
	console.log("searching menu for "+idresto);
	menus.find({id_resto:idresto},function(err,_menus,done){
		var menu = [];
		async.each(_menus,
			function(item,callback){
				var actualMenu={"id":item._id,"nom":item.name,"description":item.description,"prix":item.price,}
				menu.push(actualMenu);
				callback();
			},function(){
				res.end(JSON.stringify(menu));
			});
	});
});
app.get('/menus',function(req,res){
	res.render('addorder.ejs');
});
// Placer une commande 
app.post('/menus/:idResto/:idMenu',isAuthenticated,function(req,res){
	var idresto=req.params.idResto;
	var idmenu=req.params.idMenu;
	var date = req.body.date;

	var status=0;
	async.series([
		function(callback){
			restos.findOne({'_id':idresto},function(err,restaurant,done)
			{
				if(err){
					status=0;
					console.log(err);
					callback(null,"status");
				}
				else if(restaurant==null){
					console.log("no user");
					status=0;
					callback(null,"status");
				}

				else if(restaurant!=null){
					id_restaurateur=restaurant.id_restaurateur;
					console.log(restaurant);
					status=1;
					callback(null,"status");
				}
			});
		},
		function(callback){
			if(status==1){
				menus.findOne({'_id':idmenu},function(err,menus,done){
					if(err){
						status=0;
						console.log(err);
						callback(null,"status");
					}
					else if(menus==null){
						console.log("no user");
						status=0;
						callback(null,"status");
					}

					else if(menus!=null){
						console.log(menus);
						status=1;
						callback(null,"status");
					}
				});
			}else{
				callback(null,"error");
			}
		},
		function(callback){
			//le resto existe et le menu aussi
			if(status==1){
				orders.insert({id_restaurateur:id_restaurateur,id_restaurant: idresto,id_menu:idmenu,date:date,status:0})
				.on('success', function(doc){
						callback(null,"success");
					})
				.on('error',function(doc){
						callback(null,"error");
					});
			}else{
				callback(null,"error");
			}
		}
	],function(err,result){
		console.log(result);
		res.end(result[2]);
	});
});


//_____________________________________\\
///////////////Restaurateur\\\\\\\\\\\\\\\
//---------------------------------------\\

//Ajouter un restaurant
app.get('/restaurateur/addresto',isRestaurateur,function(req,res){
	res.render('addresto.ejs');
});
app.post('/restaurateur/addresto',isRestaurateur,function(req,res){
	var name = req.body.name;
	var adresse = req.body.adresse;
	var tel = req.body.telephone;
	var id_restaurateur = req.session.restaurateur;

	restos.insert({ id_restaurateur:id_restaurateur, name: name, adresse: adresse, tel: tel})
				.on('success', function(doc){
						res.end("success");
					})
				.on('error',function(doc){
						res.end("error");
					});
});
//Lister ses restaurants
app.get('/restaurateur/myresto',isRestaurateur,function(req,res){
	console.log(req.session.restaurateur+" is asking for his restrant");
	restos.find({id_restaurateur: req.session.restaurateur},function(err,resto,done){
		console.log(resto);
		var myRestos=[];
		async.each(resto,
			function(item,callback){
				var actualResto={"id":item._id,"nom":item.name};
				myRestos.push(actualResto);
				callback();
			},function(){
				res.end(JSON.stringify(myRestos));
		});
	});
});
//Ajouter un menu
app.post('/restaurateur/addmenu/:idResto',isRestaurateur,function(req,res){
	var idResto = req.params.idResto;
	var nom = req.body.nom;
	var prix = req.body.prix;
	var description = req.body.desc;

	var status=0;

	async.series([
		function(callback){
			//Verifier si le resto existe
			restos.findOne({'_id':idResto},function(err,restaurant,done)
			{
				if(err){
					status=0;
					console.log(err);
					callback(null,"status");
				}
				else if(restaurant==null){
					console.log("no user");
					status=0;
					callback(null,"status");
				}

				else if(restaurant!=null){
					console.log(restaurant);
					status=1;
					callback(null,"status");
				}
			});
		},
		function(callback){
			//Si ou ajouter le menu au resto
			if(status==1){
				menus.insert({ id_restaurateur:idResto, name: nom, price: prix, description: description})
						.on('success', function(doc){
								callback(null,"success");
							})
						.on('error',function(doc){
								console.log(doc);
								callback(null,"error on insert");
							});
			}else{
				callback(null,"error");
			}

		}

	],function(err,results){
		console.log(results);
		res.end(results[1]);
	});	
});

//Lister les commandes 
app.get('/restaurateur/orders',isRestaurateur,function(req,res){
	console.log('here');
	myOrders=[];
	orders.find({id_restaurateur: req.session.restaurateur,status:0},function(err,commandes,done){
		console.log(err);
		console.log('lala');
		console.log(commandes);
			async.each(commandes,
				function(item,callback){
					myOrders.push(item);
					callback();
				},function(){
					res.end(JSON.stringify(myOrders));
				}
			);
	});
});



var server= app.listen(3000,function(){
	var host = server.address().address;
	var port = server.address().port;
	console.log("Running !");
});

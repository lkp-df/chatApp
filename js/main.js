$(document).ready(function(){
		
		//creation d'une variable globale domain
		var DOMAIN = "http://localhost/inventaire/public_html";

		//pour l'enregistrement d'un utilisateur
		$("#register_form").on("submit",function(){
			//creation d'une variable booleene pour verifier le status d'n champ(une variable)
			var status = false;

			//recuperation des contenus de chaque variable via le js
			var register_nom     = $("#register_nom");
			var register_email   = $("#register_email");
			var register_pw1     = $("#register_pw1");
			var register_pw2     = $("#register_pw2");
			var register_type    = $("#register_type");

			//creons les variables de regex pour rechercher des caracteres indesirable ou encore une adresse incorrect
			//nous savons que l'adresse email est de forme: pepindjoneska@gmail.com ou encore pepin.djoneska@gmail.com  pepin.djoneska@gmail.pnox.com

			var email_regex = new RegExp(/^[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*(\.[a-z]{2,4})$/);

			var pw_regex = new RegExp(/^(?=.*[A-Z])+(?=.*[a-z])+(?=.*\d)+(?=.*[-+!*$@%_])+([-+!*$@%_\w]{8,15})+$/);
			/*
			votre expression habituelle devrait ressembler à: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,16}$/

				/^
				  (?=.*\d)          // should contain at least one digit == doit contenir au moins un chiffre
				  (?=.*[a-z])       // should contain at least one lower case == doit contenir au moins une minuscule
				  (?=.*[A-Z])       // should contain at least one upper case == doit contenir au moins une majuscule
				  [a-zA-Z0-9]{8,16}   // should contain at least 8 from the mentioned characters == doit contenir au moins 8 des caractères mentionnés
				$/

			*/

			//pour acceder aux valeurs,nous allons utiliser val() 
			//verifions si une valeur ou un champ n'est pas vide afin de ne pas avoir une saisie vide
			//c'est comme un controle de saisie et nous ferons l'insertion avec le php

			//pour le nom
			if (register_nom.val() == "")
			{
				//alors faire ceci, on met la bordure en rouge
				$("#register_nom").addClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#register_nom_er").html("<span class='text-danger'>le nom est obligatoire</span>");

				//mettons le status a false vue que le champ est vide
				status = false;
			}
			else if(register_nom.val().length < 5)
			{
				//alors faire ceci, on met la bordure en rouge
				$("#register_nom").addClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#register_nom_er").html("<span class='text-danger'>le nom doit avoir au moins 5 caracteres</span>");

				//mettons le status a false vue que le champ est vide
				status = false;
			}
			else
			{
				//alors faire ceci, on met la bordure en rouge
				$("#register_nom").removeClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#register_nom_er").html("");

				//mettons le status a true vue que le champ n'est vide
				status = true;
			}

			//pour l'adresse email
			if (register_email.val() == "")
			{
				//alors faire ceci, on met la bordure en rouge
				$("#register_email").addClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#register_email_er").html("<span class='text-danger'>l'email est obligatoire</span>");

				//mettons le status a false vue que le champ est vide
				status = false;
			}
			else
			{	
				if( !email_regex.test(register_email.val()) )
				{
					//alors faire ceci, on met la bordure en rouge
					$("#register_email").addClass("border-danger");
					//et on affiche le message d'erreur comme c'est du html,on utilise html()
					//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
					$("#register_email_er").html("<span class='text-danger'>adresse email incorrect</span>");

					//mettons le status a false vue que le champ est vide
					status = false;
				}
				else
				{
					//alors faire ceci, on enleve la bordure en rouge
					$("#register_email").removeClass("border-danger");
					//et on affiche le message d'erreur comme c'est du html,on utilise html()
					//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
					$("#register_email_er").html("");

					//mettons le status a false vue que le champ est vide
					status = true;
				}
				
			}

			//pour le mot de passe 1
			if (register_pw1.val() == "")
			{
				//alors faire ceci, on met la bordure en rouge
				$("#register_pw1").addClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#register_pw1_er").html("<span class='text-danger'>le mot de passe est obligatoire</span>");

				//mettons le status a false vue que le champ est vide
				status = false;
			}
			else if(register_pw1.val().length < 8)
			{
				//alors faire ceci, on met la bordure en rouge
				$("#register_pw1").addClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#register_pw1_er").html("<span class='text-danger'>le mot de passe doit avoir au moins 8 caracteres</span>");

				//mettons le status a false vue que le champ est vide
				status = false;
			}
			else if(! pw_regex.test(register_pw1.val()))
			{
				//alors faire ceci, on met la bordure en rouge
				$("#register_pw1").addClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#register_pw1_er").html("<span class='text-danger'>le mot de passe doit avoir au moins une minuscule,majuscule,caractere speciaux et un chiffre/span>");

				//mettons le status a false vue que le champ est vide
				status = false;
			}
			else
			{
				//alors faire ceci, on met la bordure en rouge
				$("#register_pw1").removeClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#register_pw1_er").html("");

				//mettons le status a true vue que le champ n'est vide
				status = true;
			}

			//pour le mot de passe 2
			if (register_pw2.val() == "")
			{
				//alors faire ceci, on met la bordure en rouge
				$("#register_pw2").addClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#register_pw2_er").html("<span class='text-danger'>le mot de passe est obligatoire</span>");

				//mettons le status a false vue que le champ est vide
				status = false;
			}
			else if(register_pw2.val().length < 8)
			{
				//alors faire ceci, on met la bordure en rouge
				$("#register_pw2").addClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#register_pw2_er").html("<span class='text-danger'>le mot de passe doit avoir au moins 8 caracteres</span>");

				//mettons le status a false vue que le champ est vide
				status = false;
			}
			else if(! pw_regex.test(register_pw2.val()))
			{
				//alors faire ceci, on met la bordure en rouge
				$("#register_pw2").addClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#register_pw2_er").html("<span class='text-danger'>le mot de passe doit avoir au moins une minuscule,majuscule,caractere speciaux et un chiffre</span>");

				//mettons le status a false vue que le champ est vide
				status = false;
			}
			else
			{
				//alors faire ceci, on met la bordure en rouge
				$("#register_pw2").removeClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#register_pw2_er").html("");

				//mettons le status a true vue que le champ n'est vide
				status = true;
			}

			//pour le type utilisateur
			if (register_type.val() == "")
			{
				//alors faire ceci, on met la bordure en rouge
				$("#register_type").addClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#register_TypeUser_er").html("<span class='text-danger'>Choix obligatoire</span>");

				//mettons le status a false vue que le champ est vide
				status = false;
			}
			else
			{
				//alors faire ceci, on met la bordure en rouge
				$("#register_type").removeClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#register_TypeUser_er").html("");

				//mettons le status a true vue que le champ n'est vide
				status = true;
			}

		//INSERTION DE L'ENREGSITREMENT DANS LA BD
		//verification avec ajax avant insertion dans la bd via le process.php

		if (register_nom.val() != "" && register_email.val() != "" && status == true)
		{
			if (register_pw2.val() != "" && register_pw1.val() == register_pw2.val() && register_type.val() != "")
			{	
				$(".overlay").show();
				$.ajax({
					url: DOMAIN+"/includes/process.php",
					method: "POST",
					data: $("#register_form").serialize(),
					success: function(data)
					{
						if (data === " Email Existant")
						{	
							$(".overlay").hide();
							alert("Désolé cet email existe deja!!!");
						}
						else if(data === " Insertion Echouée")
						{	
							$(".overlay").hide();
							alert("Erreur rencontrée lors de l'insertion,veuillez ressayer");
						}
						else
						{	
							$(".overlay").hide();
							window.location.href = encodeURI(DOMAIN+"/index.php?msg=vous etes bien enregistré, connectez vous maintenant");
						}
					}
				})
			}
		}

		});
			
		



		//pour la connexionn d'un utilisateur
		$("#login_form").on("submit",function(){
			
			//recuperation des contenus de chaque variable via le js
			var login_form_email = $("#login_form_email");
			var login_form_pw    = $("#login_form_pw");

			//verifions si une valeur ou un champ n'est pas vide afin de ne pas avoir une saisie vide
			//c'est comme un controle de saisie et nous ferons l'insertion avec le php

			//pour l'email
			if (login_form_email.val() == "")
			{
				//alors faire ceci, on met la bordure en rouge
				$("#login_form_email").addClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#login_form_email_error").html("<span class='text-danger'>l'email est obligatoire</span>");

			}
			else
			{
				//alors faire ceci, on met la bordure en rouge
				$("#login_form_email").removeClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#login_form_email_error").html("");
			}


			//pour le mot de passe
			if (login_form_pw.val() == "")
			{
				//alors faire ceci, on met la bordure en rouge
				$("#login_form_pw").addClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#login_form_pw_error").html("<span class='text-danger'>le mot de passe est obligatoire</span>");

			}
			else
			{
				//alors faire ceci, on met la bordure en rouge
				$("#login_form_pw").removeClass("border-danger");
				//et on affiche le message d'erreur comme c'est du html,on utilise html()
				//on utiise les classes bootstrap vue que dans l'index bootstrap est deja inseré
				$("#login_form_pw_error").html("");
			}


			
			//verification avec ajax avant insertion dans la bd via le process.php
			if (login_form_email.val() != "" && login_form_pw.val() !="") 
			{	
				$(".overlay").show();
				$.ajax({
					url: DOMAIN+"/includes/process.php",
					method:"POST",
					data: $("#login_form").serialize(),
					success: function(data)
					{
						if (data === " Identifiants Incorrects") 
						{	
							$(".overlay").hide();
							$("#login_form_pw").addClass("border-danger");
							$("#login_form_pw_error").html("<span class='text-danger'>Identifiant incorrect</span>");


						}
						else if(data === " Vous N'etes pas Encore Enregisté")
						{	
							$(".overlay").hide();
							$("#login_form_email").addClass("border-danger");
							$("#login_form_email_error").html("<span class='text-danger'>Vous N'etes Pas enregistré, veuillez creer un compte</span>");
						}
						else
						{	
							$(".overlay").hide();
							window.location.href = encodeURI(DOMAIN+"/dashboard.php");
						}
					}
				})
			}
		});


		//afficher les categorie au niveau du html pour pouvoir selectionner le parent categorie par le js
		AfficheCategorie();
		function AfficheCategorie()
		{
			$.ajax({
				url: DOMAIN+"/includes/process.php",
				method: "POST",
				data:{AfficheCategorie:1},
				success:function(data)
				{	
					var choix = "<option value='0'>choisir</option>";
					$("#form_cat_parent").html(choix+data);
					$("#form_produit_cat_name").html(choix+data);
				}
			})
		}

		//fonction pourafficher les marques au niveau du html pour pouvoir selectionner la marque par le js
		AfficheMarque();
		function AfficheMarque()
		{
			$.ajax({
				url: DOMAIN+"/includes/process.php",
				method: "POST",
				data:{AfficheMarque:1},
				success:function(data)
				{	
					var choix = "<option value='0'>choisir</option>";
					$("#form_produit_brand_name").html(choix+data);
				}
			})
		}
		
		//pour ajouter une categorie
		$("#form_cat").on("submit",function(){
			var form_cat_name   = $("#form_cat_name").val();
			var form_cat_parent = $("#form_cat_parent").val();

			//pour category_name
			if (form_cat_name == "")
			{
				$("#form_cat_name").addClass("border-danger");
				$("#form_cat_name_error").html("<span class='text-danger'>ce champ ne peut pas etre vide</span>");
			}
			else
			{
				$("#form_cat_name").removeClass("border-danger");
				$("#form_cat_name_error").html("");	
			}

			//pour parent_category
			if (form_cat_parent == "")
			{
				$("#form_cat_parent").addClass("border-danger");
				$("#form_cat_parent_error").html("<span class='text-danger'>ce champ ne peut pas etre vide</span>");
			}
			else
			{
				$("#form_cat_parent").removeClass("border-danger");
				$("#form_cat_parent_error").html("");	
			}

			//pour ajouter une categorie dans la bd
			if (form_cat_name !="" && form_cat_parent !="")
			{
				$.ajax({
					url: DOMAIN+"/includes/process.php",
					method: "POST",
					data: $("#form_cat").serialize(),
					success: function(data){
						
						if (data.replace(/\s+/,"") === "Categorie Ajoutée")
						{
							$("#form_cat_name").removeClass("border-danger");
							$("#form_cat_name_error").html("<span class='text-success'>Nouvelle categorie ajoutée</span>");
							$("#form_cat_name").val("");
							$("#form_cat_parent").val("");	
							AfficheCategorie();
						}
						
					}
				})
			}

		});


		//pour la marque
		$("#form_brand").on("submit",function(){
			var form_brand_name = $("#form_brand_name").val();

			if (form_brand_name == "")
			{
				$("#form_brand_name").addClass("border-danger");
				$("#form_brand_name_error").html("<span class='text-danger'>Ce champ ne peut pas etre vide</span>");
			}else
			{
				$("#form_brand_name").removeClass("border-danger");
				$("#form_brand_name_error").html("");

				$.ajax({
					url: DOMAIN+"/includes/process.php",
					method: "POST",
					data:$("#form_brand").serialize(),
					success: function(data){
						//alert(data);
						if (data.replace(/\s+/,"") === "Marque Ajoutée")
						{
							$("#form_brand_name").removeClass("border-danger");
							$("#form_brand_name_error").html("<span class='text-success'>Nouvelle Marque Ajoutée</span>");
							$("#form_brand_name").val("");

						}
						else
						{
							alert(data);
						}
					}
				})

			}
		});


		//inserer un nouveau produit
		$("#form_produit").on("submit",function(){
			/*on peut aussi verifier chaque champ du 
			formulaire produit, comme ona utilisé le required on ne
			fera pas ceci
			*/
			$.ajax({
				url: DOMAIN+"/includes/process.php",
				method:"POST",
				data: $("#form_produit").serialize(),
				success:function(data)
				{
					//alert(data);
					if (data.replace(/\s+/,"") === "Produit Ajoutée")
					{
						alert("Nouveau produit Ajouté Avec Succés");
						$("#form_produit_name").val("");
						$("#form_produit_cat_name").val("");
						$("#form_produit_brand_name").val("");
						$("#form_produit_prix").val("");
						$("#form_produit_qty_stock ").val("");
					}
					else
					{
						console.log(data);
						alert(data);
					}
				}
			})

		});

		//pour eviter que notre page soit lourde, nous allons 
		//separer les parties gestions et ajouts
		//pour les parties gestionson a creer un autre fichier js qu'on appelle manage.js
		//qui contiendra toutes les fonctions js lies à la gestion afin que cela soit plus efficients, sinon toutes les fonctions seront appelées
		
})
<!DOCTYPE HTML>

<!--
	Prologue by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Prologue by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<script type="text/javascript" src="assets/js/jquery.min.js"></script>
		<script src="assets/js/musicplayer.js"></script>
		<script>
			// Ajouter des artistes
			x = 1; // Nombre d'artistes à ajouté
			function modifier_artistes(action) {
				if (action == 'ajouter-artiste') {
					x++; //text box increment
					$('.wrapper-artistes').append("<input placeholder='Selectionner l artiste' list='Artistes' id='Artiste-"+x+"' class='artistes' required/>");
				} else if (action == 'supprimer-artiste') {
					x--;
					$('.artistes').last().remove();
				};
				$("#supprimer-artiste").attr("disabled",true);

				if (x > 1) {
					$("#supprimer-artiste").removeAttr("disabled");
				};
			};


			$(document).ready(function() {

				// Preview album cover
				function readURL(input) {
					if (input.files && input.files[0]) {
						var reader = new FileReader();
						reader.onload = function(e) {
							$('#imagePreview').css('background-image', 'url('+e.target.result +')');
							$('#imagePreview').hide();
							$('#imagePreview').fadeIn(650);
						}
						reader.readAsDataURL(input.files[0]);
					}
				}
				$("#imageUpload").change(function() {
					readURL(this);
				});


				// Séléctionner des albums
				$('.item-album').click(function() {
				var currentAlbum = $(this).attr('id');
				
					if ( $(this).hasClass('selected') ) {
						$('#'+currentAlbum+'-checkbox').removeAttr("checked","checked");	
						$(this).removeClass('selected');
					} else {
						$('#'+currentAlbum+'-checkbox').attr("checked","checked");
						$(this).addClass('selected');
	 				}
				});
				
				$("#myInputSearchBar").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$(".item-album").filter(function() {
						$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
			});
	

		</script>
	</head>
<?php
	$dsn = 'mysql:dbname=djtools;host=localhost';
	  $user = 'root';
	  $password = '';
  
	  try {
		  $db = new PDO($dsn, $user, $password);
		   if ($db) {

			// Alerte a chaque fois qu'une requête échoue
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
			// Désactive la simulation des requêtes préparés, 
			// utilise l'interface native pour récupérer les données et leur type.
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 

				if (isset($_POST["option"]) == "ajouter") {

					$annee_album = $_POST['date'];
					$nom_album = $_POST['titre'];

					$filename = "albums/".$nom_album."";

				if(!isset($_FILES['fichier']['name'])) {

					if (file_exists($filename)) {

						$file_name = $_FILES['fichier']['name'];	
						$file_tmp_name = $_FILES['fichier']['tmp_name'];
						$file_dest = 'albums/'.$nom_album.'/'.$file_name;

						if(copy($file_tmp_name,$file_dest)) {
							echo 'Fichier envoyé avec succès';
						} else {
							echo "erreur lors de l'envoie du fichier";
						}
					} else {
						mkdir("albums/".$nom_album, 0700);

						$file_name = $_FILES['fichier']['name'];	
						$file_tmp_name = $_FILES['fichier']['tmp_name'];
						$file_dest = 'albums/'.$nom_album.'/'.$file_name;

						if(copy($file_tmp_name,$file_dest)) {
							echo 'Fichier envoyé avec succès';
						} else {
							echo "erreur lors de l'envoie du fichier";
						}
					}

					$ajouterNewArtiste = "INSERT INTO album (nom_album,annee_album,pochette_album) VALUES ('".$nom_album."','".$annee_album."','".$file_dest."')";
					$query = $db->prepare($ajouterNewArtiste);
					$query->execute();

				} else {

					if (file_exists($filename)) {

						$file_name = 'default.png';	
						$file_tmp_name = 'albums/default album/default.png';
						$file_dest = 'albums/'.$nom_album.'/'.$file_name;

						if(copy($file_tmp_name,$file_dest)) {
						echo 'Fichier envoyé avec succès';
						
						} else {
							echo "erreur lors de l'envoie du fichier";
						}
						} else {

							mkdir("albums/".$nom_album, 0700);

						$file_name = 'default.png';	
						$file_tmp_name = 'albums/default album/default.png';
						$file_dest = 'albums/'.$nom_album.'/'.$file_name;

						if(copy($file_tmp_name,$file_dest)) {
						echo 'Fichier envoyé avec succès';
						} else {
							echo "erreur lors de l'envoie du fichier";
						}

						$ajouterNewArtiste = "INSERT INTO album (nom_album,annee_album,pochette_album) VALUES ('".$nom_album."','".$annee_album."','".$file_dest."')";
						$query = $db->prepare($ajouterNewArtiste);
						$query->execute();

					}

					}
				} 
			

echo "
	<body class='is-preload'>
		<!-- Header -->
			<div id='header'>
				<div class='top'>

					<!-- Logo -->
					<div id='logo'>
						<h1 id='title'>DJTools</h1>
					</div>

					<!-- Nav -->
					<nav id='nav'>
						<ul>
							<li><a href='album.php'><span class='icon solid fa-th'>Albums</span></a></li>
							<li><a href='ajouter-morceau.php'><span class='icon solid fa-plus'>Ajouter un morceau</span></a></li>
							<li><a href='ajouter-album.php'><span class='icon solid fa-plus'>Ajouter un album</span></a></li>
							<li><a href='suppr-album.php'><span class='icon solid fa-minus'>Supprimer un album</span></a></li>
						</ul>
					</nav>
				</div>
			</div>

		<!-- Main -->
			<div id='main'>
				<!-- Portfolio -->
					<section id='portfolio' class='two'>
						<div class='container'>
							<div class='row'>
								<div class='col-12 col-12-mobile'>
									<article class='item' id='1'>
										<form class='addform form' action='' method='post' enctype='multipart/form-data'>
											<h2>Ajouter un album</h2>

											<div class='avatar-upload'>
												<div class='avatar-edit'>
													<input type='file' id='imageUpload' name='fichier' accept='.png, .jpg, .jpeg' />
													<label for='imageUpload'></label>
												</div>
												<div class='avatar-preview'>
													<div id='imagePreview' style='background-image: url(images/default-cover.jpg)'>
													</div>
												</div>
											</div>		
																			
											<input type='text' tabindex='1' name='titre' required autofocus class='my-2' placeholder='Nom'> 
											<input type='text' tabindex='1' name='date' required placeholder='Date'>
											<fieldset>
												  <button type='submit' name='option' value='ajouter' id='ajouter-morceau'>Ajouter</button>
											</fieldset>
										</form>
									</article>
								</div>
							</div>
						</div>
					</section>
				</div>

		<!-- Scripts -->
			<script src='assets/js/jquery.scrolly.min.js'></script>
			<script src='assets/js/jquery.scrollex.min.js'></script>
			<script src='assets/js/browser.min.js'></script>
			<script src='assets/js/breakpoints.min.js'></script>
			<script src='assets/js/util.js'></script>
			<script src='assets/js/main.js'></script>

	</body>
		";
}
} catch (PDOException $e) {
	$e->getMessage();
}
?>
</html>
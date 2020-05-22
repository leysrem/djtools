<!DOCTYPE HTML>



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
					$('.wrapper-artistes').append("<input placeholder='Selectionner l artiste' name='artiste[]' list='Artistes' id='Artiste-"+x+"' class='artistes' required/>");
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
			
		   // Requete pour afficher la liste des albums
			$RsqlAlbum = 'SELECT * FROM album';

			$query = $db->prepare($RsqlAlbum);
			$query->execute();
			$albums = $query->fetchAll(PDO::FETCH_ASSOC);
			
			

			if (isset($_POST["option"]) == "ajouter") {

				$id_albums = $_POST["id_album"];

				$nom_genre = $_POST["genre"];
				$artistes = $_POST["artiste"];
				$nom_morceau = $_POST["titre-morceau"];

				$verifGenre = "SELECT * FROM genre WHERE nom_genre = '".$nom_genre."'";

				$query = $db->prepare($verifGenre);
				$query->execute();
				$genres = $query->fetchAll(PDO::FETCH_ASSOC);

			
				// GESTION GENRE 
				if(!count($genres) == 0) {	
					// SI IL EXISTE
					foreach($genres as $genre) 
					{
						$id_genre = $genre['id_genre'];
					}
					// AJOUTE LE GENRE AU NOUVEAU MORCEAU
					$ajouterMorceau = "INSERT INTO morceau (titre_morceau, fk_id_genre) VALUES ('".$nom_morceau."','".$id_genre."')";
					$query = $db->prepare($ajouterMorceau);
					$query->execute();
				} else {
					// AJOUTER LE NOUVEAU GENRE
					$ajouterGenre = "INSERT INTO genre (nom_genre) VALUES ('".$nom_genre."')";
					$query = $db->prepare($ajouterGenre);
					$query->execute();
					// RECUP LE NOUVEAU GENRE
					$getLastGenre = "SELECT MAX(id_genre) as id_genre FROM genre";
					$query = $db->prepare($getLastGenre);
					$query->execute();
					$genres = $query->fetchAll(PDO::FETCH_ASSOC);

					foreach($genres as $genre) 
					{
						$id_genre = $genre['id_genre'];
					}
					// AJOUTE LE GENRE AU NOUVEAU MORCEAU
					$ajouterMorceau = "INSERT INTO morceau (titre_morceau, fk_id_genre) VALUES ('".$nom_morceau."','".$id_genre."')";
					$query = $db->prepare($ajouterMorceau);
					$query->execute();
				}
				
					// RECUP ID DU NOUVEAU MORCEAU
					$getLastMorceau = "SELECT MAX(id_morceau) as id_morceau FROM morceau";
					$query = $db->prepare($getLastMorceau);
					$query->execute();
					$morceaux = $query->fetchAll(PDO::FETCH_ASSOC);

					foreach($morceaux as $morceau) {
						$id_morceau = $morceau["id_morceau"];
					}
					// VERIF POUR CHAQUE ARTISTE
					for($i=0;$i < count($artistes);$i++) 
					{

						$verifArtiste = "SELECT * FROM Artiste WHERE nom_artiste = '".$artistes[$i]."'";

						$query = $db->prepare($verifArtiste);
						$query->execute();
						$theArtist = $query->fetchAll(PDO::FETCH_ASSOC);

						// GESTION ARTISTE
						if(!count($theArtist) == 0) 
						{
							// SI IL EXISTE	
							foreach($theArtist as $artiste) 
							{
								$id_artiste = $artiste['id_artiste'];
							}
							// AJOUTE L'ARTISTE AU NOUVEAU MORCEAU
							$ajouterArtiste = "INSERT INTO artiste_morceau (Ref_morceau,Ref_artiste) VALUES ('".$id_morceau."','".$id_artiste."')";
							$query = $db->prepare($ajouterArtiste);
							$query->execute();
						} else {
							// AJOUTER LE NOUVELLE ARTISTE
							$ajouterNewArtiste = "INSERT INTO artiste (nom_artiste) VALUES ('".$artistes[$i]."')";
							$query = $db->prepare($ajouterNewArtiste);
							$query->execute();
							// RECUP ID DU NOUVELLE ARTISTE
							$getLastArtiste = "SELECT MAX(id_artiste) as id_artiste FROM artiste";
							$query = $db->prepare($getLastArtiste);
							$query->execute();
							$newArtist = $query->fetchAll(PDO::FETCH_ASSOC);

							foreach($newArtist as $artiste) 
							{
								$id_artiste = $artiste['id_artiste'];
							}
							//AJOUTE L'ARTISTE AU MORCEAU
							$ajouterNewArtiste = "INSERT INTO artiste_morceau (Ref_morceau,Ref_artiste) VALUES ('".$id_morceau."','".$id_artiste."')";
							$query = $db->prepare($ajouterNewArtiste);
							$query->execute();
						}
					}

					// RECUP ID DU NOUVEAU MORCEAU
					$getLastMorceau = "SELECT MAX(id_morceau) as id_morceau FROM morceau";
					$query = $db->prepare($getLastMorceau);
					$query->execute();
					$morceaux = $query->fetchAll(PDO::FETCH_ASSOC);

					foreach($morceaux as $morceau) {
						$id_morceau = $morceau["id_morceau"];
					}
					// GESTION FICHIER	
					$extensions_autorisees = array('.mp3','.mp4','.wma','.ogg','.wav');
						
					for($i=0;$i < count($id_albums);$i++) 
					{
						
						$RsqlAlbum = "SELECT * FROM album WHERE id_album = '".$id_albums[$i]."'";
						$albums = $db->prepare($RsqlAlbum);
						$albums->execute();
				
						// RECUP LE(S) NOM(S) DU/DES ALBUM(S)
						foreach($albums as $album) {
							$nom_album = $album['nom_album'];	
						}

						$file_name = $_FILES['fichier']['name'];	
						$file_tmp_name = $_FILES['fichier']['tmp_name'];
						$file_dest = 'albums/'.$nom_album.'/'.$file_name;
						
						$file_extension = strrchr($file_name,'.');
						if(in_array($file_extension,$extensions_autorisees)) {
							if(copy($file_tmp_name,$file_dest)) {
								echo 'Fichier envoyé avec succès';
								
								$ajouterMorceauAlbum = "INSERT INTO album_morceau (Ref_morceau,Ref_album,url_morceau) VALUES ('".$id_morceau."','".$id_albums[$i]."','".$file_dest."')";
								$query = $db->prepare($ajouterMorceauAlbum);
								$query->execute();
		
							} else {
								echo "erreur lors de l'envoie du fichier";
							}
		
						} else {
							echo "Extension de fichier non autorisé";
						}

					}
				
				header('Location:ajouter-morceau.php');
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
							<li><a href='playlist.php'><span class='icon solid fa-th'>Playlist</span></a></li>
							<li><a href='ajouter-morceau.php'><span class='icon solid fa-plus'>Ajouter un morceau</span></a></li>
							<li><a href='ajouter-album.php'><span class='icon solid fa-plus'>Ajouter un album</span></a></li>
							<li><a href='ajouter-playlist.php'><span class='icon solid fa-plus'>Ajouter une playlist</span></a></li>
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
										<form class='addform' action='' method='post' enctype='multipart/form-data'>
											<h2>Ajouter un morceau</h2>
											<fieldset>
												<input class='input-upload' id='le-morceau' name='fichier' type='file' required accept='audio/mp3, audio/mp4, audio/wma, audio/ogg, audio/wav'>
											</fieldset>
											<input placeholder='Nom du morceau' type='text' tabindex='1' name='titre-morceau' required autofocus> 
											<hr>
											<fieldset>
												<div class='wrapper-genres'>
													<input placeholder='Selectionner le genre' name='genre' list='Genres' class='genres' required/>
													<datalist id='Genres' tabindex='2' required>
													";

													$genres = 'SELECT * FROM genre';

													$query = $db->prepare($genres);
													$query->execute();
													$genres = $query->fetchAll(PDO::FETCH_ASSOC);

													foreach ($genres as $row => $genre) 
													{

													echo "
														<option value='".$genre['nom_genre']."'>
														";
													}
												echo "
													</datalist>
												</div>
											</fieldset>	
											<hr>
											<fieldset>
												<button type='button' class='modifier-artistes-btn' id='ajouter-artiste' onclick='modifier_artistes(this.id)'>Ajouter un artiste</button>
												<button type='button' class='modifier-artistes-btn' id='supprimer-artiste' onclick='modifier_artistes(this.id)' disabled>Supprimer un artiste</button>
											</fieldset>
											<fieldset>
												<div class='wrapper-artistes'>
													<input placeholder='Selectionner l artiste' name='artiste[]' list='Artistes' id='Artiste-1' class='artistes' required/>
													<datalist id='Artistes' tabindex='2' required>
													";
													$artistes = 'SELECT * FROM artiste';

													$query = $db->prepare($artistes);
													$query->execute();
													$artistes = $query->fetchAll(PDO::FETCH_ASSOC);

													foreach ($artistes as $row => $artiste) 
													{

												echo "	
														<option value='".$artiste['nom_artiste']."'>
													";
													}
												echo "
													</datalist>
												</div>
											</fieldset>
											<hr>
											<fieldset>
												<input type='text' id='myInputSearchBar' placeholder='Rechercher un album ...' title='Type in a name' class='input-search-bar'>
											</fieldset>

											<div class='item-container'>
											<table>
												<tbody id='album-item-list'>";
												
												foreach ($albums as $row => $album) 
												{
												echo "
													<tr class='item-album' id='item-album-".$album['id_album']."'>
														<td>".$album['nom_album']."</td>
														<td> <input type='checkbox' name='id_album[]' value='".$album['id_album']."' id='item-album-".$album['id_album']."-checkbox'/></td>
													</tr>
														";
												}
											echo "	
												</tbody>
											</table>
											</div>	
						
												</table>
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
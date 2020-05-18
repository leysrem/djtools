<!DOCTYPE HTML>

<?php
	$dataBase = mysqli_connect ( "localhost" , "root" , "" ) ;

	//--- Ouverture de la base de données
	mysqli_select_db ( $dataBase, "djtools" ) ;

	$requete = "select * from morceau;";

	$resultat = mysqli_query($dataBase, $requete , MYSQLI_USE_RESULT) or die(mysql_error());

	

?>
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
	<body class="is-preload">
		<!-- Header -->
			<div id="header">
				<div class="top">

					<!-- Logo -->
					<div id="logo">
						<h1 id="title">DJTools</h1>
					</div>

					<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="album.php"><span class="icon solid fa-th">Albums</span></a></li>
							<li><a href="playlist.php"><span class="icon solid fa-th">Playlist</span></a></li>
							<li><a href="ajouter-morceau.php"><span class="icon solid fa-plus">Ajouter un morceau</span></a></li>
							<li><a href="ajouter-album.php"><span class="icon solid fa-plus">Ajouter un album</span></a></li>
							<li><a href="ajouter-playlist.php"><span class="icon solid fa-plus">Ajouter une playlist</span></a></li>
						</ul>
					</nav>
				</div>
			</div>

		<!-- Main -->
			<div id="main">
				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">
							<div class="row">
								<div class="col-12 col-12-mobile">
									<article class="item" id='1'>
										<form class="addform" action="" method="get">
											<h2>Ajouter un morceau</h2>
											<fieldset>
												<input class='input-upload' id='le-morceau' type="file" required accept="audio/mp3, audio/mp4, audio/wma, audio/ogg, audio/wav">
											</fieldset>
											<input placeholder="Nom du morceau" type="text" tabindex="1" name='titre-morceau' required autofocus> 
											<hr>
											<fieldset>
												<div class="wrapper-genres">
													<input placeholder="Selectionner le genre" name="genre" list="Genres" class="genres" required/>

													<datalist id="Genres" tabindex="2" required>
														<option value="Exemple genre 1">
														<option value="Exemple genre 2">
														<option value="Exemple genre 3">
														<option value="Exemple genre 4">
														<option value="Exemple genre 5">
													</datalist>
												</div>
											</fieldset>	
											<hr>
											<fieldset>
												<button type="button" class='modifier-artistes-btn' id="ajouter-artiste" onclick="modifier_artistes(this.id)">Ajouter un artiste</button>
												<button type="button" class='modifier-artistes-btn' id="supprimer-artiste" onclick="modifier_artistes(this.id)" disabled>Supprimer un artiste</button>
											</fieldset>
											<fieldset>
												<div class="wrapper-artistes">
													<input placeholder="Selectionner l artiste" name="artiste[]" list="Artistes" id="Artiste-1" class="artistes" required/>

													<datalist id="Artistes" tabindex="2" required>
														<option value="Exemple artiste 1">
														<option value="Exemple artiste 2">
														<option value="Exemple artiste 3">
														<option value="Exemple artiste 4">
														<option value="Exemple artiste 5">
													</datalist>
												</div>
											</fieldset>
											<hr>
											<fieldset>
												<input type="text" id="myInputSearchBar" placeholder="Rechercher un album ..." title="Type in a name" class='input-search-bar'>
											</fieldset>

											<div class='item-container'>
											<table>
												<tbody id='album-item-list'>
													<tr class="item-album" id='item-album-1'>
														<td>Deux freres</td>
														<td>PNL</td>
														<td><input type="checkbox" name='item-album' value='Deux freres' id='item-album-1-checkbox'/></td>
													</tr>
													<tr class="item-album" id='item-album-2'>
														<td>Polak</td>
														<td>PLK</td>
														<td><input type="checkbox" name='item-album' value='Polak' id='item-album-2-checkbox'/></td>
													</tr>
													<tr class="item-album" id='item-album-3'>
														<td>Commando</td>
														<td>Niska</td>
														<td><input type="checkbox" name='item-album' value='Commando' id='item-album-3-checkbox'/></td>
													</tr>
												</tbody>
											</table>
											</div>	
						
												</table>
												<fieldset>
													<button type="submit" id="ajouter-morceau">Ajouter</button>
											  </fieldset>
										</form>
									</article>
								</div>
							</div>
						</div>
					</section>
				</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
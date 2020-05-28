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
	</head>

<?php

$dsn = 'mysql:dbname=djtools;host=localhost';
$user = 'root';
$password = '';

try {
	$db = new PDO($dsn, $user, $password);
	 if ($db) {

		$id_album = $_GET["id_album"];
	  
	 // Alerte a chaque fois qu'une requête échoue
	 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  
	 // Désactive la simulation des requêtes préparés, 
	 // utilise l'interface native pour récupérer les données et leur type.
	 $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 

	$afficherMusique = "SELECT m.id_morceau as id_morceau, am.url_morceau as url_morceau , m.duree_morceau as duree_morceau, m.titre_morceau as titre_morceau, a.nom_artiste as nom_artiste
	FROM morceau m
	JOIN album_morceau am ON m.id_morceau = am.Ref_morceau 
	JOIN artiste_morceau arm ON am.Ref_morceau = arm.Ref_morceau
	JOIN artiste a ON arm.Ref_artiste = a.id_artiste
    WHERE am.Ref_album = ".$id_album."";
    
   

	$query = $db->prepare($afficherMusique);
	$query->execute();
    $musiques = $query->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($musiques as $musique) {
       $url_morceau =  $musique["url_morceau"];
    }

	$afficherAlbum = "SELECT * FROM album WHERE id_album = ".$id_album."";

	$query = $db->prepare($afficherAlbum);
	$query->execute();
    $albums = $query->fetchAll(PDO::FETCH_ASSOC);

    
    
    if(isset($_GET["id_morceau"])) {
        $id_morceau = $_GET["id_morceau"];
        // SUPPRIME LE MORCEAU 
        $supprimerMorceau = "DELETE FROM morceau where id_morceau= $id_morceau";
        $query = $db->prepare($supprimerMorceau);
        $query->execute();
        
        // SUPPRIMER MUSIQUE DANS LE DOSSIER
        unlink($url_morceau);

        header("Location:suppr-ele.php?id_album=".$id_album."");
        exit;
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
										<form class='addform form' action='ajouter.html' method='get'>
											<div class='container'>
												<div class='row'>
													<div class='col-3 col-12-mobile'>";

													foreach($albums as $album) {

													$pochette = $album["pochette_album"];
													echo "
														<article class='item-album' id='item-album-1' style='background-image: url(./)'>
															<a class='image'><img src='".$pochette."' alt='' /></a>
														</article>
														";
														
}
													echo "
													</div>
													<div class='col-9 col-12-mobile album-data'>";
													foreach($albums as $album) {
													echo "
														<h3>".$album['nom_album']." </h3>";
													}
													foreach($musiques as $musique) {
													echo "
														<h4>".$musique["nom_artiste"]."</h4>";
													}
													foreach($albums as $album) {
													echo "
														<h4>".$album['annee_album']."</h4>
														";
													}
													
													echo "
													</div>
												</div>
											</div>	
										</form>
									</article>
								</div>
							</div>
							<div class='item-container'>
							<table id='playlist'>
							";

							foreach($musiques as $musique) {

							echo "
								<tr >
									<td> ".$musique["titre_morceau"]." </td>
									<td> ".$musique["nom_artiste"]." </td>
                                    <td> ".$musique["duree_morceau"]." </td>
                                    <td> <a href='suppr-ele.php?id_album=".$id_album."&id_morceau=".$musique["id_morceau"]."'> <span class='icon delete solid fa-trash'></span> </a> </td>
								</tr>";
							}

						echo "
							</table>
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
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
		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.scrolly.min.js"></script>
		<script src="assets/js/jquery.scrollex.min.js"></script>
		<script src="assets/js/browser.min.js"></script>
		<script src="assets/js/breakpoints.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>
		<script>
			$(document).ready(function() {
				$("#myInputSearchBar").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$(".box-container").filter(function() {
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

			$AfficherAlbum = "SELECT * FROM album";
			$albums = $db->prepare($AfficherAlbum);
            $albums->execute();

            if(isset($_GET["confirmez"])) {

                if($_GET["choice"] == 'oui') {

                    $id_album = $_GET["id_album"];
                    $nom_album = $_GET["nom_album"];

                    $dir = "albums/".$nom_album."";

                    // SUPPRIME LES FICHIERS D'UN DOSSIER
                    if (is_dir($dir)) {
                        $objects = scandir($dir);
                        foreach ($objects as $object) {
                            if ($object != "." && $object != "..") {
                                unlink($dir."/".$object);
                            }
                        }
                    }
                    rmdir("$dir");

                    $supprimerAlbum = "DELETE FROM album where id_album = $id_album";
                    $query = $db->prepare($supprimerAlbum);
                    $query->execute(); 

                    header('Location:suppr-album.php');
                    exit;
                } else {
                    header('Location:suppr-album.php');
                    exit;
                }
            }
            
			
	echo "
	<body class='is-preload'>
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
            ";
            if(isset($_GET["option"]) == 'supprimer') {

                $id_album = $_GET["id"];
                $nom_album = $_GET["nom_album"];

                   echo "   
                        <form class='addform' action='' method='get'>
                            <div class='alert'>
                                Etes-vous sur de vouloir supprimer l'album ".$nom_album." ?
                                <input type='hidden' name='id_album' value='".$id_album."' >
                                <input type='hidden' name='nom_album' value='".$nom_album."' >
                                <input type='radio' name='choice' value='oui' class='choice' value='huey'> <label> Oui </label>
                                <input type='radio' name='choice' value='non' class='choice' value='huey'> <label> Non </label>
                                <button type='submit' name='confirmez' value='confirmer' id='ajouter-morceau'>Confirmer</button>
                            </div>
                        </form>
                        
                    "; 
                }

            
            echo "
				<!-- Portfolio -->
				<section id='portfolio' class='two'>
					<input type='text' id='myInputSearchBar' placeholder='Rechercher un album ...' title='Type in a name' class='my-2'>
					<div class='container flex-container'>
                    ";

					foreach ($albums as $album) {

					$pochette = $album["pochette_album"];

					echo "
						<a href='suppr-ele.php?id_album=".$album["id_album"]."'>
							<div class='box-container'>
								<div class='album-cover' style='background-image: url(./".$pochette.");'></div>
                                <div class='box-desc'>".$album["nom_album"]."  <a href='suppr-album.php?option=supprimer&id=".$album["id_album"]."&nom_album=".$album["nom_album"]."'><span class='icon delete solid fa-times'></span></a> </div>
							</div>
						</a>
						";
					}

				echo "
					</div>
				</section>
			</div>
	</body>
	";
}
} catch (PDOException $e) {
	$e->getMessage();
}
?>
</html>
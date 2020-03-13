<!DOCTYPE HTML>
<!--
	Prologue by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
	$dataBase = mysqli_connect ( "localhost" , "root" , "" ) ;

	//--- Ouverture de la base de données
	mysqli_select_db ( $dataBase, "djtools" ) ;

	$requete = "select * from morceau;";

	$date = "select date_morceau, DATE_FORMAT(date_morceau, '%Y') from morceau;";

	$resultat = mysqli_query($dataBase, $requete , MYSQLI_USE_RESULT) or die(mysql_error());

	

?>
<html>
	<head>
		<title>Prologue by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<script type="text/javascript" src="assets/js/jquery.min.js"></script>
		<script src="assets/js/musicplayer.js"></script>
	</head>
	<body class="is-preload">

		<!-- Header -->
			<div id="header">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
							<span class="image avatar48"><img src="images/avatar.jpg" alt=""/></span>
							<h1 id="title">Dj Tools</h1>
							<p>Logiciel de DJ</p>
						</div>

					<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="index.php"><span class="icon solid fa-th">Albums</span></a></li>
							<li><a href="#portfolio"><span class="icon solid fa-th">Playlist</span></a></li>
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
										<form class="addform" action="ajouter.html" method="get">
											<h2>Musique</h2>
											<div class="container">
												<div class="row">
													<div class="col-3 col-12-mobile">
														<article class="item-album" id='item-album-1' style="background-image: url(images/pic04.jpg)">
															<a class="image"><img src="images/pic02.jpg" alt="" /></a>
														</article>
													</div>
													<div class="col-9 col-12-mobile album-data">
														<h3>Nom de l'album</h3>
														<h4>Nom des artistes</h4>
														<h4>Genre</h4>
														<h4>Année</h4>
													</div>
												</div>
											</div>	
										</form>
									</article>
								</div>
							</div>
							<div class='item-container'>
							<table id="playlist">

								<?php
											
									echo "<tr>";
										echo "<th></th>";
										echo "<th>Titre</th>";
										echo "<th>Date</th>";
										echo "<th>Durée</th>";
										echo "<th></th>";
										echo "<th>Ajouter</th>";
										echo "</tr>";
										
										while ($ligne = mysqli_fetch_array($resultat,MYSQLI_ASSOC))
										{
											//--- Afficher une ligne du tableau HTML pour chaque enregistrement de la table 
											echo "<tr>\n";
											echo "<td> <a href=". $ligne['url_morceau'] ."> <i class='fas fa-play'></i> </a> </td>\n";
											echo "<td>" . $ligne['titre_morceau']       . "</td>\n" ;
											echo "<td>" . $ligne['date_morceau']    . "</td>\n" ;
											echo "<td>" . $ligne['duree_morceau']/60 . "</td>\n" ;
											echo "<td>" . $ligne['url_morceau'] . "</td>\n" ;
											echo "<td> <i class='fas fa-plus-square'></i> </td>\n";
											echo "</tr>\n";
										}
										
										//--- Libérer l'espace mémoire du résultat de la requête
										mysqli_free_result ( $resultat ) ;

										//--- Déconnection de la base de données
										mysqli_close ( $dataBase ) ;  
								?>
							</table>
							<?php
								echo "</div>";
									echo "<audio id='audio' tabindex='0' controls='' controlsList='nodownload'>";
									while (  $ligne = mysqli_fetch_array($resultat,MYSQLI_ASSOC)  )
										echo"<source src=" .$ligne['url_morceau'].">";
										echo "Your Fallback goes here";
								echo "</audio>";
							?>
						
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
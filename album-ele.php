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
										<form class="addform" action="ajouter.html" method="get">
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
								<tr >
									<td> <a href="PNL-Blanka.mp3"> <i class="fas fa-play"></i> </a> </td>
									<td> Blanka </td>
									<td> PNL </td>
									<td> 5:04 </td>
									<td> 2019 </td>
									<td> <i class="fas fa-plus"></i> </td>
								</tr>
								<tr>
									<td> <a href="koba-lad-mortel-video-clip-inspire-de-la-serie-mortel.mp3"> <i class="fas fa-play"></i> </a> </td>	
									<td> Mortel </td>
									<td> Koba </td>
									<td> 5:04 </td>
									<td> 2019 </td>
									<td> <i class="fas fa-plus"></i> </td>
								</tr>
								<tr>
									<td> <a href="PNL - Deux Frères [Clip officiel].mp3"> <i class="fas fa-play"></i> </a> </td>	
									<td> Deux frères </td>
									<td> PNL </td>
									<td> 5:04 </td>
									<td> 2019 </td>
									<td> <i class="fas fa-plus"></i> </td>
								</tr>
								<tr>
									<td> <a href="PNL - Deux Frères [Clip officiel].mp3"> <i class="fas fa-play"></i> </a> </td>	
									<td> Deux frères </td>
									<td> PNL </td>
									<td> 5:04 </td>
									<td> 2019 </td>
									<td> <i class="fas fa-plus"></i> </td>
								</tr>
								<tr>
									<td> <a href="PNL - Deux Frères [Clip officiel].mp3"> <i class="fas fa-play"></i> </a> </td>	
									<td> Deux frères </td>
									<td> PNL </td>
									<td> 5:04 </td>
									<td> 2019 </td>
									<td> <i class="fas fa-plus"></i> </td>
								</tr>
								<tr>
									<td> <a href="PNL - Deux Frères [Clip officiel].mp3"> <i class="fas fa-play"></i> </a> </td>	
									<td> Deux frères </td>
									<td> PNL </td>
									<td> 5:04 </td>
									<td> 2019 </td>
									<td> <i class="fas fa-plus"></i> </td>
								</tr>
								
							</table>
							</div>
						</div>
					</section>
				</div>
				<audio id="audio" preload="auto" tabindex="0" controls="" controlsList="nodownload">
					<source src="PNL-Blanka.mp3">
					Your Fallback goes here
				</audio>


		<!-- Scripts -->
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
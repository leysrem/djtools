$(document).ready(function () {
	init();
	function init(){
		var current = 0;
		var audio = $('#audio');
		var playlist = $('#playlist');
		var tracks = playlist.find('li a');
		var len = tracks.length; // Nombre de musiques dans la playlist -1
		audio[0].volume = .10;
		audio[0].play();
		playlist.on('click','a', function(e){
			e.preventDefault();
			link = $(this);
			current = link.parent().index();
			run(link, audio[0]);
		});
		audio[0].addEventListener('ended',function(e){
			current++; // Musique actuelle +1 (suivante)
			if(current == len){ // Si fin de playlist, retourne debut
				current = 0;
				link = playlist.find('a')[0];
			}else{
				link = playlist.find('a')[current]; // Va a la musique suivante 
			}
			run($(link),audio[0]); // Lance la musique
		});
	}

	function run(link, player){
		player.src = link.attr('href');
		par = link.parent();
		$('td').removeClass('active');
		par.addClass('active');
		player.load();
		player.play();
	}
});
#-------------------------------------------------------------------------------
#  Effacer la BD (si elle existait déjà)

DROP DATABASE IF EXISTS Djtools ;

#-------------------------------------------------------------------------------
#  Créer la BD

CREATE DATABASE Djtools ;

#-------------------------------------------------------------------------------
#  Utiliser la BD

USE Djtools ;


#-------------------------------------------------------------------------------



#-------------------------------------------------------------------------------
#  Créer la table Album 

CREATE TABLE album
(	id_album	INT NOT null  PRIMARY KEY AUTO_INCREMENT,
	nom_album	CHAR( 255 )	NOT NULL, 
	annee_album	int( 4 )	NOT NULL,
    pochette_album CHAR ( 255 )	
     
)  ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;
#-------------------------------------------------------------------------------



#-------------------------------------------------------------------------------
#  Créer la table Morceau

CREATE TABLE morceau 
(	id_morceau INT NOT null PRIMARY KEY	AUTO_INCREMENT,
	titre_morceau	CHAR( 255 )	NOT NULL,
	date_morceau 	DATETIME  NOT NULL,
	duree_morceau CHAR (6) NOT NULL
     
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;
#-------------------------------------------------------------------------------


#-------------------------------------------------------------------------------

#  Créer la table Playlist 

CREATE TABLE playlist
(	id_playlist INT NOT null PRIMARY KEY	AUTO_INCREMENT,
	nom_playlist	CHAR( 255 )	NOT NULL
     
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;


#-------------------------------------------------------------------------------

#  Créer la table genre

CREATE TABLE genre
(	id_genre INT NOT null PRIMARY KEY	AUTO_INCREMENT,
	nom_genre	CHAR( 255 )	NOT NULL
     
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;

#-------------------------------------------------------------------------------

#  Créer la table artiste

CREATE TABLE artiste
(	id_artiste INT NOT null PRIMARY KEY	AUTO_INCREMENT,
	nom_artiste	CHAR( 255 )	NOT NULL
     
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;

#-------------------------------------------------------------------------------


CREATE TABLE album_morceau
(
  Ref_morceau integer,
  Ref_album   integer,
  
  FOREIGN KEY (Ref_morceau) REFERENCES morceau(id_morceau) ON DELETE CASCADE ,            
  FOREIGN KEY (Ref_album) REFERENCES album(id_album) ON DELETE CASCADE ,
  PRIMARY KEY (Ref_morceau,Ref_album) 

) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;

CREATE TABLE genre_morceau
(
  Ref_morceau integer,
  Ref_genre   integer,
  
  FOREIGN KEY (Ref_morceau) REFERENCES morceau(id_morceau) ON DELETE CASCADE ,            
  FOREIGN KEY (Ref_genre) REFERENCES genre(id_genre) ON DELETE CASCADE ,
  PRIMARY KEY (Ref_morceau,Ref_genre) 

) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;

CREATE TABLE playlist_morceau
(
  Ref_playlist integer,
  Ref_morceau   integer,
  
  FOREIGN KEY (Ref_morceau) REFERENCES morceau(id_morceau) ON DELETE CASCADE ,            
  FOREIGN KEY (Ref_playlist) REFERENCES playlist(id_playlist) ON DELETE CASCADE ,
  PRIMARY KEY (Ref_morceau,Ref_playlist) 

) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;

CREATE TABLE artiste_morceau
(
  Ref_artiste integer,
  Ref_morceau   integer,
  
  FOREIGN KEY (Ref_morceau) REFERENCES morceau(id_morceau) ON DELETE CASCADE ,            
  FOREIGN KEY (Ref_artiste) REFERENCES artiste(id_artiste) ON DELETE CASCADE ,
  PRIMARY KEY (Ref_morceau,Ref_artiste) 

) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;










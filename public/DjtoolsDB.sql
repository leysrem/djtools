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

DROP TABLE IF EXISTS `morceau`;
CREATE TABLE IF NOT EXISTS `morceau` (
  `id_morceau` int(11) NOT NULL AUTO_INCREMENT,
  `titre_morceau` varchar(255) NOT NULL,
  `duree_morceau` varchar(255) NOT NULL,
  `fk_id_genre` int(11) NOT NULL,
  PRIMARY KEY (`id_morceau`),
  KEY `fk_id_genre` (`fk_id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
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
 `url_morceau` varchar(255) DEFAULT NULL,
  
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


CREATE TABLE artiste_morceau
(
  Ref_artiste integer,
  Ref_morceau   integer,
  
  FOREIGN KEY (Ref_morceau) REFERENCES morceau(id_morceau) ON DELETE CASCADE ,            
  FOREIGN KEY (Ref_artiste) REFERENCES artiste(id_artiste) ON DELETE CASCADE ,
  PRIMARY KEY (Ref_morceau,Ref_artiste) 

) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;










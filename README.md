# bilemo
Un web service exposant une API

<p>Projet 7 du parcours développeur d'application PHP/Symfony chez OpenClassrooms : Créez un web service exposant une API</p>
<p>Réalisé en PHP 7.3.5 et Symfony 5.1.7</p>
<hr />
<a href="https://codeclimate.com/github/glerique/bilemo/maintainability"><img src="https://api.codeclimate.com/v1/badges/d0204bf4bfeccd221077/maintainability" /></a>
<hr />

Installer l'application

    - Clonez le repository GitHub
    
    - Configurez vos variables d'environnement dans le fichier .env :    
      
      => DATABASE_URL=mysql://root:@127.0.0.1:3306/bilemo?serverVersion=5.7 pour la base de données
      
    - Téléchargez et installez les dépendances du projet avec la commande Composer suivante : composer install
    
    - Créez la base de données en utilisant la commande suivante : php bin/console doctrine:database:create
    
    - Installer les fixtures pour avoir un jeu de données fictives avec la commande suivante : php bin/console doctrine:fixtures:load


<hr />

Genérer les clés SSH

    - mkdir -p config/jwt
    
    - openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096 
     
    - openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout

<hr />

Lancer L'application
	    
    - Lancez le serveur à l'aide de la commande suivante : php -S localhost:8000 -t public
    
    - Vous pouvez désormais commencer à utiliser l'appication Bilemo sur http://localhost:8000/api
    
    - Vous pouvez effectuer Des requetes HTTP à l'aide du logiciel Postman  
    
<hr />

Documentation API - Swagger
	    
    - http://localhost:8000/api/docs
<hr />

Utilisateur par défaut
	    
    {
  	"username": "user@nesweb.fr",
 	"password": "password"
	}



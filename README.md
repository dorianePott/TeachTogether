# TeachTogether
*Une [**version française**](#fr) est disponible plus bas.*

TeachTogether is an online moodle built with html/css on the front end, and PHP/MySQL on the back end.

## Getting started

### Prerequisites
You will need:
- A local installation of [PHP](https://www.php.net/downloads.php) (version 7.2 or newer)
- A [MySQL](https://mysql.com/download) database

### Installation
1. Import the database structure from the `TeachTogether/model/sql/structure.sql` file:
```bash
cd TeachTogether/model/sql
mysql
mysql> use {your table name};
mysql> source structure.sql;
```

2. Make a copy of the `const.php` file in `/model/const.php` and fill in your database credentials.

3. Make sure the `storage` folder is writable by the server.

4. Make sure that in your php.ini, the upload_max_filesize = 5M

### Information
1. the admin user of the site, can't be created by the register, you have to create it in the DB.

2. I created a default one, named 'admin', with the mail: 'admin@teacher.com' and the password 'admin'.

## Authors
- **Doriane Pott** ([doriane.pott@bluewin.ch](mailto:doriane.pott@bluewin.ch))

# <a name="fr"></a> TeachTogether *(version française)*
TeacheTogether est un moodle en ligne créé avec html/css côté navigateur, et PHP/MySQL du côté serveur.

## Pour débuter

### Pré-requis
Vous avez besoin de :
- Un installation locale de [PHP](https://www.php.net/downloads.php) (version 7.2 ou plus récent)
- Une base de données [MySQL](https://mysql.com/download)

### Installation
1. Importez la structure de la base de données depuis le fichier `TeachTogether/model/sql/structure.sql`:
```bash
cd TeachTogether/model/sql
mysql
mysql> use {your table name};
mysql> source structure.sql;
```

2. Faites une copie du fichier `const.php` dans le dossier `/model/const.php` et remplissez avec vos identifiants de connexion à la base de données.

3. Assurez-vous que le serveur a les droits d'écriture sur le dossier `storage`.

4. Assurez-vous que dans votre fichier php.ini, la ligne avec upload_max_filesize, correspondent à upload_max_filesize = 5M


### Information
1. L'utilisateur administrateur du site ne peut pas être crée vie le register, vous devez le créer dans la base de données.

2. J'en ai créé un par défaut, nommé 'admin', avec le mail : 'admin@teacher.com' et le mot de passe 'admin'.

## Auteurs
- **Doriane Pott** ([doriane.pott@bluewin.ch](mailto:doriane.pott@bluewin.ch))

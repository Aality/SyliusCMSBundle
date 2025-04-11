# Guide de Création d'un Bundle pour Aality

Ce guide vous explique comment créer un petit bundle en suivant les conventions de nommage et d'organisation de l'organisation Aality.

## Sommaire
### 1 - Première étape : création du bundle
### 2 - Inclure le bundle via un path local pour valider le fonctionnement
### 3 - Inclure en mode VCS


## Conventions de Nommage

- **Namespace** : Utilisez `Aality\NomDuBundle` comme namespace pour votre bundle.
- **Nom du Bundle** : Le nom du bundle doit être identique à celui du dépôt GitHub de l'organisation.


En cours de taff sur les conventions de nommages, les exemples ne reflètent pas bien ce qu'il faut faire pour le moment.

## 1 - Première étape : création du bundle

Créer un dépot github, on ne va pas l'inclure tout de suite mais le nom du dépot est important pour la suite.

Suivre la doc Symfony

Bien respecter les conventions.

Voici un exemple de fichier `composer.json` à dupliquer et adapter pour votre bundle :

```json
{
  "name": "aality/cms-bundle",
  "description": "Gestion des pages CMS",
  "type": "sylius-plugin",
  "require": {
    "php": ">=8.2"
  },
  "version": "1.0.0",
  "autoload": {
    "psr-4": {
      "Aality\\SyliusCMSBundle\\": "src/"
    }
  }
}

```

Une fois en place et votre code de base présent, pensez à faire un ``composer install``

# 2 - Inclure le bundle via un path local


Editez composer.json de l'app :

```json
{
  "repositories": [
    {
      "type": "path",
      "url": "../monDossier"
    }
  ],
  "require": {
    "php": "^8.2",
    "aality/cms-bundle": "1.0.0"
  }
}
````

On ne met pas le dossier directement dans notre app, mais dans notre www. 

Path à adapter.

### Attention 
```text 
Dès que l'on va installer le bundle, on va en faire une copie locale dans notre vendor.
Modifier le code source n'aura pas d'impact tant qu'on ne recommence pas l'installation
````
Pour installer, puis mettre à jour : 

``composer require aality/mon-bundle``

Pour chaque modif du bundle (ajout de fichiers etc), afin de tester : 

``composer install`` dans le bundle pour générer l'autoload, inclure les dépendances etc.

Puis, pour prendre en compte les modifications dans l'app : 

``composer require aality/mon-bundle`` dans le dossier de votre app.



## 3 - Inclure en mode VCS

Maintenant qu'on a testé, on peut passer par GIT :)

Editez composer.json de l'app : 

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/Aality/AaPageCmsBundle.git"
    }
  ],
  "require": {
    "php": "^8.2",
    "aality/cms-bundle": "dev-refacto"
  }
}
````

### Explications de dev-branch
dev-BRANCH : Cette notation permet à Composer de savoir qu'il doit utiliser une branche spécifique (par exemple, refacto) comme source pour installer le package.

Si on veut main : dev-main
Si on a créé des tags, on peut les utiliser directement : 1.0.0 (^1.*, >= 1.0.2 etc.)

### Installer le bundle !

Maintenant, faites simplement : 
``composer require aality/mon-bundle:dev-ma_branch``


Idem ici, à chaque modif du bundle, il faudra commit et pousser les modifications, puis mettre à jour les vendor locaux de notre app : 

``composer require aality/mon-bundle:dev-ma_branch``


WIP
// Peut être composer update ok ?? Mais risqué.
// Composer update aality/mon-bundle ??

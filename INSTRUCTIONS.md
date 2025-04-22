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

---
## 1 - Première étape : création du bundle

Créer un dépot github, on ne va pas l'inclure tout de suite mais le nom du dépot est important pour la suite.

Suivre la doc Symfony

Bien respecter les conventions.

Voici un exemple de fichier `composer.json` à dupliquer et adapter pour votre bundle :

```json
{
  "name": "aality/sylius-cms-bundle",
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

---
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
    "aality/sylius-cms-bundle": "1.0.0"
  }
}
````

On ne met pas le dossier directement dans notre app, mais dans notre www. 

Path à adapter.

### Attention 
```text 
Dès que l'on va installer le bundle, on va créer un lien symbolique dans notre vendor.
Modifier le code source du bundle, dans son dossier, aura un impact immédiat sur les projets dans lesquels il est inclus
````
Pour installer : 

``composer require aality/mon-bundle``

Pour chaque modif du bundle (ajout de fichiers etc) : 

``composer install`` dans le bundle pour générer l'autoload, inclure les dépendances etc.


---

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
    "aality/sylius-cms-bundle": "dev-refacto"
  }
}
````

### Explications de dev-branch
dev-BRANCH : Cette notation permet à Composer de savoir qu'il doit utiliser une branche spécifique (par exemple, refacto) comme source pour installer le package.

Si on veut main : dev-main
Si on a créé des tags, on peut les utiliser directement : 1.0.0 (^1.*, >= 1.0.2 etc.)

### Installer le bundle !


#### Si le dépot est privé, une étape s'impose

---
Avez-vous un token d'accès Github ?

```
Générer un Token d'Accès Personnel sur GitHub :

Connectez-vous à votre compte GitHub.
Allez dans Settings > Developer settings (tout en bas) > Personal access tokens.
Cliquez sur Generate new token.
Sélectionnez les autorisations nécessaires : repo 
Générez le token et copiez-le. 

Ouvrez le Terminal sur votre Mac.
Créez ou éditez le fichier auth.json de Composer.

Ce fichier se trouve généralement dans le répertoire ~/.composer

vim ~/.composer/auth.json

Puis copier le prochain bloc.
```


```json
{
    "github-oauth": {
        "github.com": "votre-token-d-acces"
    }
}
```

---
#### Dépot public ou privé avoir créé un token

Maintenant, faites simplement : 
``composer require aality/mon-bundle:dev-ma_branch``


Idem ici, à chaque modif du bundle, il faudra commit et pousser les modifications, puis mettre à jour les vendor locaux de notre app : 

``composer require aality/mon-bundle:dev-ma_branch``


WIP
// Peut être composer update ok ?? Mais risqué.
// Composer update aality/mon-bundle ??


# Recipes

## Provide a recipe to perform automated installa actions

## How recipe is distribute : 
https://stackoverflow.com/questions/71692969/how-to-generate-a-private-recipe-json-from-the-contents-of-a-recipe-directory
https://github.com/symfony-tools/recipes-checker


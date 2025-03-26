# AaPageCmsBundle
Page Cms Bundle for Sylius

After installing, add this to your configuration :

config/routes.yaml :
```
- resource: "@AaPageCmsBundle/Resources/config/routes.yaml"
```

config/packages/_sylius.yaml : 
```
imports:
    - { resource: "@AaPageCmsBundle/Resources/config/app/config.yaml" }
```

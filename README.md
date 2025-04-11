# SyliusCMSBundle
Page Cms Bundle for Sylius

After installing, add this to your configuration :

config/routes.yaml :
```
aa_page_cms_bundle:
    resource: "@SyliusCMSBundle/Resources/config/routes.yaml"
```

config/packages/_sylius.yaml : 
```
imports:
    - { resource: "@SyliusCMSBundle/Resources/config/app/config.yaml" }
```

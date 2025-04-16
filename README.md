# SyliusCMSBundle
CMS Page Bundle for Sylius

If you use recipes, make sure you have this in your composer.json

(https://api.github.com/repos/Aality/recipes/contents/index.json?ref=flex/main)

```json
    "extra": {
        "symfony": {
            "allow-contrib": true,
            "require": "^7.1",
            "endpoint": [
                "https://api.github.com/repos/Aality/recipes/contents/index.json?ref=flex/main",
                "https://api.github.com/repos/Sylius/SyliusRecipes/contents/index.json?ref=flex/main",
                "flex://defaults"
            ]
        }
    },
```

Otherwise, copy files from config dir in your app's config dir.

Clear cache and enjoy !

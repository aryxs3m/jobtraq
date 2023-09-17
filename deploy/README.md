# JobTraq Deploy

A használathoz telepítsd fel a composer csomagokat ebben a mappában:

```shell
composer install
```

Windowson a későbbiekben a `./dep` helyett közvetlenül a Deployer binárist kell
majd meghívni: `vendor/bin/dep`

A JobTraq szerverén fenn kell legyen az SSH kulcsod az élesítéshez.

### Deploy indítása

```shell
./dep deploy
```

A deployer megkérdezi, melyik környezetre szeretnél deployolni.

Indíthatsz közvetlenül is deployt a különböző környezetekre:

### Teszt deploy indítása

```shell
./dep deploy environment=test
```

### Éles deploy indítása

```shell
./dep deploy environment=prod
```

### Reparse

Meghívható a `jtq:reparse` CLI parancs a Deployerrel a következő módon:


```shell
./dep reparse environment=test # test esetén
./dep reparse environment=prod # prod esetén
```

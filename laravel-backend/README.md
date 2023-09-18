# JobTraq backend

A projekt Laravel 10 frameworkben készült.

## Funkciók

- admin felület
  - naplók és álláshirdetések megtekintése
  - kategorizálás beálításai (pozíciók, szintek, stackek, országok, városok/lokációk)
  - többfelhasználós
  - szerepkörök és jogosultságok
- scraping
- kimutatások készítése
- API a frontend (és más) számára

Minden fő business logika serviceként van megírva:

- scraperek,
- álláshirdetéseket címből kategorizáló service,
- riportokat összeállító servicek.

## Indítás local környezetben

Szükséged lesz a következőkre:
- legalább PHP 8.1
- MySQL vagy MariaDB

Indítás menete:

- `composer install`
- `npm i`
- `php artisan key:gen`
- `php artisan migrate --seed`
- `npm run dev`
- `php artisan jtq:scrape`

Ez után be tudsz jelentkezni a default admin fiókkal:

E-mail: **test@jobtraq.hu**<br>
Jelszó: **test-user-123**

Ill. így már futtathatod a teszteket is:

```php artisan test```

## Indítás Dockerből

A projektbe be lett állítva a [Sail](https://laravel.com/docs/10.x/sail), amivel nagyon jó integrált Docker alapú
fejlesztői környezetet tudsz indítani, szinte azonnal.

Legyen telepítve Docker, Docker Compose és Composer a gépedre (első indításhoz).

Első indításhoz telepítsd a composer csomagokat: `composer install`

Ez után a következő paranccsal indíthatod a Sailt: `./vendor/bin/sail up`

További parancsokért lásd a Sail dokumentációját.

## Éles telepítéshez

A fenti parancsok futtatása mellett

- kövesd a [Laravel deployment](https://laravel.com/docs/10.x/deployment) leírást,
- állítsd be a [schedulert](https://laravel.com/docs/10.x/scheduling#running-the-scheduler),
- állíts be a [queue workert](https://laravel.com/docs/10.x/queues#running-the-queue-worker),
- lehetőség szerint pedig használj Redist vagy hasonlót cache és queue drivernek.

[![PHPUnit](https://github.com/aryxs3m/jobtraq/actions/workflows/laravel.yml/badge.svg?branch=master)](https://github.com/aryxs3m/jobtraq/actions/workflows/laravel.yml) [![Cypress Tests](https://github.com/aryxs3m/jobtraq/actions/workflows/cypress.yml/badge.svg)](https://github.com/aryxs3m/jobtraq/actions/workflows/cypress.yml)

![JobTraq logo](angular-frontend/src/assets/logo_Light.svg)

A JobTraq naponta frissülő kimutatást készít az álláshirdetésekről, hogy megmutassa a különböző IT munkakörök iránti keresletet és fizetési sávokat.

Segítségével látható

- a különböző munkakörök közötti fizetési különbségek,
- különböző szintek szerinti fizetések (junior, senior, lead, stb.)
- stackek iránti kereslet
- és még sok minden más.

## TODOs

- ~~legyünk kedves botok: küldjük a scraperekben user-agenként a nevünket és az elérhetőséget~~
- ~~Backend: cs fixer bekötése~~
- ~~Backend: HealthcheckControllerhez a healthchecket végző service megírása~~
- ~~Backend: némi ráncfelvarrás ráférne~~
- ~~Backend: scraperekhez logolás, logokat lehessen adminfelületen megtekinteni~~
- ~~Backend: autentikáció~~
- ~~Backend: apidoc bekötése, annotációk készítése a controllerekbe~~
- ~~Frontend: impressum feltöltése~~
- ~~Frontend: contact feltöltése~~
- ~~Frontend: mobil menü toggle~~
- ~~Frontend: environmentek kezelése, API URL legyen állítható~~
- ~~Frontend: E2E tesztekhez id-k hozzáadása kattintható elemekhez~~
- ~~Frontend: cookie consent és Google Analytics bekötése~~
- ~~Frontend: reszponzivitásban problémák javítása (mobilon itt-ott overflow, rossz méretek)~~
- ~~Frontend: PWA~~
- ~~Frontend: SSR javítása, rosszabb esetben kikapcsolása~~
- ~~Frontend: tesztrendszer kizárása keresőmotorok indexeléséből~~
- ~~Design: browser ikonok ellenőrzése többféle böngészőben, platformon (szükséges lehet hátteret hozzáadni)~~
- ~~Frontend: hírek megjelenítése~~
- ~~Backend: CRUD törlés javítása (jelenleg GET-tel megy, nem túl biztonságos)~~
- ~~Backend: named route-ok használata, HTTPS problémák javítása~~
- ~~Backend: tesztrendszer kizárása keresőmotorok indexeléséből~~ - megoldva nginxből
- ~~Backend: hírek kezelése~~
- Backend: tesztek javítása
- Backend: media manager: képek feltöltése hírekhez
- Backend: tároljuk az álláshirdetések egyedi azonosítóit is
- Frontend: privacy-policy feltöltése

## Technikai

A frontend Angular, a backend pedig Laravel.

### Frontend

A frontend oldal néhány API kéréssel dolgozik csak, minden kimutatást a backend állít össze. Ezeket egyszerű
chartokkal jeleníti meg.

### Backend

A backend tartalmaz egy egyszerű admin felületet, ahol beállíthatóak a scraperek és a különböző keresési feltételek,
illetve minden olyan adat, amiből a kimutatások össze vannak állítva és az álláshirdetések be vannak kategorizálva.

Így az admin felületen be kell pl. állítani az ismert stackeket, pozíciókat, pozíció szinteket.

Minden fő business logika serviceként van megírva:

- scraperek,
- álláshirdetéseket címből kategorizáló service,
- riportokat összeállító servicek.

A backend rész tartalmaz teszteket is, amit az `artisan test` paranccsal tudsz futtatni.

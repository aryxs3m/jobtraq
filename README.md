![JobTraq logo](angular-frontend/src/assets/logo_Light.svg)

A JobTraq naponta frissülő kimutatást készít az álláshirdetésekről, hogy megmutassa a különböző IT munkakörök iránti keresletet és fizetési sávokat.

Segítségével látható

- a különböző munkakörök közötti fizetési különbségek,
- különböző szintek szerinti fizetések (junior, senior, lead, stb.)
- stackek iránti kereslet
- és még sok minden más.

## TODOs

- legyünk kedves botok: küldjük a scraperekben user-agenként a nevünket és az elérhetőséget

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

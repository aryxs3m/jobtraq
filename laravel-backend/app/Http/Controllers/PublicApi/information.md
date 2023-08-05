A JobTraq API-ja by-design teljesen publikus, így szabadon felhasználhatod a saját frontendedhez, alkalmazásodhoz adatforrásnak.

Kérlek, ha használod ezt az API-t

- használj olyan User-Agentet, ami egyértelműen azonosítja az alkalmazásodat, hogy lássuk, honnan jön az adatforgalom,
- ne tüntesd fel az adatokat sajátodként, ha lehet, említsd is meg a JobTraq-ot valahol,
- magas a rate limit küszöb, de ha nem muszáj, ne küldj sok kérést feleslegesen.

## Formátum

Az API egy nagyon egyszerű [JSend](https://github.com/omniti-labs/jsend) struktúrára épül, JSON válaszokat ad.

Minden válaszban küldünk egy `status` és egy `data` mezőt.

A `status` mező határozza meg a művelet sikerességét, míg a `data` mező a konkrét válasz JSON formában.

<table>
<tr><th>Érték</td><th>Magyarázat</th><th>Küldött mezők</th></tr>
<tr>
    <td>success</td>
    <td>Sikeresen lefutott a kérés, a data tartalmazza a várt adatokat.</td>
    <td>status, data</td>
</tr>
<tr>
    <td>fail</td>
    <td>A küldött adatok hibásak (validációs hiba). A data a validációs hibákat tartalmazza.</td>
    <td>status, data</td>
</tr>
<tr>
    <td>error</td>
    <td>Hiba történt, nem sikerült összeállítani a választ a kérésre. A message tartalmazza a hibaüzenetet szöveges formában.</td>
    <td>status, message</td>
</tr>
</table>

Validációs hibára példa:

```json
{
    "status": "fail",
    "data": {
        "message": "The date field must be a valid date."
    }
}
```

# Handmatige Testscenario's - TechnoShop

## TC-01: Filteren in de videobibliotheek

**User Story:**  
Als gebruiker wil ik de webshop kunnen filteren op categorieën.

### Hoofdscenario:
- **Stap 1:** Open de TechnoShop website.
- **Stap 2:** Navigeer naar de producten.
- **Stap 3:** Selecteer een van de getoonde categorieeen
- **Testdata:** Categorie: Tablets.
- **Gewenst resultaat:** Alleen tablets worden getoond.

### Alternatief scenario 1:
- **Stap:** Selecteer eerst Tablets, maar besluit daarna een andere categorie te bekijken, bijvoorbeeld Laptops.
- **Testdata:** Categorie: Laptops
- **Gewenst resultaat:** Alleen producten uit de categorie Laptops worden getoond.

### Alternatief scenario 2:
- **Stap:** Selecteer per ongeluk Smartphones terwijl je tablets wilde zien.
- **Testdata:** Categorie: Smartphones
- **Gewenst resultaat:** Alleen producten uit de categorie Smartphones worden getoond, niet de gewenste Tablets.

## TC-02: Registreren en inloggen

**User Story:**  
Als gebruiker wil ik mij kunnen registreren en inloggen.

### Hoofdscenario:
- **Stap 1:** Klik op 'Registreren'.
- **Stap 2:** Vul correcte gegevens in:  
  - Gebruikersnaam: `testuser`
  - Wachtwoord: `Test1234!`
  - Bevestig Wachtwoord: `Test1234!`

- **Stap 3:** Klik op inloggen en log in.
- **Testdata:** testuser@example.com / Test1234!
- **Gewenst resultaat:** Succesvol geregistreerd en ingelogd.

### Alternatief scenario 1:
- **Stap:** Registreren met een al bestaand gebruikersnaam.
- **Testdata:** jop123 (al bestaand)
- **Gewenst resultaat:** Foutmelding ("Gebruikersnaam is al in gebruik").

### Alternatief scenario 2:
- **Stap:** Inloggen met fout wachtwoord.
- **Testdata:** testuser@example.com / verkeerd wachtwoord
- **Gewenst resultaat:** Foutmelding ("Onjuist wachtwoord of gebruikersnaam").

## TC-03: Zoeken op producten

**User Story:**  
Als gebruiker wil ik kunnen zoeken naar producten

### Hoofdscenario:
- **Stap 1:** Open TechnoShop.
- **Stap 2:** Typ de gewenste naam van het product in de zoekbalk.
- **Stap 3:** Klik op Enter of het vergrootglas icoon
- **Testdata:** Zoekterm: Samsung
- **Gewenst resultaat:** Samsung producten worden getoond.

### Alternatief scenario 1:
- **Stap:** Typ een productnaam in de zoekbalk die niet bestaat, zoals "XYZ123", en druk op Enter.
- **Testdata:** Zoekterm: XYZ123
- **Gewenst resultaat:** Geen resultaten gevonden + duidelijke melding ("Geen producten gevonden").

### Alternatief scenario 2: F
- **Stap:** Typ een verkeerd gespelde productnaam, zoals "Sammsung", en druk op Enter.
- **Testdata:** Zoekterm: Sammsung
- **Gewenst resultaat:** Geen resultaten gevonden + duidelijke melding ("Geen producten gevonden").

## TC-04: Producten wijzigen

**User Story:**  
Als admin wil ik producten kunnen wijzigen (product details)

### Hoofdscenario:
- **Stap 1:** Open de Technoshop website.
- **Stap 2:** Log in als admin (User:admin Password:admin123)
- **Stap 3:** Navigeer naar de Admin Dashboard
- **Stap 4:** Selecteer 'Producten Beheren'
- **Stap 5:** Selecteer het gewenste product en klik op 'Wijzigen'
- **Stap 6:** Pas de velden van de informatie aan en submit
- **Testdata:** Apple iPad Mini (6th gen)
- **Gewenst resultaat:** Gebruikers kunnen de nieuwe data van het product correct weergeven.


### Alternatief scenario 1: 
- **Stap:** Selecteer een product en klik op 'Wijzigen', maar laat een verplicht veld zoals de productnaam leeg en submit.
- **Testdata:** Product: Apple iPad Mini (6th gen), Naam veld leeg
- **Gewenst resultaat:** Foutmelding verschijnt ("Vul alle verplichte velden in") + product wordt niet aangepast.

### Alternatief scenario 2: 
- **Stap:** Selecteer een product en klik op 'Wijzigen', pas de velden aan maar klik daarna op Annuleren in plaats van Submit.
- **Testdata:** Product: Apple iPad Mini (6th gen), bijvoorbeeld wijzig naam tijdelijk
- **Gewenst resultaat:** Wijzigingen worden niet opgeslagen + product blijft ongewijzigd.

## TC-05: Producten toevoegen

**User Story:**  
Als admin wil ik nieuwe producten kunnen toevoegen voor de gebruikers.

### Hoofdscenario:
- **Stap 1:** Open de Technoshop website.
- **Stap 2:** Log in als admin (User:admin Password:admin123)
- **Stap 3:** Navigeer naar de Admin Dashboard
- **Stap 4:** Selecteer 'Nieuw product toevoegen'
- **Testdata:** Tablets, Ipad 2026, 500$, https://cdn.mos.cms.futurecdn.net/E8cjr3zDAhpFX3jreE58kj.jpg, Best tech ipad.
- **Gewenst resultaat:** Product word succesvol toegevoegd bij de juiste categorie met de ingevulde informatie

### Alternatief scenario 1:
- **Stap:** Klik op 'Nieuw product toevoegen', maar laat een verplicht veld zoals de productnaam leeg en submit.
- **Testdata:** Categorie: Tablets, Naam leeg, Prijs: 500$, etc.
- **Gewenst resultaat:** Foutmelding verschijnt ("Vul alle verplichte velden in") + product wordt niet toegevoegd.

### Alternatief scenario 2:
- **Stap:** Vul een ongeldige image adress in bij image url
- **Testdata:** Image Url: youtube.com
- **Gewenst resultaat:** Foutmelding verschijnt ("Ongeldige Image Url") + product wordt niet toegevoegd.



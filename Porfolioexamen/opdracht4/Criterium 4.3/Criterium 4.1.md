# Testplan - TechnoShop (Handmatige Testen)

## Testcases voor User Stories

### TC-01 - Webshop Bibliotheek Filteren op Categorie

**User Story:**  
Als gebruiker wil ik de webshop kunnen filteren op categorieën.

**Doel:**  
Testen of filteren correct werkt op de categorie naar wens.

**Testscenario's:**
1. Open de TechnoShop website.
2. Ga naar de Producten
3. Selecteer een van de categorieën.
4. Controleer of alleen relevante resultaten getoond worden.

**Verwachte Resultaat:**  
Alleen producten die voldoen aan de filters worden correct getoond.

### TC-02 - Registreren en inloggen

**User Stories:**  
Als gebruiker wil ik mij kunnen registreren en inloggen. (2 aparte stories)

**Doel:**  
Testen van registratie- en loginfunctionaliteit.

**Testscenario's:**
1. Klik op 'Registreren'.
2. Vul correcte gegevens in (bijv. e-mail en wachtwoord) en registreer.
3. Log vervolgens in met de zojuist gemaakte account.
4. Test ook met foutieve inloggegevens (bijvoorbeeld een verkeerd wachtwoord).

**Verwachte Resultaat:**
- Bij correcte gegevens: succesvol ingelogd.
- Bij foutieve gegevens: duidelijke foutmelding ("Wachtwoord of e-mail klopt niet").

### TC-03 - Producten Toevoegen

**User Story:**  
Als admin wil ik producten kunnen toevoegen voor de gebruikers.

**Doel:**  
Testen of het toevoegen van producten werkt.

**Testscenario's:**
1. Open de Technoshop website.
2. Log in als admin (User:admin Password:admin123)
3. Navigeer naar de Admin Dashboard
4. Selecteer 'Voeg nieuw product toe'
5. Vul de velden in en submit.
6. Bekijken of het product ook daadwerkelijk verschijnt bij de categorie / producten lijst.

**Verwachte Resultaat:**  
Het product is succesvol toegevoegd bij de producten lijst en gebruikers kunnen het ook weergeven en aanschaffen.
# Lektionsmaterial tweet

Material för introduktionen till php och mysql.

## Första delen

Skapa struktur

    include/
        dbinfo_example.php
    views/
        css/
        js/
        img/
        index_layout.php
    index.php
    .gitignore
    torsdag.sql
    tweet.php

Om du klonar detta repo så behöver du börja med att döpa om dbinfo_example.php
till dbinfo.php och fylla i dina databasuppgifter.

Du behöver även importera databasen torsdag om du inte har den, se föregående lektion https://github.com/jensnti/wsp1-mysql

## Filerna och dess funktion

När vi besöker sidan(url, localhost/~username/mapp) så kommer vi att landa 
på index.php
**index.php** sidan fungerar så att den kontaktar vår databas, väljer alla tweets och visar den datan. Datan visas genom att vi inkluderar filen views/index_layout.php
Vi skickar databasresultatet i $result och loopar sedan igenom den för att visa varje tweet genom $row i index_layout.php

**tweet.php** fungerar i nuläget väldigt lika som index.php, vi har viss duplicerad kod för att hämta data från databasen.
Själva hanteringen av datan är inte skriven ännu av mig, nu dumpas bara resultatet.
Ert arbete är att skapa den html som skriver ut ett enskilt tweet.

## URL och GET

Vi kan skicka parametrar till en fil genom den URL vi använder med hjälp av GET.
GET skrivs i sidans URL och läses sedan in.
    
    tweet.php?id=3

tweet.php är filnamnet, vi lägger till GET parametrar med ? och sedan variabelnamn=värde
När sidan sedan laddas med php så finns variabelnamnet tillgängligt i superglobalen GET, $_GET['id'].
Kom ihåg att detta är väldigt osäkert om vi inte filtrerar datan.
Därför använder vi oss av filter_input och väljer ett filter för att sanera datan, se 
* https://www.php.net/manual/en/function.filter-input.php 
* https://www.php.net/manual/en/filter.filters.validate.php

För vårt id så vet vi att det alltid ska vara ett heltal, vi kan då validera det som en int och på så vis säkra det från tex. XSS attacker.
Koden ser ut som följande 

    $tweetId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

Vi sparar det filtrerade värdet i $tweetId. Testa gärna det här genom att köra
?id=23523 eller ?id=abcd eller liknande. Om du skriver ut det filtrerade värdet, vad händer då.

    echo $tweetId;

## Vidare arbete

När grunden är på plats med tweet och den data som hämtas från databasen så är ditt arbete att styla detta och visa den tweet som laddas.

* url ska vara tweet.php?id=12345
* tweet.php ska visa ett tweet, specifierat av id
* du bör kolla strukturen från index.php och index_layout.php, kan du göra samma struktur för att visa din tweet?
* Du får viss kodreproducering, dvs. vi har samma kod i både tweet och index filerna, hur skulle du kunna lösa det så vi inte gör det?
    * Samma lika med layout-filerna, hur kan vi kombinera detta?
* Skapa en sida för användarprofilen, koden är mer eller mindre samma som för tweet, men blir user istället.

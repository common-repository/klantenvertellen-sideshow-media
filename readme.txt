=== Klantenvertellen ===
Contributors: orpheussummanus
Donate link: paypal.me/ZBuurmans
Tags: klantenvertellen,widget,review,sideshowmedia,klanten,sideshow,media
Requires at least: 4.7.2
Tested up to: 4.7.3
Stable tag: 3.0.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Deze plugin wordt niet meer onderhouden.

== Description ==

DEZE PLUGIN WORDT NIET MEER ONDERHOUDEN.

Wie online gevonden wil worden, heeft o.a. reviews nodig!
De reviews (de gele sterretjes in de Google zoek resultaten) worden alleen getoond als je de code goed hebt staan op iedere pagina.

Wij van SideShow Media kregen deze vraag heel vaak van onze klanten met een wordpress site.

De klantenvertellen plugin die wij voor je hebben gemaakt is echt de enige plugin die na installatie zo werkt. Je hebt er geen kennis van programmeren voor nodig.
Het enige dat je nodig hebt is de login van je backend van de website.

De Klantenvertellen plugin is:

* Gratis
* Plug & Play te installeren
* Zeer gemakkelijk te bedienen
* Geen programmeren, Geen codes aanpassen
* Volledig in de kleur van je eigen site in te stellen

Stappenplan:

1. Installeer de plugin
2. In de plugin kies je je widget model (standaard, plat of review)
3. Je geeft het pad van de klantenvertellen xml op
4. Kies je gewenste kleuren
5. Optioneel kies je ruimtes tussen tekst en/of cijfers
6. Kopieer de gegenereerde shortcode (bv: [klantenvertellenSSM type="reviews" xml="mijn_site"] ) en plak deze waar je hem wilt tonen op je website.

Dat is het! Makkelijker kan niet.

De plugin is ook te gebruiken voor Patientenvertellen.

Voor een uigebreide omschrijving en werking van de plugin kunt u kijken op [SideShow Media](https://www.sideshowmedia.nl/klantenvertellen-plugin-voor-wordpress/).

== Installation ==

1. Upload de plugin bestanden naar de `/wp-content/plugins/sideshowmedia-klantenvertellen` folder, of installeer de plugin direct via het WordPress plugins scherm.
2. Activeer de plugin via het `Plugins` scherm in WordPress.
3. Gebruik het Klantenvertellen menu om de plugin te configureren.

== Frequently Asked Questions ==

= Ik heb een shortcode op mijn website gezet maar ik zie alleen de gemiddeldes? =
De reviews tonen standaard alleen de algemene gemiddeldes van Klantenvertellen.
Om reviews zelf te tonen kan je een limiet toevoegen, het veld `Reviews limiet` zal dit automatisch voor je toevoegen.
Om het handmatig te doen gebruik je `limit="#"` waar # alles kan zijn van `0` tot oneindig.
Let wel op, als je een getal hoger invoert dan dat er reviews bestaan kan dit problemen opleveren.

= De drop-downs worden niet ingeladen met gegevens! =
De drop-downs werken voor alle klantenvertellen links die beschikbaar zijn in de plugin.
Als je geen gegevens ziet ingeladen, controleer dan of je xml naam klopt en je deze ook al heb opgeslagen.
Je kan handmatig een filter toevoegen aan de shortcode door middel van `filter="Kolom,Waarde"` een voorbeeld hiervoor zou zijn `filter="Woonplaats,Amsterdam"`
Let echter wel op, de filters zijn hoofdletter gevoelig.

= Hoeveel filters kan ik per shortcode gebruiken? =

Elke shortcode accepteert maar 1 filter, de filter verwacht het eerste veld als kolom naam en het tweede veld als de waarde waaraan hij moet voldoen.
Dit eerste veld is automatisch gegenereerd als u de shortcode generator gebruikt, het tweede veld is handmatig en hoofdletter gevoelig.

= Hoeveel shortcodes kan ik per pagina gebruiken? =

U kunt zoveel shortcodes op uw pagina zetten als u denkt nodig te hebben.

= De layout van de reviews/widget past niet binnen mijn site, wat nu? =

In het bestand `admin/class-menu-page` vind u een case voor `widget`, `flat` en `review` deze beginnen met de CSS, hier kunt u alles aanpassen wat u wilt.
Let wel op dat deze aanpassingen zullen worden overschreven bij een update. Als u ze dus wilt behouden raden wij u aan om deze te zetten in een apart CSS bestand en deze extern in te laden op de pagina waar u de shortcode heeft staan.

== Screenshots ==
1. [3.0] Klantenvertellen settings pagina
2. [3.0] Previews pagina
3. [Pre-3.0] Widget - Standaard settings pagina
4. [Pre-3.0] Widget - Flat settings pagina
5. [Pre-3.0] Reviews setting pagina

== Changelog ==

= 3.0.4 =
* Datum bug gefixed voor mobiliteit klantenvertellen urls.

= 3.0.3 =
* Google Cloud toegevoegd aan afbeeldingen directories.

= 3.0.2 =
* Afbeeldingen directory aangepast voor bepaalde webservers.
* Sterren aangepast voor verschillende browsers.

= 3.0.0 =
* Pati&euml;ntenvertellen is verwijderd, deze zal opnieuw worden toegevoegd indien er vraag naar is
* Filters werken voor alle Klantenvertellen varianten in plaats van alleen de standaard Klantenvertellen URL
* Alles wordt geregeld door één functie in plaats van een functie per url variant
* Autocomplete is uitgezet vanwege cross-browser problemen met het opvangen van het gebruik van de autocomplete functie
* Shortcode generator werkt weer, de generator controleert in volgorde van de URLs waarbij de eerste optie de hoogste prioriteit heeft. Dit betekent dat er dus maar 1 versie per keer ingevuld moet zijn.
* Previews pagina laad dynamisch een Widget, Flat Widget en Review in als er een XML is ingeladen
* Key field en Review filter worden dynamisch geladen voor alle url versies van Klantenvertellen
* Widgets hebben een extra textarea voor een link waar de gebruiker naar toe gaat als ze op de widget klikken
* Alle settings zijn opnieuw aangemaakt
* Sub menu systeem vervangen voor tabbladden op een centrale pagina
* De gehele plugin is van de grond af aan opnieuw opgebouwd

= 2.1.3 =
* CSS aangepast, met name voor mobiele versies (max-width 800 pixels - Getest op Lumia 950, Galaxy S5 en Galaxy S7)
* Layout van de reviews lichtelijk aangepast
* Aangepast hoe we de directory lezen voor de afbeeldingen, behoort nu goed te werken voor http en https websites

= 2.1.2 =
* Cijfers worden nu goed getoond bij mobiliteit versies van Klantenvertellen

= 2.1.1 =
* Shortcode generator update nu ook voor mobiliteit versies

= 2.1 =
* Een derde klantenvertellen URL versie toegevoegd - op basis van contact met Klantenvertellen is dit de laatste mogelijk versie van een link, we behoren nu dus alle versies op te vangen!
* Textarea toegevoegd voor een link die om de widget en flat-widget wordt gehangen als er gebruik gemaakt wordt van een TenantID en een LocationID

= 2.0 =
* flat-widget en reviews aangepast voor deze alternatieve urls
* Widget aangepast ter reflectie voor deze alternatieve urls
* Support toegevoegd voor alternatieve klantenvertellen urls

== Upgrade Notice ==

= 3.0.3 =
Extra server types toegevoegd aan de afbeeldingen, werken nu voor HTTP, HTTPS, IIS en Google Cloud.
Indien een andere server nodig is graag contact opnemen, dan wordt deze zo spoedig mogelijk toegevoegd.

= 3.0.1 =
Aanpassingen in het aanwijzen van afbeeldingen, als deze eerst niet werkten is er een verhoogde kans dat ze het nu wel doen!

= 3.0 =
We raden sterk aan om eerst al uw instellingen te noteren in een apart bestand!
In deze versie is de gehele plugin opnieuw gebouwd, let op, ingestelde settings kunnen verloren gaan bij het updaten. Tevens kunnen shortcodes breken na de update.
Maak gebruik van de nieuwe settings pagina en shortcode generator om alles weer in orde te krijgen.

= 2.1.3 =
Afbeeldingen behoren nu te werken voor HTTP en HTTPS websites, CSS styling licht aangepast, mobiele versie behoort nu goed getoond te worden.

= 2.1.2 =
Cijfers worden nu getoond bij reviews voor mobiliteit klantenvertellen versies.

= 2.1.1 =
Bug Fix: Shortcode generator update nu ook voor mobiliteit klantenvertellen links.

= 2.1 =
Support toegevoegd voor Mobiliteit Klantenvertellen. Veld toegevoegd voor (flat) widgets waarin je zelf de target URL kan bepalen.
We raden aan om als target link de reviews op de website van Klantenvertellen te gebruiken.

= 2.0 =
Support toegevoegd voor alle versies van klantenvertellen, als de plugin eerst niet werkte dan werkt hij nu wel.
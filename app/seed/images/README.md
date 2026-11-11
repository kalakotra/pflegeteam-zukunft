# Bilder für den Seed (`app/seed/images`)

Der Seed-Task importiert Bilder aus diesem Ordner (Dateiname = Schlüssel). Fehlende Dateien werden beim Lauf aufgelistet;
nach dem Ablegen `vendor/bin/sake tasks:seed-site --reset-blocks` ausführen (baut die Blöcke neu auf).

**Keine Bilder von Referenz-Websites oder der alten Seite hotlinken.** Echte Fotos des Teams sind immer besser als generierte –
Porträts (`team-*.jpg`) und `karriere-ansprechperson.jpg` bitte nur als echte Fotos mit Einverständnis der Personen.

## Liste

| Datei | Motiv / Alt-Text | Format |
|---|---|---|
| `leistung-grundpflege.jpg` | Pflegerin hilft einer älteren Dame beim Anziehen einer Strickjacke | 1200 × 900 |
| `leistung-behandlungspflege.jpg` | Pflegefachkraft misst bei einem älteren Herrn zu Hause den Blutzucker | 1200 × 900 |
| `leistung-entlastung.jpg` | Betreuungskraft begleitet eine Seniorin beim Einkauf auf dem Wochenmarkt | 1200 × 900 |
| `leistung-verhinderungspflege.jpg` | Pflegekraft und Tochter eines Pflegebedürftigen besprechen die Vertretung | 1200 × 900 |
| `leistung-pflegeberatung.jpg` | Pflegeberaterin spricht mit einem älteren Ehepaar am Wohnzimmertisch | 1200 × 900 |
| `startseite-hero.jpg` | Ältere Frau lacht mit ihrer Pflegerin auf dem Balkon einer Hamburger Altbauwohnung | 2400 × 1000 (Querformat, Motiv rechts – links unten liegt das Textfeld) |
| `startseite-sprache.jpg` | Pflegekraft und älterer Herr im Gespräch am Küchentisch | 1200 × 1100 |
| `karriere-team.jpg` | Zwei Pflegekräfte lachen auf dem Weg zum nächsten Einsatz | 1200 × 1100 |
| `leistungen-hero.jpg` | Pflegekraft und Seniorin lachen gemeinsam auf dem Sofa | 1200 × 900 |
| `grundpflege-hero.jpg` | Pflegerin hilft einer älteren Dame beim Aufstehen aus dem Sessel | 1200 × 900 |
| `behandlungspflege-hero.jpg` | Pflegefachkraft wechselt einen Verband am Unterschenkel eines Seniors im Wohnzimmer | 1200 × 900 |
| `entlastung-hero.jpg` | Betreuungskraft und Seniorin spielen gemeinsam ein Brettspiel am Tisch | 1200 × 900 |
| `verhinderungspflege-hero.jpg` | Tochter verabschiedet sich mit Koffer, Pflegekraft sitzt bei der Mutter | 1200 × 900 |
| `pflegeberatung-hero.jpg` | Pflegeberaterin erklärt einem älteren Ehepaar Unterlagen am Wohnzimmertisch | 1200 × 900 |
| `ueber-uns-hero.jpg` | Das Team des Pflegeteams Zukunft vor dem Büro an der Bürgerweide | 1200 × 900 |
| `team-edin-suljic.jpg` | Porträt von Edin Suljic, Inhaber und Pflegedienstleitung | 800 × 960 (5:6), Porträt |
| `team-meike-gajda-stier.jpg` | Porträt von Meike Gajda-Stier, stellvertretende Pflegedienstleitung | 800 × 960 (5:6), Porträt |
| `team-birgit-hoffmann.jpg` | Porträt von Birgit Hoffmann, Pflegeberaterin | 800 × 960 (5:6), Porträt |
| `karriere-hero.jpg` | Pflegefachkraft mit Tablet auf dem Weg zum Einsatz in einer Hamburger Straße | 2400 × 1000 (Querformat, Motiv rechts – links unten liegt das Textfeld) |
| `karriere-ansprechperson.jpg` | Ansprechperson für Bewerbungen im Büro des Pflegeteams Zukunft | 1200 × 1100 |

## Prompt-Vorlage für generierte Fotos (alle außer Porträts/Karte)

> Authentic documentary photo, natural daylight, in a bright Hamburg apartment (Altbau, wooden floor, plants).
> {Motiv aus der Tabelle}. Caregiver wears plain light clothing with a petrol-blue accent (#007FA3), no logos. Warm, respectful,
> relaxed mood, real people of different origins, older person 70–85 years, no hospital look, no text, no watermark,
> 35 mm lens, soft natural light, lots of calm negative space, muted colours (white, light grey, petrol).

Danach: auf das Format zuschneiden, als JPG (Qualität ~80) speichern, max. 400 KB.

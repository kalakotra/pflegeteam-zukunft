# Bilder für den Seed (`app/seed/images`)

Der Seed-Task importiert Bilder aus diesem Ordner (Dateiname = Schlüssel). Fehlende Dateien werden beim Lauf aufgelistet;
nach dem Ablegen `vendor/bin/sake tasks:seed-site --reset-blocks` ausführen (baut die Blöcke neu auf).

**Keine Bilder von Referenz-Websites oder der alten Seite hotlinken.** Echte Fotos des Teams sind immer besser als generierte –
Porträts (`team-*.jpg`) und `karriere-ansprechperson.jpg` bitte nur als echte Fotos mit Einverständnis der Personen.

## Liste

| Datei | Motiv / Alt-Text | Format |
|---|---|---|
| `leistung-grundpflege.jpg` | Pflegerin hilft einer älteren Dame beim Anziehen einer Strickjacke | 1200 × 750 (16:10) |
| `leistung-behandlungspflege.jpg` | Pflegefachkraft misst bei einem älteren Herrn zu Hause den Blutzucker | 1200 × 750 (16:10) |
| `leistung-entlastung.jpg` | Betreuungskraft begleitet eine Seniorin beim Einkauf auf dem Wochenmarkt | 1200 × 750 (16:10) |
| `leistung-verhinderungspflege.jpg` | Pflegekraft und Tochter eines Pflegebedürftigen besprechen die Vertretung | 1200 × 750 (16:10) |
| `leistung-pflegeberatung.jpg` | Pflegeberaterin spricht mit einem älteren Ehepaar am Wohnzimmertisch | 1200 × 750 (16:10) |
| `startseite-hero.jpg` | Pflegerin lacht mit einem älteren Herrn am Küchentisch in seiner Hamburger Wohnung | 1600 × 1200 (4:3), Motiv mittig |
| `leistung-alltag.jpg` | Pflegekraft und Senior füllen gemeinsam einen Antrag aus | 1200 × 750 (16:10) |
| `karriere-team.jpg` | Zwei Pflegekräfte im Gespräch vor dem Dienstwagen, beide lachen | 1600 × 1200 (4:3), Motiv mittig |
| `einsatzgebiet-karte.png` | Karte des Einsatzgebiets im Hamburger Osten rund um die Bürgerweide | 1200 × 800, schematische Karte |
| `leistungen-hero.jpg` | Pflegekraft und Seniorin lachen gemeinsam auf dem Sofa | 1600 × 1200 (4:3), Motiv mittig |
| `grundpflege-hero.jpg` | Pflegerin hilft einer älteren Dame beim Aufstehen aus dem Sessel | 1600 × 1200 (4:3), Motiv mittig |
| `behandlungspflege-hero.jpg` | Pflegefachkraft wechselt einen Verband am Unterschenkel eines Seniors im Wohnzimmer | 1600 × 1200 (4:3), Motiv mittig |
| `entlastung-hero.jpg` | Betreuungskraft und Seniorin spielen gemeinsam ein Brettspiel am Tisch | 1600 × 1200 (4:3), Motiv mittig |
| `verhinderungspflege-hero.jpg` | Tochter verabschiedet sich mit Koffer, Pflegekraft sitzt bei der Mutter | 1600 × 1200 (4:3), Motiv mittig |
| `pflegeberatung-hero.jpg` | Pflegeberaterin erklärt einem älteren Ehepaar Unterlagen am Wohnzimmertisch | 1600 × 1200 (4:3), Motiv mittig |
| `ueber-uns-hero.jpg` | Das Team des Pflegeteams Zukunft vor dem Büro an der Bürgerweide | 1600 × 1200 (4:3), Motiv mittig |
| `team-edin-suljic.jpg` | Porträt von Edin Suljic, Inhaber und Pflegedienstleitung | 800 × 800 (1:1), Porträt |
| `team-meike-gajda-stier.jpg` | Porträt von Meike Gajda-Stier, stellvertretende Pflegedienstleitung | 800 × 800 (1:1), Porträt |
| `team-birgit-hoffmann.jpg` | Porträt von Birgit Hoffmann, Pflegeberaterin | 800 × 800 (1:1), Porträt |
| `karriere-hero.jpg` | Pflegefachkraft mit Tablet steigt in Hamburg aus dem Dienstwagen | 1600 × 1200 (4:3), Motiv mittig |
| `karriere-ansprechperson.jpg` | Ansprechperson für Bewerbungen im Büro des Pflegeteams Zukunft | 1600 × 1200 (4:3), Motiv mittig |

## Prompt-Vorlage für generierte Fotos (alle außer Porträts/Karte)

> Authentic documentary photo, natural daylight, in a bright Hamburg apartment (Altbau, wooden floor, plants).
> {Motiv aus der Tabelle}. Caregiver wears a plain petrol-blue tunic (#007FA3) without logos. Warm, respectful,
> relaxed mood, real people of different origins, older person 70–85 years, no hospital look, no text, no watermark,
> 35 mm lens, shallow depth of field, color palette white / petrol / soft red accents.

Danach: auf das Format zuschneiden, als JPG (Qualität ~80) speichern, max. 400 KB.

## Einsatzgebiet-Karte
`einsatzgebiet-karte.png`: schematische Karte (keine Google-Kachel) mit den Stadtteilen Hamm, Borgfelde, St. Georg,
Hohenfelde, Eilbek, Horn, Wandsbek, Barmbek – Gebiet vom Kunden bestätigen lassen. Kartengrundlage z. B. OpenStreetMap (ODbL, Quelle nennen).

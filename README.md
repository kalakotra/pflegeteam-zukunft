# pflegeteam-zukunft.de

Relaunch der Website der **Pflegeteam Zukunft GmbH** (ambulanter Pflegedienst, Hamburg) auf SilverStripe 6.3
mit Elemental, Bootstrap 5.3 und Vite. Eine Sprache (de_DE), kein Fluent.

**Versionen:** `1.0.0` = erstes Design (Karten, dunkle Bänder). `2.0.0` = ruhiges „clean“-Design: eine Schrift (Figtree),
Weiß + helles Grau, Listen mit Haarlinien statt Karten, Vollbild-Hero mit Textfeld, Kontaktstreifen über dem Footer.

- Theme: `themes/ptzukunft` (Templates + Bilder)
- Frontend-Quellen: `app/client/src` → Build nach `app/client/dist`
- Inhaltsblöcke: [`youwilllikeit/silverstripe-elements`](https://github.com/you-will-like-it/silverstripe-elements) 2.x
  + Projekt-Extensions in `app/src/Extensions/Elements`
- Strukturierte Daten: `dorsetdigital/silverstripe-schema-manager` (Organization, MedicalBusiness, WebSite,
  WebPage, BreadcrumbList, Service, JobPosting, FAQPage, Person)
- Logo-Generator (Outfit als Pfade): `tools/logo/build.py`

## Installation

```bash
composer install
composer vendor-expose
composer build-assets            # npm ci && npm run build
cp .env.example .env             # DB, Admin, MAILER_DSN anpassen
vendor/bin/sake db:build --flush
vendor/bin/sake tasks:seed-site  # Einstellungen, Seiten, Blöcke, Formulare, Weiterleitungen
```

Bilder: in `app/seed/images` ablegen (Liste + Prompts: `app/seed/images/README.md`), dann
`vendor/bin/sake tasks:seed-site --reset-blocks`.

Entwicklung mit Hot Reload: `npm run dev` (Vite auf :5173, DDEV-Origin wird automatisch gesetzt).

## Seitentypen

| Typ | Zweck |
|---|---|
| `HomePage` | Startseite, nur Blöcke |
| `ServiceHolderPage` / `ServicePage` | Leistungen; Unterseiten mit Seitenleiste + unterem Blockbereich |
| `CareerPage` / `JobPage` | Karriere mit Bewerbungsbereich (`#bewerben`) und Stellen als Unterseiten (Google for Jobs) |
| `ContactPage` | Kontaktdaten aus den Einstellungen + Formular-Block |
| `Page` | Über uns, Impressum, Datenschutz |

Kontaktdaten, Bürozeiten, Job-Hinweis („Wir stellen ein“) und Schema-Typ pflegt man unter **Einstellungen**.

## Go-live-Checkliste

- [ ] Admin-Passwort und `.env` (Produktion: `SS_ENVIRONMENT_TYPE="live"`, `SS_BASE_URL`, `MAILER_DSN`, Absender mit SPF)
- [ ] Echte Fotos / generierte Bilder einspielen (`app/seed/images`), Porträts nur mit Einverständnis
- [ ] **Datenschutzerklärung** einfügen und veröffentlichen (liegt als Entwurf an; Formulare inkl. Datei-Upload)
- [ ] Impressum prüfen lassen
- [ ] Offene Punkte vom Kunden: Einsatzgebiet, Stelle Pflegeassistenz, Gehalt/Benefits, Freigabe der Google-Zitate,
      §-Formulierungen (Beratungsbesuch § 37 Abs. 3), Bürozeiten Mo–Fr
- [ ] Ordner `Bewerbungen` (Assets): nur Administratoren dürfen sehen – nach dem Seed kontrollieren
- [ ] Testmail beider Formulare (Kontakt, Kurzbewerbung)
- [ ] Weiterleitungen testen: `/web/`, `/team/`, `/stellenangebote/`, `/pflegeberatung/`
- [ ] Search Console: `https://www.pflegeteam-zukunft.de/sitemap.xml` einreichen; Google for Jobs im Rich-Results-Test prüfen
- [ ] Lighthouse + axe auf Staging (Preview-Werte 2.0.0: Mobil 100/100/100/100, axe 0 Verstöße)
- [ ] Hero-Fotos Startseite/Karriere im Querformat, Motiv rechts (links unten liegt das Textfeld)

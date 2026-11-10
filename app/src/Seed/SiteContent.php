<?php

declare(strict_types=1);

namespace App\Seed;

use App\Elements\ElementJobList;
use App\Pages\CareerPage;
use App\Pages\ContactPage;
use App\Pages\HomePage;
use App\Pages\JobPage;
use App\Pages\ServiceHolderPage;
use App\Pages\ServicePage;
use DNADesign\ElementalUserForms\Model\ElementForm;
use Page;
use SilverStripe\UserForms\Model\EditableFormField\EditableCheckbox;
use SilverStripe\UserForms\Model\EditableFormField\EditableDropdown;
use SilverStripe\UserForms\Model\EditableFormField\EditableEmailField;
use SilverStripe\UserForms\Model\EditableFormField\EditableFileField;
use SilverStripe\UserForms\Model\EditableFormField\EditableRadioField;
use SilverStripe\UserForms\Model\EditableFormField\EditableTextField;
use YouWillLikeIT\Elements\Elements\ElementCallToAction;
use YouWillLikeIT\Elements\Elements\ElementFaq;
use YouWillLikeIT\Elements\Elements\ElementFeatureGrid;
use YouWillLikeIT\Elements\Elements\ElementHero;
use YouWillLikeIT\Elements\Elements\ElementTeam;
use YouWillLikeIT\Elements\Elements\ElementTestimonials;
use YouWillLikeIT\Elements\Elements\ElementTextMedia;

/**
 * Seed content for pflegeteam-zukunft.de (de_DE).
 * Sources: client test site (pz.hole-in-one.reisen), MD transparency report 04.09.2025, CONTENT.md.
 * Corrections and keyword map: claude/sites/ptzukunft/brief.md (Project "Webdesign").
 * Patients and relatives are addressed with "Sie", job seekers with "du".
 */
final class SiteContent
{
    public const PHONE = '040 668721-70';

    public const PHONE_E164 = '+494066872170';

    /**
     * @return array<string, mixed>
     */
    public static function siteConfig(): array
    {
        return [
            'fields' => [
                'Title' => 'Pflegeteam Zukunft',
                'Tagline' => 'Ambulanter Pflegedienst in Hamburg',
                'OwnerName' => 'Edin Suljic',
                'Street' => 'Bürgerweide 21',
                'PostalCode' => '20535',
                'City' => 'Hamburg',
                'Region' => 'Hamburg',
                'CountryCode' => 'DE',
                'Phone' => self::PHONE,
                'Fax' => '040 668721-69',
                'Email' => 'info@pflegeteam-zukunft.de',
                'Latitude' => 53.556899,
                'Longitude' => 10.028884,
                'RouteURL' => 'https://www.google.com/maps/dir/?api=1&destination=Pflegeteam+Zukunft+GmbH%2C+B%C3%BCrgerweide+21%2C+20535+Hamburg',
                'MapEmbedURL' => '',
                'FooterText' => 'Ambulanter Pflegedienst in Hamburg – Vertragspartner aller Kranken- und Pflegekassen. Wir sprechen Deutsch, Bosnisch, Kroatisch, Serbisch, Russisch und mehr.',
                'HiringBadge' => 'Wir stellen ein',
                'HiringText' => 'Pflegefachkräfte & Pflegeassistenz (m/w/d)',
                'BusinessType' => 'MedicalBusiness',
            ],
            'schema' => [
                'SchemaOrganisationName' => 'Pflegeteam Zukunft',
                'SchemaOrganisationLegalName' => 'Pflegeteam Zukunft GmbH',
                'SchemaOrganisationPhone' => self::PHONE_E164,
                'SchemaOrganisationEmail' => 'info@pflegeteam-zukunft.de',
                'SchemaOrganisationStreetAddress' => 'Bürgerweide 21',
                'SchemaOrganisationPostalCode' => '20535',
                'SchemaOrganisationLocality' => 'Hamburg',
                'SchemaOrganisationRegion' => 'Hamburg',
                'SchemaOrganisationCountry' => 'DE',
            ],
            'openingHours' => [
                ['Label' => 'Mo–Fr', 'Days' => 'Monday,Tuesday,Wednesday,Thursday,Friday', 'Opens' => '08:00:00', 'Closes' => '16:00:00', 'Closed' => false],
            ],
        ];
    }

    /**
     * Page tree. Order = menu order. Keys are referenced by links, blocks and redirects.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function pages(): array
    {
        return [
            'home' => [
                'sort' => 1,
                'class' => HomePage::class,
                'segment' => 'home',
                'fields' => [
                    'Title' => 'Startseite',
                    'MenuTitle' => 'Startseite',
                    'ShowInMenus' => false,
                    'MetaTitle' => 'Ambulanter Pflegedienst Hamburg – Pflegeteam Zukunft',
                    'MetaDescription' => 'Ambulanter Pflegedienst in Hamburg: Grundpflege, Behandlungspflege und Entlastung zu Hause. MD-Note 1,5, alle Kassen, ein Team mit 8 Sprachen.',
                ],
            ],
            'leistungen' => [
                'sort' => 2,
                'class' => ServiceHolderPage::class,
                'segment' => 'leistungen',
                'fields' => [
                    'Title' => 'Leistungen',
                    'MetaTitle' => 'Leistungen ambulante Pflege Hamburg – Pflegeteam Zukunft',
                    'MetaDescription' => 'Leistungen der ambulanten Pflege in Hamburg: Grundpflege, Behandlungspflege, Entlastung, Verhinderungspflege und Beratung – abgerechnet mit Ihrer Kasse.',
                ],
            ],
            'grundpflege' => [
                'sort' => 1,
                'parent' => 'leistungen',
                'class' => ServicePage::class,
                'segment' => 'grundpflege',
                'teaserImage' => ['leistung-grundpflege.jpg', 'Pflegerin hilft einer älteren Dame beim Anziehen einer Strickjacke'],
                'fields' => [
                    'Title' => 'Grundpflege',
                    'ServiceType' => 'Grundpflege (körperbezogene Pflegemaßnahmen)',
                    'Teaser' => 'Körperpflege, Anziehen, Mobilität und Mahlzeiten – mit Ruhe und Respekt.',
                    'MetaTitle' => 'Grundpflege zu Hause in Hamburg – Pflegeteam Zukunft',
                    'MetaDescription' => 'Grundpflege zu Hause in Hamburg: Hilfe bei Körperpflege, Anziehen, Mobilität und Essen. Abrechnung über die Pflegekasse – wir beraten Sie kostenlos.',
                ],
            ],
            'behandlungspflege' => [
                'sort' => 2,
                'parent' => 'leistungen',
                'class' => ServicePage::class,
                'segment' => 'behandlungspflege',
                'teaserImage' => ['leistung-behandlungspflege.jpg', 'Pflegefachkraft misst bei einem älteren Herrn zu Hause den Blutzucker'],
                'fields' => [
                    'Title' => 'Behandlungspflege',
                    'ServiceType' => 'Häusliche Krankenpflege (Behandlungspflege nach SGB V)',
                    'Teaser' => 'Medikamente, Verbandswechsel, Injektionen und Kompression – nach ärztlicher Verordnung.',
                    'MetaTitle' => 'Behandlungspflege Hamburg – ärztlich verordnet zu Hause',
                    'MetaDescription' => 'Behandlungspflege in Hamburg: Medikamentengabe, Verbandswechsel, Insulin und Kompressionsstrümpfe nach ärztlicher Verordnung – die Krankenkasse zahlt.',
                ],
            ],
            'betreuung-entlastung' => [
                'sort' => 3,
                'parent' => 'leistungen',
                'class' => ServicePage::class,
                'segment' => 'betreuung-entlastung',
                'teaserImage' => ['leistung-entlastung.jpg', 'Betreuungskraft begleitet eine Seniorin beim Einkauf auf dem Wochenmarkt'],
                'fields' => [
                    'Title' => 'Betreuung & Entlastung',
                    'MenuTitle' => 'Betreuung & Entlastung',
                    'ServiceType' => 'Betreuung und Entlastung im Alltag (§ 45b SGB XI)',
                    'Teaser' => 'Haushalt, Einkäufe, Arztbegleitung – finanziert über den Entlastungsbetrag.',
                    'MetaTitle' => 'Entlastungsbetrag Pflegedienst Hamburg – Pflegeteam Zukunft',
                    'MetaDescription' => 'Betreuung und Entlastung im Alltag in Hamburg: Haushalt, Einkauf, Begleitung zum Arzt – bezahlt über den Entlastungsbetrag nach § 45b SGB XI.',
                ],
            ],
            'verhinderungspflege' => [
                'sort' => 4,
                'parent' => 'leistungen',
                'class' => ServicePage::class,
                'segment' => 'verhinderungspflege',
                'teaserImage' => ['leistung-verhinderungspflege.jpg', 'Pflegekraft und Tochter eines Pflegebedürftigen besprechen die Vertretung'],
                'fields' => [
                    'Title' => 'Verhinderungspflege',
                    'ServiceType' => 'Verhinderungspflege (§ 39 SGB XI)',
                    'Teaser' => 'Pflegende Angehörige brauchen Pausen – wir übernehmen, ohne Lücke.',
                    'MetaTitle' => 'Verhinderungspflege Hamburg – Pflegeteam Zukunft',
                    'MetaDescription' => 'Verhinderungspflege in Hamburg: Wenn pflegende Angehörige Urlaub machen oder krank sind, übernehmen wir die Pflege zu Hause – über die Pflegekasse.',
                ],
            ],
            'pflegeberatung' => [
                'sort' => 5,
                'parent' => 'leistungen',
                'class' => ServicePage::class,
                'segment' => 'pflegeberatung',
                'teaserImage' => ['leistung-pflegeberatung.jpg', 'Pflegeberaterin spricht mit einem älteren Ehepaar am Wohnzimmertisch'],
                'fields' => [
                    'Title' => 'Pflegeberatung',
                    'ServiceType' => 'Beratungsbesuch nach § 37 Abs. 3 SGB XI',
                    'Teaser' => 'Beratungsbesuche nach § 37 Abs. 3 und kostenlose Erstberatung zu Pflegegrad und Kasse.',
                    'MetaTitle' => 'Beratungsbesuch § 37.3 Hamburg – Pflegeteam Zukunft',
                    'MetaDescription' => 'Pflegeberatung in Hamburg: Beratungsbesuch nach § 37 Abs. 3 SGB XI für Pflegegeld-Bezieher und kostenlose Erstberatung zu Pflegegrad und Leistungen.',
                ],
            ],
            'ueber-uns' => [
                'sort' => 3,
                'class' => Page::class,
                'segment' => 'ueber-uns',
                'fields' => [
                    'Title' => 'Über uns',
                    'MetaTitle' => 'Über uns – Pflegeteam Zukunft, Pflegedienst in Hamburg',
                    'MetaDescription' => 'Lernen Sie das Pflegeteam Zukunft kennen: examinierte Pflegefachkräfte aus vielen Ländern, acht Sprachen im Team und eine MD-Prüfung mit Note 1,5.',
                ],
            ],
            'karriere' => [
                'sort' => 4,
                'class' => CareerPage::class,
                'segment' => 'karriere',
                'image' => ['ContactImage', 'karriere-ansprechperson.jpg', 'Ansprechperson für Bewerbungen im Büro des Pflegeteams Zukunft'],
                'fields' => [
                    'Title' => 'Karriere',
                    'MetaTitle' => 'Pflegedienst Jobs Hamburg – Karriere beim Pflegeteam Zukunft',
                    'MetaDescription' => 'Jobs im ambulanten Pflegedienst in Hamburg: Pflegefachkraft und Pflegeassistenz (m/w/d) in Voll- oder Teilzeit. Jetzt in 2 Minuten bewerben.',
                    'ApplyAsideTitle' => 'Lieber direkt sprechen?',
                    'ApplyAsideText' => 'Ruf uns an – wir vereinbaren ein persönliches Kennenlernen in unserem Büro an der Bürgerweide.',
                    'ApplySteps' => "Formular senden oder anrufen\nPersönliches Kennenlernen\nStart mit Einarbeitung",
                    'ContactImageAlt' => 'Ansprechperson für Bewerbungen im Büro des Pflegeteams Zukunft',
                ],
            ],
            'job-pflegefachkraft' => [
                'sort' => 1,
                'parent' => 'karriere',
                'class' => JobPage::class,
                'segment' => 'pflegefachkraft',
                'fields' => [
                    'Title' => 'Pflegefachkraft (m/w/d) in der ambulanten Pflege',
                    'MenuTitle' => 'Pflegefachkraft (m/w/d)',
                    'Teaser' => 'Examiniert, mit Herz und Lust auf eigenständiges Arbeiten in Hamburg – Berufseinsteiger:innen willkommen.',
                    'EmploymentTypes' => 'FULL_TIME,PART_TIME',
                    'Location' => 'Hamburg-Hamm',
                    'StartLabel' => 'ab sofort',
                    'Qualification' => 'Altenpflege, GuK oder Pflegefachfrau/-mann',
                    'MetaTitle' => 'Pflegefachkraft ambulant Hamburg (m/w/d) – Job',
                    'MetaDescription' => 'Job als Pflegefachkraft (m/w/d) im ambulanten Pflegedienst in Hamburg: Voll- oder Teilzeit, fester Ansprechpartner, Fortbildungen. Jetzt bewerben.',
                    'JobDescription' => self::jobFachkraft(),
                ],
            ],
            'job-pflegeassistenz' => [
                'sort' => 2,
                'parent' => 'karriere',
                'class' => JobPage::class,
                'segment' => 'pflegeassistenz',
                'fields' => [
                    'Title' => 'Pflegeassistenz / Pflegehelfer (m/w/d)',
                    'MenuTitle' => 'Pflegeassistenz (m/w/d)',
                    'Teaser' => 'Du unterstützt unsere Fachkräfte in der Grundpflege und im Alltag unserer Kund:innen.',
                    'EmploymentTypes' => 'FULL_TIME,PART_TIME,PER_DIEM',
                    'Location' => 'Hamburg-Hamm',
                    'StartLabel' => 'ab sofort',
                    'Qualification' => 'Pflegeassistenz, Pflegehilfe oder Quereinstieg',
                    'MetaTitle' => 'Pflegeassistenz Job Hamburg (m/w/d) – Pflegeteam Zukunft',
                    'MetaDescription' => 'Job als Pflegeassistenz oder Pflegehelfer (m/w/d) im ambulanten Pflegedienst in Hamburg – Voll-, Teilzeit oder Minijob. Quereinstieg möglich.',
                    'JobDescription' => self::jobAssistenz(),
                ],
            ],
            'kontakt' => [
                'sort' => 5,
                'class' => ContactPage::class,
                'segment' => 'kontakt',
                'fields' => [
                    'Title' => 'Kontakt',
                    'MetaTitle' => 'Pflegedienst Hamburg Kontakt – Pflegeteam Zukunft',
                    'MetaDescription' => 'Kontakt zum Pflegeteam Zukunft: Bürgerweide 21, 20535 Hamburg, Tel. 040 668721-70. Büro Mo–Fr 8–16 Uhr. Pflege anfragen oder Rückruf vereinbaren.',
                ],
            ],
            'impressum' => [
                'sort' => 6,
                'class' => Page::class,
                'segment' => 'impressum',
                'fields' => [
                    'Title' => 'Impressum',
                    'ShowInMenus' => false,
                    'NoIndex' => true,
                    'MetaTitle' => 'Impressum – Pflegeteam Zukunft GmbH',
                    'MetaDescription' => 'Impressum der Pflegeteam Zukunft GmbH, Bürgerweide 21, 20535 Hamburg: Anbieterkennzeichnung, Kontakt, Registereintrag und verantwortliche Person.',
                    'Content' => self::impressum(),
                ],
            ],
            'datenschutz' => [
                'sort' => 7,
                'class' => Page::class,
                'segment' => 'datenschutz',
                'draft' => true,
                'fields' => [
                    'Title' => 'Datenschutz',
                    'ShowInMenus' => false,
                    'NoIndex' => true,
                    'MetaTitle' => 'Datenschutzerklärung – Pflegeteam Zukunft GmbH',
                    'MetaDescription' => 'Datenschutzerklärung der Pflegeteam Zukunft GmbH: welche Daten wir auf dieser Website und in den Kontakt- und Bewerbungsformularen verarbeiten und warum.',
                    'Content' => '<p><strong>Entwurf:</strong> Die Datenschutzerklärung wird vom Kunden geliefert (Formulare inkl. Datei-Upload für Bewerbungen, keine Tracking-Dienste, Karte nur nach Einwilligung).</p>',
                ],
            ],
        ];
    }

    /**
     * Blocks per page and elemental area (relation name).
     *
     * @return array<string, array<string, array<int, array<string, mixed>>>>
     */
    public static function blocks(): array
    {
        $phoneLink = ['phone' => self::PHONE_E164, 'text' => self::PHONE . ' anrufen'];

        return [
            'home' => [
                'ElementalArea' => [
                    [
                        'type' => ElementHero::class,
                        'fields' => [
                            'Title' => 'Gut versorgt zu Hause – mit einem Team, das Ihre Sprache spricht.',
                            'HeadingLevel' => 'h1',
                            'Eyebrow' => 'Ambulanter Pflegedienst in Hamburg',
                            'Lead' => 'Als ambulanter Pflegedienst in Hamburg übernehmen wir Grundpflege, Behandlungspflege und Entlastung im Alltag. Die Abrechnung mit Pflege- und Krankenkasse erledigen wir für Sie.',
                            'Variant' => 'home',
                            'ShowBreadcrumbs' => false,
                            'TrustItems' => "MD-Prüfung 2025: Note 1,5\nVertragspartner aller Kassen\n8 Sprachen im Team",
                            'TeaserBadge' => 'Wir stellen ein',
                            'TeaserTitle' => 'Pflegefachkräfte & Pflegeassistenz (m/w/d)',
                            'TeaserText' => 'Vollzeit oder Teilzeit · Hamburg',
                            'Spacing' => 'none',
                        ],
                        'images' => ['Image' => ['startseite-hero.jpg', 'Pflegerin lacht mit einem älteren Herrn am Küchentisch in seiner Hamburger Wohnung']],
                        'teaserLink' => ['page' => 'karriere', 'text' => 'Offene Stellen ansehen'],
                        'links' => [
                            ['page' => 'kontakt', 'text' => 'Pflege anfragen'],
                            $phoneLink,
                        ],
                    ],
                    [
                        'type' => ElementFeatureGrid::class,
                        'fields' => [
                            'Title' => 'Unsere Pflege – so viel Hilfe, wie Sie brauchen',
                            'Eyebrow' => 'Leistungen',
                            'Intro' => 'Von der Körperpflege bis zur ärztlich verordneten Behandlung – alles aus einer Hand, abgerechnet mit Ihrer Kasse.',
                            'Variant' => 'image-cards',
                            'Columns' => '3',
                            'HeaderAlign' => 'split',
                        ],
                        'items' => [
                            ['title' => 'Grundpflege', 'text' => 'Körperpflege, Anziehen, Mobilität und Mahlzeiten – mit Ruhe und Respekt.', 'image' => ['leistung-grundpflege.jpg', 'Pflegerin hilft einer älteren Dame beim Anziehen einer Strickjacke'], 'link' => ['page' => 'grundpflege', 'text' => 'Mehr zur Grundpflege']],
                            ['title' => 'Behandlungspflege', 'text' => 'Medikamente, Verbandswechsel, Injektionen und Kompression – nach ärztlicher Verordnung.', 'image' => ['leistung-behandlungspflege.jpg', 'Pflegefachkraft misst bei einem älteren Herrn zu Hause den Blutzucker'], 'link' => ['page' => 'behandlungspflege', 'text' => 'Mehr zur Behandlungspflege']],
                            ['title' => 'Betreuung & Entlastung', 'text' => 'Haushalt, Einkäufe und Arztbegleitung – über den Entlastungsbetrag nach § 45b SGB XI.', 'image' => ['leistung-entlastung.jpg', 'Betreuungskraft begleitet eine Seniorin beim Einkauf auf dem Wochenmarkt'], 'link' => ['page' => 'betreuung-entlastung', 'text' => 'Mehr zu Betreuung & Entlastung']],
                            ['title' => 'Verhinderungspflege', 'text' => 'Pflegende Angehörige brauchen Pausen – wir übernehmen, ohne Lücke.', 'image' => ['leistung-verhinderungspflege.jpg', 'Pflegekraft und Tochter eines Pflegebedürftigen besprechen die Vertretung'], 'link' => ['page' => 'verhinderungspflege', 'text' => 'Mehr zur Verhinderungspflege']],
                            ['title' => 'Pflegeberatung', 'text' => 'Beratungsbesuche nach § 37 Abs. 3 und kostenlose Erstberatung zu Pflegegrad und Kasse.', 'image' => ['leistung-pflegeberatung.jpg', 'Pflegeberaterin spricht mit einem älteren Ehepaar am Wohnzimmertisch'], 'link' => ['page' => 'pflegeberatung', 'text' => 'Mehr zur Pflegeberatung']],
                            ['title' => 'Alles, was den Alltag leichter macht', 'text' => 'Arztbegleitung, Hilfe bei Anträgen, Medikamente besorgen, Hausnotruf und Menüdienst vermitteln.', 'image' => ['leistung-alltag.jpg', 'Pflegekraft und Senior füllen gemeinsam einen Antrag aus'], 'link' => ['page' => 'leistungen', 'text' => 'Alle Leistungen ansehen']],
                        ],
                    ],
                    [
                        'type' => ElementFeatureGrid::class,
                        'fields' => [
                            'Title' => 'In drei Schritten zu Ihrer Pflege',
                            'Eyebrow' => 'So einfach geht’s',
                            'Variant' => 'steps',
                            'Columns' => '3',
                            'HeaderAlign' => 'center',
                            'Background' => 'light',
                        ],
                        'items' => [
                            ['title' => 'Anrufen oder anfragen', 'text' => 'Sie erreichen uns Montag bis Freitag von 8 bis 16 Uhr – oder schreiben uns über das Kontaktformular.'],
                            ['title' => 'Beratung bei Ihnen zu Hause', 'text' => 'Wir besprechen, was Sie brauchen, und erstellen vorab einen Kostenvoranschlag.'],
                            ['title' => 'Pflege beginnt', 'text' => 'Ein überschaubarer, fester Kreis von Pflegekräften kommt zu Ihnen. Die Abrechnung übernehmen wir.'],
                        ],
                    ],
                    [
                        'type' => ElementTextMedia::class,
                        'fields' => [
                            'Title' => 'Pflege mit Zukunft – auch für dich.',
                            'Eyebrow' => 'Karriere',
                            'Content' => '<p>Wir suchen Pflegefachkräfte und Pflegeassistenz (m/w/d), die gerne mit Menschen arbeiten. Berufseinsteiger:innen sind genauso willkommen wie erfahrene Kolleg:innen.</p><ul class="list-check"><li>Voll- oder Teilzeit nach Wunsch</li><li>Leistungsgerechte Vergütung</li><li>Fester Ansprechpartner</li><li>Großzügige Urlaubsregelung</li><li>Fort- und Weiterbildung</li><li>Team aus vielen Kulturen</li></ul>',
                            'ImagePosition' => 'left',
                            'Background' => 'dark',
                        ],
                        'images' => ['Image' => ['karriere-team.jpg', 'Zwei Pflegekräfte im Gespräch vor dem Dienstwagen, beide lachen']],
                        'links' => [
                            ['page' => 'karriere', 'text' => 'Offene Stellen ansehen'],
                            ['page' => 'karriere', 'anchor' => CareerPage::APPLY_ANCHOR, 'text' => 'In 2 Minuten bewerben'],
                        ],
                    ],
                    [
                        'type' => ElementTextMedia::class,
                        'fields' => [
                            'Title' => 'Wir sprechen Ihre Sprache.',
                            'Eyebrow' => 'Über uns',
                            'Content' => '<p>Unser Team kommt aus vielen Ländern. Das macht Pflege einfacher – für Pflegebedürftige und für Angehörige, die mitreden wollen.</p>',
                            'Chips' => "Deutsch\nEnglisch\nBosnisch\nKroatisch\nSerbisch\nMazedonisch\nRussisch\nLitauisch",
                            'ImagePosition' => 'right',
                            'CardEyebrow' => 'Qualitätsprüfung des Medizinischen Dienstes · 04.09.2025',
                            'CardValue' => '1,5',
                            'CardLabel' => 'Gesamtnote „gut“',
                            'CardRows' => "Pflegerische Leistungen | 1,6\nÄrztlich verordnete Leistungen | 2,0\nDienstleistung & Organisation | 1,0\nBefragung der Pflegebedürftigen | 1,2",
                        ],
                        'cardLink' => ['url' => 'https://www.pflegesuche.de/pflegedienst-qualitaetsbericht/MDK-pflegeteam-zukunft-gmbh_41026.pdf', 'text' => 'Transparenzbericht ansehen (PDF)', 'newWindow' => true],
                        'links' => [
                            ['page' => 'ueber-uns', 'text' => 'Unser Team kennenlernen'],
                        ],
                    ],
                    [
                        'type' => ElementTestimonials::class,
                        'fields' => [
                            'Title' => 'Das sagen Familien über uns',
                            'RatingSummary' => '5,0 bei Google',
                            'Background' => 'light',
                        ],
                        'items' => [
                            ['Quote' => 'Ein herzlicher, kompetenter Pflegedienst mit sehr tollen Mitarbeitern. Meine Großeltern werden vom Pflegeteam betreut – es ist jedes Mal eine Freude zu hören, wie glücklich und zufrieden sie mit der Betreuung sind.', 'Author' => 'Ammar B.', 'Context' => 'Angehöriger', 'Source' => 'Google', 'Rating' => 5, 'IncludeInSchema' => false],
                            ['Quote' => 'Sehr guter Pflegedienst, Mitarbeiter und Chef sind sehr zuvorkommend und freundlich.', 'Author' => 'Carlos H.', 'Source' => 'Google', 'Rating' => 5, 'IncludeInSchema' => false],
                        ],
                    ],
                    [
                        'type' => ElementFaq::class,
                        'fields' => [
                            'Title' => 'Gut zu wissen, bevor es losgeht',
                            'Eyebrow' => 'Häufige Fragen',
                            'Intro' => '<p>Wir sind vor allem im Hamburger Osten und in der Innenstadt unterwegs: Hamm, Borgfelde, St. Georg, Hohenfelde, Eilbek, Horn, Wandsbek und Barmbek. Wohnen Sie woanders? Fragen Sie uns einfach.</p>',
                            'Layout' => 'intro-left',
                            'SideImageAlt' => 'Karte des Einsatzgebiets im Hamburger Osten rund um die Bürgerweide',
                        ],
                        'sideImage' => ['einsatzgebiet-karte.png', 'Karte des Einsatzgebiets im Hamburger Osten rund um die Bürgerweide'],
                        'items' => [
                            ['Was kostet ambulante Pflege?', 'Mit Pflegegrad übernimmt die Pflegekasse einen großen Teil über die Pflegesachleistung; ärztlich verordnete Behandlungspflege zahlt die Krankenkasse. Vorab bekommen Sie von uns einen Kostenvoranschlag – ohne Überraschungen.'],
                            ['Brauche ich einen Pflegegrad?', 'Für Behandlungspflege genügt eine ärztliche Verordnung. Für Grundpflege, Entlastung und Verhinderungspflege brauchen Sie einen Pflegegrad. Wir helfen Ihnen beim Antrag bei Ihrer Pflegekasse.'],
                            ['Wie schnell kann die Pflege beginnen?', 'Rufen Sie uns an: Wir vereinbaren zeitnah einen Beratungstermin bei Ihnen zu Hause und sagen Ihnen dabei, ab wann wir freie Kapazitäten haben.'],
                            ['Pflegen Sie auch Menschen mit Demenz?', 'Ja. Wir richten uns nach der Lebensgeschichte und den Gewohnheiten der Menschen, die wir pflegen, und beziehen die Angehörigen mit ein.'],
                            ['Kommt immer dieselbe Pflegekraft?', 'Wir planen die Einsätze so, dass ein überschaubarer, fester Kreis von Pflegekräften zu Ihnen kommt und die Zeiten mit Ihnen abgestimmt sind.'],
                        ],
                    ],
                    [
                        'type' => ElementCallToAction::class,
                        'fields' => [
                            'Title' => 'Fragen zur Pflege? Wir beraten Sie kostenlos.',
                            'Content' => 'Montag bis Freitag von 8 bis 16 Uhr – auf Deutsch, Bosnisch, Russisch und in weiteren Sprachen.',
                            'Variant' => 'boxed',
                            'Spacing' => 'md',
                        ],
                        'links' => [
                            ['phone' => self::PHONE_E164, 'text' => self::PHONE],
                            ['page' => 'kontakt', 'text' => 'Rückruf anfordern'],
                        ],
                    ],
                ],
            ],
            'leistungen' => [
                'ElementalArea' => [
                    self::hero('Leistungen in der ambulanten Pflege in Hamburg', 'Was wir für Sie tun', 'Wir pflegen, versorgen und entlasten – genau so viel, wie Sie brauchen. Die Leistungen rechnen wir direkt mit Ihrer Pflege- oder Krankenkasse ab.', ['leistungen-hero.jpg', 'Pflegekraft und Seniorin lachen gemeinsam auf dem Sofa'], [['page' => 'kontakt', 'text' => 'Pflege anfragen'], $phoneLink]),
                    [
                        'type' => ElementFeatureGrid::class,
                        'fields' => [
                            'Title' => 'Was wir zusätzlich für Sie übernehmen',
                            'Eyebrow' => 'Mehr Lebensqualität',
                            'Intro' => 'Über die Pflege hinaus erleichtern wir Ihren Alltag – viele dieser Hilfen lassen sich über den Entlastungsbetrag abrechnen.',
                            'Variant' => 'icon-cards',
                            'Columns' => '3',
                            'Background' => 'light',
                        ],
                        'items' => [
                            ['title' => 'Begleitung zu Ärzten', 'text' => 'Wir bringen Sie sicher und pünktlich zu Arztterminen, Therapien und Behörden.', 'icon' => 'hand'],
                            ['title' => 'Hilfe bei Anträgen', 'text' => 'Pflegegrad, Hilfsmittel, Kostenübernahme: Wir unterstützen beim Ausfüllen und Einreichen.', 'icon' => 'shield'],
                            ['title' => 'Einkäufe', 'text' => 'Wir begleiten Sie beim Einkaufen oder erledigen die Einkäufe für Sie.', 'icon' => 'cart'],
                            ['title' => 'Medikamente besorgen', 'text' => 'Wir sorgen dafür, dass Ihre Medikamente rechtzeitig da sind.', 'icon' => 'pill'],
                            ['title' => 'Vermittlung von Diensten', 'text' => 'Fußpflege, Friseur, Menüdienst und Hausnotruf – wir stellen den Kontakt her.', 'icon' => 'phone'],
                            ['title' => 'Freizeit gestalten', 'text' => 'Spaziergänge, Vorlesen, Gespräche: Zeit für das, was Ihnen Freude macht.', 'icon' => 'sun'],
                        ],
                    ],
                    self::faq('Häufige Fragen zu unseren Leistungen', [
                        ['Wer bezahlt die Pflege?', 'Grundpflege, Betreuung und Verhinderungspflege bezahlt die Pflegekasse, sobald ein Pflegegrad vorliegt. Behandlungspflege bezahlt die Krankenkasse auf ärztliche Verordnung. Wir rechnen direkt mit der Kasse ab und informieren Sie vorab über einen möglichen Eigenanteil.'],
                        ['Kann ich Leistungen kombinieren?', 'Ja. Häufig ergänzen sich Grundpflege, Behandlungspflege und Entlastung. Im Beratungsgespräch stellen wir mit Ihnen das passende Paket zusammen.'],
                        ['Arbeiten Sie mit Ärzten zusammen?', 'Ja, wir stimmen uns bei Behandlungspflege eng mit Ihrer Ärztin oder Ihrem Arzt und mit Therapeut:innen ab.'],
                    ]),
                    self::cta(),
                ],
            ],
            'grundpflege' => self::servicePage(
                'Grundpflege zu Hause in Hamburg',
                'Pflegekasse · SGB XI',
                'Hilfe bei der Körperpflege, beim Anziehen, bei der Mobilität und beim Essen – damit Sie so lange wie möglich selbstbestimmt zu Hause leben.',
                ['grundpflege-hero.jpg', 'Pflegerin hilft einer älteren Dame beim Aufstehen aus dem Sessel'],
                '<p>Grundpflege umfasst alle Hilfen, die Sie täglich brauchen, um sich in Ihrer Wohnung wohl und sicher zu fühlen. Unsere Pflegekräfte richten sich nach Ihren Gewohnheiten und Wünschen – ob Sie lieber morgens duschen oder abends.</p><p>Die Grundpflege wird über die Pflegesachleistung Ihrer Pflegekasse abgerechnet, sobald ein Pflegegrad vorliegt. Wir erstellen vorab einen Kostenvoranschlag.</p>',
                'Was gehört zur Grundpflege?',
                [
                    ['Körperpflege', 'Waschen, Duschen, Baden, Zahn- und Mundpflege, Rasur.', 'heart'],
                    ['An- und Auskleiden', 'Hilfe beim Anziehen und bei der Auswahl der Kleidung.', 'user'],
                    ['Mobilität', 'Aufstehen, Gehen, Lagern, Transfer in Rollstuhl oder Bett.', 'hand'],
                    ['Ernährung', 'Hilfe beim Essen und Trinken, Blick auf ausreichend Flüssigkeit.', 'home'],
                ],
                [
                    ['Wie oft kommt die Pflege?', 'So oft Sie es brauchen – von einem Einsatz pro Woche bis zu mehreren Besuchen am Tag. Die Zeiten stimmen wir mit Ihnen ab.'],
                    ['Was kostet Grundpflege?', 'Die Pflegekasse übernimmt die Kosten bis zur Höhe der Pflegesachleistung Ihres Pflegegrads. Liegt der Bedarf darüber, informieren wir Sie vorab über den Eigenanteil.'],
                    ['Kann ich die Grundpflege mit Pflegegeld kombinieren?', 'Ja, als Kombinationsleistung. Wir beraten Sie, welche Aufteilung für Sie sinnvoll ist.'],
                ]
            ),
            'behandlungspflege' => self::servicePage(
                'Behandlungspflege in Hamburg – sicher zu Hause versorgt',
                'Ärztlich verordnet · SGB V',
                'Medikamente, Verbände, Injektionen und Kompression nach Verordnung Ihrer Ärztin oder Ihres Arztes. Die Kosten trägt die Krankenkasse.',
                ['behandlungspflege-hero.jpg', 'Pflegefachkraft wechselt einen Verband am Unterschenkel eines Seniors im Wohnzimmer'],
                '<p>Behandlungspflege umfasst alle medizinischen Maßnahmen, die eine Ärztin oder ein Arzt verordnet und die unsere examinierten Pflegefachkräfte bei Ihnen zu Hause durchführen. So vermeiden Sie Wege in die Praxis – oder einen Krankenhausaufenthalt.</p><p>Die Kosten trägt Ihre Krankenkasse (häusliche Krankenpflege nach § 37 SGB V). Bei Fragen zur Verordnung stimmen wir uns direkt mit der Praxis ab.</p>',
                'Was gehört zur Behandlungspflege?',
                [
                    ['Medikamente', 'Medikamente stellen und verabreichen, Augentropfen, Bedarfsmedikation.', 'pill'],
                    ['Verbandswechsel & Wunden', 'Wundversorgung nach aktuellem Stand und ärztlicher Anordnung.', 'bandage'],
                    ['Insulin & Blutzucker', 'Blutzuckermessung, Insulininjektionen, Dokumentation.', 'heart'],
                    ['Kompression', 'Kompressionsstrümpfe und -verbände an- und ausziehen.', 'hand'],
                ],
                [
                    ['Wer bezahlt die Behandlungspflege?', 'Die Krankenkasse, wenn eine ärztliche Verordnung für häusliche Krankenpflege vorliegt. Ein Pflegegrad ist dafür nicht nötig.'],
                    ['Wie bekomme ich eine Verordnung?', 'Ihre Hausärztin oder Ihr Hausarzt stellt sie aus. Schicken Sie uns die Verordnung oder rufen Sie an – wir kümmern uns um die Genehmigung bei der Kasse.'],
                    ['Wer führt die Behandlungspflege durch?', 'Ausschließlich examinierte Pflegefachkräfte unseres Teams.'],
                ]
            ),
            'betreuung-entlastung' => self::servicePage(
                'Betreuung und Entlastung im Alltag',
                'Entlastungsbetrag · § 45b SGB XI',
                'Haushalt, Einkäufe, Begleitung zum Arzt oder einfach Gesellschaft – finanziert über den Entlastungsbetrag Ihrer Pflegekasse.',
                ['entlastung-hero.jpg', 'Betreuungskraft und Seniorin spielen gemeinsam ein Brettspiel am Tisch'],
                '<p>Ab Pflegegrad 1 steht Ihnen monatlich ein Entlastungsbetrag nach § 45b SGB XI zu. Damit können Sie Hilfen im Alltag finanzieren, die pflegende Angehörige entlasten und Ihre Selbstständigkeit fördern.</p><p>Nicht genutzte Beträge verfallen nicht sofort – wir beraten Sie, wie Sie den Anspruch am besten nutzen.</p>',
                'Wobei wir Sie entlasten',
                [
                    ['Haushalt', 'Aufräumen, Wäsche, Reinigung der Wohnung.', 'home'],
                    ['Einkäufe', 'Gemeinsam einkaufen oder Einkäufe für Sie erledigen.', 'cart'],
                    ['Begleitung', 'Zu Ärzten, Behörden, Friseur oder Spaziergang.', 'hand'],
                    ['Gesellschaft', 'Gespräche, Vorlesen, Spiele – gegen Einsamkeit.', 'chat'],
                ],
                [
                    ['Wer hat Anspruch auf den Entlastungsbetrag?', 'Alle Pflegebedürftigen mit Pflegegrad 1 bis 5, die zu Hause gepflegt werden.'],
                    ['Muss ich in Vorleistung gehen?', 'Nein. Wir rechnen auf Wunsch direkt mit Ihrer Pflegekasse ab, sofern Sie uns dazu bevollmächtigen.'],
                    ['Betreuen Sie auch Menschen mit Demenz?', 'Ja, unsere Betreuung richtet sich nach der Biografie und den Gewohnheiten der Menschen und bezieht die Angehörigen ein.'],
                ]
            ),
            'verhinderungspflege' => self::servicePage(
                'Verhinderungspflege in Hamburg',
                'Pflegekasse · § 39 SGB XI',
                'Wenn pflegende Angehörige Urlaub brauchen oder krank sind, übernehmen wir die Pflege zu Hause – stundenweise oder für mehrere Wochen.',
                ['verhinderungspflege-hero.jpg', 'Tochter verabschiedet sich mit Koffer, Pflegekraft sitzt bei der Mutter'],
                '<p>Pflegende Angehörige leisten jeden Tag viel. Damit Sie selbst gesund bleiben, zahlt die Pflegekasse eine Vertretung: die Verhinderungspflege. Wir übernehmen in dieser Zeit die Pflege und Betreuung, damit die Versorgung ohne Lücke weiterläuft.</p><p>Voraussetzung ist ein Pflegegrad ab 2. Seit Juli 2025 gilt für Verhinderungs- und Kurzzeitpflege ein gemeinsamer Jahresbetrag – wir sagen Ihnen, was Ihnen zusteht.</p>',
                'So läuft die Vertretung',
                [
                    ['Früh melden', 'Sagen Sie uns, wann Sie verhindert sind – auch kurzfristig.', 'calendar'],
                    ['Kennenlernen', 'Wir lernen Ihre Abläufe und Wünsche vorab kennen.', 'users'],
                    ['Pflege übernehmen', 'Stundenweise oder tageweise, so wie Sie es brauchen.', 'heart'],
                    ['Abrechnung', 'Wir rechnen direkt mit der Pflegekasse ab.', 'euro'],
                ],
                [
                    ['Wer hat Anspruch auf Verhinderungspflege?', 'Pflegebedürftige ab Pflegegrad 2, die zu Hause von Angehörigen oder Bekannten gepflegt werden.'],
                    ['Muss ich die Verhinderungspflege beantragen?', 'Ja, bei Ihrer Pflegekasse. Wir helfen Ihnen beim Antrag.'],
                    ['Geht Verhinderungspflege auch stundenweise?', 'Ja, zum Beispiel für einen Arzttermin oder einen freien Nachmittag.'],
                ]
            ),
            'pflegeberatung' => self::servicePage(
                'Pflegeberatung und Beratungsbesuch nach § 37 Abs. 3',
                'Kostenlos für Sie',
                'Wer Pflegegeld bekommt, braucht regelmäßig einen Beratungsbesuch. Wir kommen zu Ihnen nach Hause – und beraten Sie auch sonst kostenlos zu Pflegegrad und Leistungen.',
                ['pflegeberatung-hero.jpg', 'Pflegeberaterin erklärt einem älteren Ehepaar Unterlagen am Wohnzimmertisch'],
                '<p>Beziehen Sie Pflegegeld und werden von Angehörigen gepflegt, ist ein Beratungsbesuch nach § 37 Abs. 3 SGB XI vorgeschrieben: bei Pflegegrad 2 und 3 halbjährlich, bei Pflegegrad 4 und 5 vierteljährlich. Die Kosten trägt die Pflegekasse.</p><p>Beim Besuch schauen wir gemeinsam, ob die Pflege gut läuft, wo es hakt und welche Hilfen Ihnen noch zustehen. Darüber hinaus beraten wir Sie kostenlos, wenn Sie einen Pflegegrad beantragen oder Leistungen kombinieren möchten.</p>',
                'Wobei wir Sie beraten',
                [
                    ['Beratungsbesuch § 37.3', 'Pflichtberatung für Pflegegeld-Bezieher – bei Ihnen zu Hause.', 'home'],
                    ['Pflegegrad', 'Antrag, Begutachtung durch den Medizinischen Dienst, Höherstufung.', 'shield'],
                    ['Leistungen', 'Sachleistung, Pflegegeld, Entlastung, Verhinderungspflege.', 'euro'],
                    ['Angehörige', 'Tipps für den Pflegealltag und Anleitung bei Pflegetechniken.', 'users'],
                ],
                [
                    ['Ist die Beratung kostenlos?', 'Der Beratungsbesuch nach § 37 Abs. 3 wird von der Pflegekasse bezahlt. Unsere Erstberatung zur Pflege ist für Sie kostenlos und unverbindlich.'],
                    ['Wer führt die Beratung durch?', 'Unsere ausgebildeten Pflegeberaterinnen und examinierten Pflegefachkräfte.'],
                    ['Helfen Sie auch bei Anträgen?', 'Ja, wir unterstützen Sie bei Anträgen an Pflegekasse, Krankenkasse und Sozialamt.'],
                ]
            ),
            'ueber-uns' => [
                'ElementalArea' => [
                    self::hero('Über uns: das Pflegeteam Zukunft', 'Menschen, die helfen', 'Unsere Mitarbeiterinnen und Mitarbeiter sind das Herzstück des Pflegedienstes. Sie sorgen dafür, dass Sie sich zu Hause sicher und gut versorgt fühlen.', ['ueber-uns-hero.jpg', 'Das Team des Pflegeteams Zukunft vor dem Büro an der Bürgerweide'], [['page' => 'kontakt', 'text' => 'Kontakt aufnehmen']]),
                    [
                        'type' => ElementTextMedia::class,
                        'fields' => [
                            'Title' => 'Vielfalt und Fachkompetenz',
                            'Content' => '<p>Unser Team besteht aus examinierten Gesundheits- und Krankenpfleger:innen, Altenpfleger:innen, Kinderkrankenschwestern, Pflegeberater:innen und Pflegeassistent:innen. Regelmäßige Fort- und Weiterbildungen halten uns auf dem aktuellen Stand der Pflege.</p><p>Wir sind Vertragspartner aller Kranken- und Pflegekassen sowie der Sozialämter. Die Kosten rechnen wir in der Regel direkt mit Ihrer Kasse ab.</p>',
                            'Chips' => "Deutsch\nEnglisch\nBosnisch\nKroatisch\nSerbisch\nMazedonisch\nRussisch\nLitauisch",
                            'ImagePosition' => 'right',
                            'CardEyebrow' => 'Qualitätsprüfung des Medizinischen Dienstes · 04.09.2025',
                            'CardValue' => '1,5',
                            'CardLabel' => 'Gesamtnote „gut“',
                            'CardRows' => "Pflegerische Leistungen | 1,6\nÄrztlich verordnete Leistungen | 2,0\nDienstleistung & Organisation | 1,0\nBefragung der Pflegebedürftigen | 1,2",
                        ],
                        'cardLink' => ['url' => 'https://www.pflegesuche.de/pflegedienst-qualitaetsbericht/MDK-pflegeteam-zukunft-gmbh_41026.pdf', 'text' => 'Transparenzbericht ansehen (PDF)', 'newWindow' => true],
                    ],
                    [
                        'type' => ElementTeam::class,
                        'fields' => [
                            'Title' => 'Ihre Ansprechpartner:innen',
                            'Eyebrow' => 'Team',
                            'Background' => 'light',
                        ],
                        'items' => [
                            ['name' => 'Edin Suljic', 'role' => 'Inhaber, Geschäftsführer und Pflegedienstleitung', 'bio' => 'Verantwortet die Pflegequalität und ist Ihr Ansprechpartner für alle Fragen rund um die Versorgung.', 'image' => ['team-edin-suljic.jpg', 'Porträt von Edin Suljic, Inhaber und Pflegedienstleitung']],
                            ['name' => 'Meike Gajda-Stier', 'role' => 'Stellv. Pflegedienstleitung, Pflegeberaterin', 'bio' => 'Examinierte Altenpflegerin und Assistentin der Geschäftsführung. Berät Pflegebedürftige und Angehörige.', 'image' => ['team-meike-gajda-stier.jpg', 'Porträt von Meike Gajda-Stier, stellvertretende Pflegedienstleitung']],
                            ['name' => 'Birgit Hoffmann', 'role' => 'Pflegeberaterin, Krankenschwester', 'bio' => 'Führt Beratungsbesuche durch und unterstützt bei Anträgen.', 'image' => ['team-birgit-hoffmann.jpg', 'Porträt von Birgit Hoffmann, Pflegeberaterin']],
                        ],
                        'links' => [
                            ['page' => 'karriere', 'text' => 'Teil des Teams werden'],
                        ],
                    ],
                    self::cta(),
                ],
            ],
            'karriere' => [
                'ElementalArea' => [
                    [
                        'type' => ElementHero::class,
                        'fields' => [
                            'Title' => 'Pflegedienst-Jobs in Hamburg: Komm ins Pflegeteam Zukunft.',
                            'HeadingLevel' => 'h1',
                            'Eyebrow' => 'Jobs in der ambulanten Pflege',
                            'Lead' => 'Feste Touren, ein Team, das zusammenhält, und Arbeitszeiten, die zu deinem Leben passen. Bewirb dich in zwei Minuten – ohne Anschreiben.',
                            'Variant' => 'accent',
                            'ShowBreadcrumbs' => true,
                            'Spacing' => 'none',
                        ],
                        'images' => ['Image' => ['karriere-hero.jpg', 'Pflegefachkraft mit Tablet steigt in Hamburg aus dem Dienstwagen']],
                        'links' => [
                            ['page' => 'karriere', 'anchor' => CareerPage::APPLY_ANCHOR, 'text' => 'Schnell bewerben'],
                            ['page' => 'karriere', 'anchor' => 'offene-stellen', 'text' => 'Offene Stellen'],
                        ],
                    ],
                    [
                        'type' => ElementFeatureGrid::class,
                        'fields' => [
                            'Title' => 'Was dich bei uns erwartet',
                            'Variant' => 'icon-cards',
                            'Columns' => '3',
                        ],
                        'items' => [
                            ['title' => 'Voll- oder Teilzeit', 'text' => 'Arbeitszeiten nach Absprache – passend zu Familie, Studium oder Zweitjob.', 'icon' => 'clock'],
                            ['title' => 'Faire Vergütung', 'text' => 'Leistungsgerecht bezahlt – sprich uns auf die Details an.', 'icon' => 'euro'],
                            ['title' => 'Fester Ansprechpartner', 'text' => 'Kurze Wege zur Pflegedienstleitung – bei jeder Frage.', 'icon' => 'user'],
                            ['title' => 'Fort- & Weiterbildung', 'text' => 'Wir fördern Schulungen, damit du fachlich vorne bleibst.', 'icon' => 'school'],
                            ['title' => 'Großzügiger Urlaub', 'text' => 'Erholung ist Teil guter Pflege – auch für dich.', 'icon' => 'sun'],
                            ['title' => 'Team aus vielen Ländern', 'text' => 'Acht Sprachen im Team – du bist willkommen, wie du bist.', 'icon' => 'chat'],
                        ],
                    ],
                    [
                        'type' => ElementJobList::class,
                        'fields' => [
                            'Title' => 'Aktuell suchen wir',
                            'Eyebrow' => 'Offene Stellen',
                            'Intro' => 'Deine Stelle ist nicht dabei? Bewirb dich initiativ – wir freuen uns.',
                            'Background' => 'light',
                        ],
                    ],
                ],
                'ApplicationArea' => [
                    [
                        'type' => ElementForm::class,
                        'form' => 'application',
                        'fields' => [
                            'Title' => 'In 2 Minuten bewerben',
                            'ShowTitle' => true,
                            'ExtraClass' => 'form-accent',
                            'SubmitButtonText' => 'Bewerbung absenden',
                            'OnCompleteMessage' => '<p><strong>Danke für deine Bewerbung!</strong> Wir melden uns in den nächsten Tagen telefonisch bei dir.</p>',
                        ],
                    ],
                ],
                'BottomArea' => [
                    self::faq('Fragen zur Bewerbung', [
                        ['Welche Qualifikation brauche ich?', 'Für die Fachkraft-Stelle eine abgeschlossene Ausbildung in der Alten-, Gesundheits- und Krankenpflege oder als Pflegefachfrau/-mann. Für die Pflegeassistenz eine Ausbildung in der Pflegehilfe – Quereinsteiger:innen sprechen uns gern an.'],
                        ['Gibt es flexible Arbeitszeiten?', 'Ja. Wir bieten Voll- und Teilzeit an und gestalten die Arbeitszeiten nach Absprache.'],
                        ['Wie läuft die Bewerbung ab?', 'Formular senden oder anrufen – danach lernen wir uns persönlich in unserem Büro kennen. Ein Anschreiben brauchst du nicht.'],
                        ['Werden Fortbildungen unterstützt?', 'Ja, wir fördern die Teilnahme an Fort- und Weiterbildungen, damit du fachlich auf dem neuesten Stand bleibst.'],
                    ], 'md'),
                ],
            ],
            'job-pflegefachkraft' => [
                'ElementalArea' => [
                    self::hero('Pflegefachkraft (m/w/d) in der ambulanten Pflege', 'Stellenangebot · Hamburg', 'Examiniert, mit Herz und Lust auf eigenständiges Arbeiten – bei uns findest du ein Team, das zusammenhält.', null, [['page' => 'karriere', 'anchor' => CareerPage::APPLY_ANCHOR, 'text' => 'Jetzt bewerben'], ['phone' => self::PHONE_E164, 'text' => 'Fragen? ' . self::PHONE]], 'accent'),
                ],
            ],
            'job-pflegeassistenz' => [
                'ElementalArea' => [
                    self::hero('Pflegeassistenz / Pflegehelfer (m/w/d)', 'Stellenangebot · Hamburg', 'Du unterstützt unsere Fachkräfte in der Grundpflege und im Alltag unserer Kund:innen – in Voll-, Teilzeit oder als Minijob.', null, [['page' => 'karriere', 'anchor' => CareerPage::APPLY_ANCHOR, 'text' => 'Jetzt bewerben'], ['phone' => self::PHONE_E164, 'text' => 'Fragen? ' . self::PHONE]], 'accent'),
                ],
            ],
            'kontakt' => [
                'ElementalArea' => [
                    self::hero('Kontakt zum Pflegedienst in Hamburg', 'Wir sind für Sie da', 'Rufen Sie uns an oder schreiben Sie uns – wir melden uns schnell zurück und vereinbaren gern einen Beratungstermin bei Ihnen zu Hause.', null, [$phoneLink]),
                    [
                        'type' => ElementForm::class,
                        'form' => 'contact',
                        'fields' => [
                            'Title' => 'Pflege anfragen oder Rückruf vereinbaren',
                            'ShowTitle' => true,
                            'SubmitButtonText' => 'Anfrage senden',
                            'OnCompleteMessage' => '<p><strong>Vielen Dank für Ihre Nachricht!</strong> Wir melden uns so schnell wie möglich – in der Regel am nächsten Werktag.</p>',
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Old URLs (2019 site, client test site) → page key. 301 via silverstripe/redirectedurls.
     *
     * @return array<string, string>
     */
    public static function redirects(): array
    {
        return [
            '/web' => 'home',
            '/web/index.php' => 'home',
            '/team' => 'ueber-uns',
            '/stellenangebote' => 'karriere',
            '/pflegeberatung' => 'pflegeberatung',
        ];
    }

    /**
     * Userforms definitions. Fields with 'half' sit side by side from md up.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function forms(): array
    {
        $privacy = [
            'key' => 'privacy',
            'class' => EditableCheckbox::class,
            'data' => [
                'Name' => 'Datenschutz',
                'Title' => 'Ich bin einverstanden, dass meine Angaben zur Bearbeitung meiner Anfrage gespeichert werden. Hinweise in der Datenschutzerklärung.',
                'Required' => true,
                'CustomErrorMessage' => 'Bitte bestätigen Sie die Datenschutzhinweise.',
            ],
        ];

        return [
            'contact' => [
                'subject' => 'Neue Anfrage über die Website',
                'from' => 'noreply@pflegeteam-zukunft.de',
                'fields' => [
                    ['key' => 'name', 'class' => EditableTextField::class, 'data' => ['Name' => 'Name', 'Title' => 'Vor- und Nachname', 'Required' => true, 'Autocomplete' => 'name', 'ExtraClass' => 'field--half']],
                    ['key' => 'phone', 'class' => EditableTextField::class, 'data' => ['Name' => 'Telefon', 'Title' => 'Telefon', 'Required' => true, 'Autocomplete' => 'tel', 'ExtraClass' => 'field--half']],
                    ['key' => 'email', 'class' => EditableEmailField::class, 'data' => ['Name' => 'Email', 'Title' => 'E-Mail', 'Required' => false, 'ExtraClass' => 'field--half']],
                    ['key' => 'topic', 'class' => EditableDropdown::class, 'data' => ['Name' => 'Anliegen', 'Title' => 'Ihr Anliegen', 'Required' => true, 'ExtraClass' => 'field--half'], 'options' => ['Pflege anfragen', 'Rückruf vereinbaren', 'Beratungsbesuch nach § 37.3', 'Sonstiges']],
                    ['key' => 'message', 'class' => EditableTextField::class, 'data' => ['Name' => 'Nachricht', 'Title' => 'Nachricht', 'Required' => false, 'Rows' => 5, 'Placeholder' => 'Wer braucht Unterstützung, und wobei?']],
                    $privacy,
                ],
            ],
            'application' => [
                'subject' => 'Neue Kurzbewerbung über die Website',
                'from' => 'noreply@pflegeteam-zukunft.de',
                'uploadFolder' => 'Bewerbungen',
                'fields' => [
                    ['key' => 'name', 'class' => EditableTextField::class, 'data' => ['Name' => 'Name', 'Title' => 'Vor- und Nachname', 'Required' => true, 'Autocomplete' => 'name', 'ExtraClass' => 'field--half']],
                    ['key' => 'phone', 'class' => EditableTextField::class, 'data' => ['Name' => 'Telefon', 'Title' => 'Telefon', 'Required' => true, 'Autocomplete' => 'tel', 'ExtraClass' => 'field--half']],
                    ['key' => 'email', 'class' => EditableEmailField::class, 'data' => ['Name' => 'Email', 'Title' => 'E-Mail', 'Required' => false, 'ExtraClass' => 'field--half']],
                    ['key' => 'qualification', 'class' => EditableDropdown::class, 'data' => ['Name' => 'Qualifikation', 'Title' => 'Qualifikation', 'Required' => true, 'ExtraClass' => 'field--half'], 'options' => ['Pflegefachkraft (examiniert)', 'Pflegeassistenz / Pflegehelfer', 'In Ausbildung / Quereinstieg']],
                    ['key' => 'scope', 'class' => EditableRadioField::class, 'data' => ['Name' => 'Umfang', 'Title' => 'Gewünschter Umfang', 'Required' => false], 'options' => ['Vollzeit', 'Teilzeit', 'Minijob']],
                    ['key' => 'cv', 'class' => EditableFileField::class, 'data' => ['Name' => 'Lebenslauf', 'Title' => 'Lebenslauf (optional, PDF, bis 5 MB)', 'Required' => false, 'MaxFileSizeMB' => 5, 'FolderConfirmed' => true]],
                    array_replace_recursive($privacy, ['data' => ['Title' => 'Ich stimme zu, dass meine Angaben zur Bearbeitung meiner Bewerbung gespeichert werden. Hinweise in der Datenschutzerklärung.', 'CustomErrorMessage' => 'Bitte bestätige die Datenschutzhinweise.']]),
                ],
            ],
        ];
    }

    // ---------------------------------------------------------------------
    // Block builders
    // ---------------------------------------------------------------------

    /**
     * @param array{0: string, 1: string}|null $image
     * @param array<int, array<string, mixed>> $links
     * @return array<string, mixed>
     */
    private static function hero(string $title, string $eyebrow, string $lead, ?array $image, array $links, string $variant = 'compact'): array
    {
        $block = [
            'type' => ElementHero::class,
            'fields' => [
                'Title' => $title,
                'HeadingLevel' => 'h1',
                'Eyebrow' => $eyebrow,
                'Lead' => $lead,
                'Variant' => $variant,
                'ShowBreadcrumbs' => true,
                'Spacing' => 'none',
            ],
            'links' => $links,
        ];
        if ($image) {
            $block['images'] = ['Image' => $image];
        }

        return $block;
    }

    /**
     * @param array<int, array{0: string, 1: string}> $items
     * @return array<string, mixed>
     */
    private static function faq(string $title, array $items, string $spacing = 'md'): array
    {
        return [
            'type' => ElementFaq::class,
            'fields' => [
                'Title' => $title,
                'Layout' => 'stacked',
                'Spacing' => $spacing,
            ],
            'items' => $items,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private static function cta(): array
    {
        return [
            'type' => ElementCallToAction::class,
            'fields' => [
                'Title' => 'Fragen zur Pflege? Wir beraten Sie kostenlos.',
                'Content' => 'Montag bis Freitag von 8 bis 16 Uhr – auf Deutsch, Bosnisch, Russisch und in weiteren Sprachen.',
                'Variant' => 'boxed',
            ],
            'links' => [
                ['phone' => self::PHONE_E164, 'text' => self::PHONE],
                ['page' => 'kontakt', 'text' => 'Rückruf anfordern'],
            ],
        ];
    }

    /**
     * Service page: compact hero, intro text, feature list, FAQ in the main column; CTA in the bottom area.
     *
     * @param array{0: string, 1: string} $image
     * @param array<int, array{0: string, 1: string, 2: string}> $features
     * @param array<int, array{0: string, 1: string}> $faq
     * @return array<string, array<int, array<string, mixed>>>
     */
    private static function servicePage(string $h1, string $eyebrow, string $lead, array $image, string $intro, string $featureTitle, array $features, array $faq): array
    {
        return [
            'ElementalArea' => [
                self::hero($h1, $eyebrow, $lead, $image, [['page' => 'kontakt', 'text' => 'Pflege anfragen'], ['phone' => self::PHONE_E164, 'text' => self::PHONE . ' anrufen']]),
                [
                    'type' => ElementTextMedia::class,
                    'fields' => ['Title' => 'Das Wichtigste in Kürze', 'Content' => $intro, 'Spacing' => 'none'],
                ],
                [
                    'type' => ElementFeatureGrid::class,
                    'fields' => ['Title' => $featureTitle, 'Variant' => 'icon-cards', 'Columns' => '2', 'Spacing' => 'none'],
                    'items' => array_map(static fn (array $f): array => ['title' => $f[0], 'text' => $f[1], 'icon' => $f[2]], $features),
                ],
                [
                    'type' => ElementFaq::class,
                    'fields' => ['Title' => 'Häufige Fragen', 'Layout' => 'stacked', 'Spacing' => 'none'],
                    'items' => $faq,
                ],
            ],
            'BottomArea' => [
                self::cta(),
            ],
        ];
    }

    // ---------------------------------------------------------------------
    // Long texts
    // ---------------------------------------------------------------------

    private static function jobFachkraft(): string
    {
        return '<h2>Deine Aufgaben</h2>'
            . '<ul class="list-check"><li>Grund- und Behandlungspflege bei unseren Kund:innen zu Hause</li><li>Medikamentengabe, Wundversorgung, Injektionen nach ärztlicher Verordnung</li><li>Pflegeplanung und Dokumentation</li><li>Beratung und Anleitung von Angehörigen</li><li>Enge Abstimmung mit Ärzt:innen und Therapeut:innen</li></ul>'
            . '<h2>Dein Profil</h2>'
            . '<ul class="list-check"><li>Abgeschlossene Ausbildung als Altenpfleger:in, Gesundheits- und Krankenpfleger:in oder Pflegefachfrau/-mann</li><li>Freude am Umgang mit Menschen und Einfühlungsvermögen</li><li>Du findest dich schnell in neue Situationen ein</li><li>Berufseinsteiger:innen sind herzlich willkommen</li></ul>'
            . '<h2>Was wir dir bieten</h2>'
            . '<ul class="list-check"><li>Leistungsgerechte Vergütung</li><li>Voll- oder Teilzeit, Arbeitszeiten nach Absprache</li><li>Einen festen Ansprechpartner für alle Fragen</li><li>Einen sicheren Arbeitsplatz in einem wachsenden Berufsfeld</li><li>Fort- und Weiterbildungen</li><li>Eine großzügige Urlaubsregelung</li></ul>';
    }

    private static function jobAssistenz(): string
    {
        return '<h2>Deine Aufgaben</h2>'
            . '<ul class="list-check"><li>Unterstützung bei Körperpflege, An- und Auskleiden und Mobilität</li><li>Hilfe im Haushalt, bei Einkäufen und Begleitungen</li><li>Betreuung und Gesellschaft für unsere Kund:innen</li><li>Rückmeldung an die zuständige Pflegefachkraft</li></ul>'
            . '<h2>Dein Profil</h2>'
            . '<ul class="list-check"><li>Ausbildung oder Erfahrung in der Pflegehilfe – Quereinstieg möglich</li><li>Zuverlässigkeit, Geduld und ein offenes Herz</li><li>Gute Deutschkenntnisse; weitere Sprachen sind ein Plus</li></ul>'
            . '<h2>Was wir dir bieten</h2>'
            . '<ul class="list-check"><li>Voll-, Teilzeit oder Minijob</li><li>Einarbeitung durch erfahrene Kolleg:innen</li><li>Einen festen Ansprechpartner</li><li>Fort- und Weiterbildungen</li><li>Ein Team aus vielen Kulturen</li></ul>';
    }

    private static function impressum(): string
    {
        return '<h2>Angaben gemäß § 5 DDG</h2>'
            . '<p>Pflegeteam Zukunft GmbH<br>Bürgerweide 21<br>20535 Hamburg</p>'
            . '<p>Vertreten durch die Geschäftsführung: Edin Suljic</p>'
            . '<h2>Kontakt</h2>'
            . '<p>Telefon: 040 668721-70<br>Fax: 040 668721-69<br>E-Mail: info@pflegeteam-zukunft.de</p>'
            . '<h2>Registereintrag</h2>'
            . '<p>Registergericht: Amtsgericht Hamburg<br>Registernummer: HRB 134858</p>'
            . '<h2>Verantwortlich für den Inhalt nach § 18 Abs. 2 MStV</h2>'
            . '<p>Edin Suljic, Bürgerweide 21, 20535 Hamburg</p>'
            . '<h2>Verbraucherstreitbeilegung</h2>'
            . '<p>Wir sind nicht bereit und nicht verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.</p>'
            . '<h2>Aufsichtsbehörde Datenschutz</h2>'
            . '<p>Der Hamburgische Beauftragte für Datenschutz und Informationsfreiheit (<a href="https://datenschutz-hamburg.de" rel="noopener">datenschutz-hamburg.de</a>).</p>';
    }
}

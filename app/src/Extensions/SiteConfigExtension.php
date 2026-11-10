<?php

declare(strict_types=1);

namespace App\Extensions;

use App\Models\OpeningHoursEntry;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\LinkField\Form\LinkField;
use SilverStripe\LinkField\Models\Link;
use SilverStripe\Model\ArrayData;
use SilverStripe\Model\List\ArrayList;
use SilverStripe\ORM\HasManyList;
use SilverStripe\SiteConfig\SiteConfig;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Contact data (NAP), opening hours, footer and social defaults.
 * NAP shown in header/footer/contact page is the same data used for the LocalBusiness schema.
 *
 * @property string $Street
 * @property string $PostalCode
 * @property string $City
 * @property string $Region
 * @property string $CountryCode
 * @property string $Phone
 * @property string $Email
 * @property float $Latitude
 * @property float $Longitude
 * @property string $RouteURL
 * @property string $MapEmbedURL
 * @property string $FooterText
 * @property string $OwnerName
 * @property string $Fax
 * @property string $HiringBadge
 * @property string $HiringText
 * @property string $BusinessType
 * @method Image DefaultOGImage()
 * @method Image FooterSeal()
 * @method Link FooterSealLink()
 * @method HasManyList<OpeningHoursEntry> OpeningHours()
 *
 * @extends Extension<SiteConfig>
 */
class SiteConfigExtension extends Extension
{
    private static array $db = [
        'Street' => 'Varchar(150)',
        'PostalCode' => 'Varchar(10)',
        'City' => 'Varchar(100)',
        'Region' => 'Varchar(100)',
        'CountryCode' => 'Varchar(2)',
        'Phone' => 'Varchar(40)',
        'Email' => 'Varchar(150)',
        'Latitude' => 'Decimal(10,7)',
        'Longitude' => 'Decimal(10,7)',
        'RouteURL' => 'Varchar(1000)',
        'MapEmbedURL' => 'Varchar(1000)',
        'FooterText' => 'Text',
        'OwnerName' => 'Varchar(120)',
        'Fax' => 'Varchar(40)',
        'HiringBadge' => 'Varchar(40)',
        'HiringText' => 'Varchar(160)',
        'BusinessType' => 'Varchar(60)',
    ];

    private static array $has_one = [
        'DefaultOGImage' => Image::class,
        'FooterSeal' => Image::class,
        'FooterSealLink' => Link::class,
    ];

    private static array $has_many = [
        'OpeningHours' => OpeningHoursEntry::class,
    ];

    private static array $owns = [
        'DefaultOGImage',
        'FooterSeal',
        'FooterSealLink',
    ];

    private static array $defaults = [
        'CountryCode' => 'DE',
        'BusinessType' => 'MedicalBusiness',
    ];

    /**
     * International dialling code used to build tel: links from the local number.
     */
    private static string $phone_country_prefix = '+49';

    protected function updateCMSFields(FieldList $fields): void
    {
        $fields->addFieldsToTab('Root.Kontakt', [
            TextField::create('OwnerName', _t(self::class . '.OwnerName', 'Inhaber / Geschäftsführung')),
            TextField::create('Street', _t(self::class . '.Street', 'Straße und Hausnummer')),
            TextField::create('PostalCode', _t(self::class . '.PostalCode', 'PLZ')),
            TextField::create('City', _t(self::class . '.City', 'Ort')),
            TextField::create('Region', _t(self::class . '.Region', 'Bundesland')),
            TextField::create('CountryCode', _t(self::class . '.CountryCode', 'Ländercode (ISO)'))->setAttribute('maxlength', '2'),
            TextField::create('Phone', _t(self::class . '.Phone', 'Telefon'))
                ->setDescription(_t(self::class . '.PhoneHint', 'Schreibweise wie im Footer, z. B. „040 668721-70“.')),
            TextField::create('Fax', _t(self::class . '.Fax', 'Fax')),
            EmailField::create('Email', _t(self::class . '.Email', 'E-Mail')),
            NumericField::create('Latitude', _t(self::class . '.Latitude', 'Breitengrad'))->setScale(7),
            NumericField::create('Longitude', _t(self::class . '.Longitude', 'Längengrad'))->setScale(7),
            TextField::create('RouteURL', _t(self::class . '.RouteURL', 'Link „Route planen“ (Google Maps)')),
            TextField::create('MapEmbedURL', _t(self::class . '.MapEmbedURL', 'Karten-Einbettungs-URL (wird erst nach Klick geladen)')),
        ]);

        if ($this->getOwner()->isInDB()) {
            $config = GridFieldConfig_RecordEditor::create(20)->addComponent(GridFieldOrderableRows::create('Sort'));
            $fields->addFieldToTab(
                'Root.Kontakt',
                GridField::create('OpeningHours', _t(self::class . '.OpeningHours', 'Öffnungszeiten'), $this->getOwner()->OpeningHours(), $config)
            );
        }

        $fields->addFieldsToTab('Root.Karriere', [
            TextField::create('HiringBadge', _t(self::class . '.HiringBadge', 'Hinweis „Wir stellen ein“'))
                ->setDescription(_t(self::class . '.HiringBadgeHint', 'Leer = Jobhinweise in Kopfzeile und Navigation ausblenden.')),
            TextField::create('HiringText', _t(self::class . '.HiringText', 'Text in der Kopfzeile'))
                ->setDescription(_t(self::class . '.HiringTextHint', 'z. B. „Pflegefachkräfte & Pflegeassistenz (m/w/d)“. Verlinkt auf die Karriereseite.')),
        ]);

        $fields->addFieldToTab(
            'Root.SEO',
            TextField::create('BusinessType', _t(self::class . '.BusinessType', 'Schema.org-Typ des Unternehmens'))
                ->setDescription(_t(self::class . '.BusinessTypeHint', 'Standard „MedicalBusiness“. Nur ändern, wenn Sie wissen, was Sie tun.'))
        );

        $fields->addFieldsToTab('Root.Footer', [
            TextareaField::create('FooterText', _t(self::class . '.FooterText', 'Kurztext im Footer'))->setRows(2),
            UploadField::create('FooterSeal', _t(self::class . '.FooterSeal', 'Siegel / Auszeichnung'))
                ->setFolderName('Site')
                ->setAllowedFileCategories('image/supported'),
            LinkField::create('FooterSealLink', _t(self::class . '.FooterSealLink', 'Link des Siegels')),
        ]);

        $fields->addFieldToTab(
            'Root.SEO',
            UploadField::create('DefaultOGImage', _t(self::class . '.DefaultOGImage', 'Standard-Social-Media-Bild'))
                ->setFolderName('SEO')
                ->setAllowedFileCategories('image/supported')
                ->setDescription(_t(self::class . '.DefaultOGImageHint', '1200 × 630 px'))
        );
    }

    public function getPhoneLink(): string
    {
        $digits = preg_replace('/[^\d+]/', '', (string) $this->getOwner()->Phone) ?? '';
        if ($digits === '') {
            return '';
        }
        if (str_starts_with($digits, '+')) {
            return 'tel:' . $digits;
        }
        if (str_starts_with($digits, '00')) {
            return 'tel:+' . substr($digits, 2);
        }

        return 'tel:' . $this->getOwner()->config()->get('phone_country_prefix') . ltrim($digits, '0');
    }

    public function getPhoneE164(): string
    {
        return substr($this->getPhoneLink(), 4);
    }

    public function getFullAddress(): string
    {
        $owner = $this->getOwner();

        return trim(sprintf('%s, %s %s', $owner->Street, $owner->PostalCode, $owner->City), ', ');
    }

    /**
     * Opening hours grouped by label: "Fr" => "09:00–12:00, 15:00–18:00".
     */
    public function getOpeningHoursGrouped(): ArrayList
    {
        $groups = [];
        foreach ($this->getOwner()->OpeningHours()->sort('Sort') as $entry) {
            $label = (string) $entry->Label;
            $groups[$label] ??= [];
            $groups[$label][] = $entry->getTimeRange();
        }

        $list = ArrayList::create();
        foreach ($groups as $label => $ranges) {
            $list->push(ArrayData::create(['Label' => $label, 'Times' => implode(', ', array_unique($ranges))]));
        }

        return $list;
    }

    /**
     * LocalBusiness (MedicalBusiness) entity from the same NAP data, linked to the site organisation.
     * Called by dorsetdigital/silverstripe-schema-manager for site-wide entities.
     *
     * @param array<int, mixed> $entities
     */
    protected function updateSchemaManagerEntities(array &$entities): void
    {
        if (!class_exists(\DorsetDigital\SchemaManager\Model\Schema\LocalBusinessSchema::class)) {
            return;
        }

        $owner = $this->getOwner();
        if (!$owner->Street || !$owner->City) {
            return;
        }

        $baseURL = rtrim(\SilverStripe\Control\Director::absoluteBaseURL(), '/') . '/';
        $business = \DorsetDigital\SchemaManager\Model\Schema\LocalBusinessSchema::create('main', (string) $owner->Title)
            ->setURL($baseURL)
            ->setParentOrganization(\DorsetDigital\SchemaManager\Control\SchemaIDs::organisation())
            ->setTelephone($this->getPhoneE164() ?: null)
            ->setEmail($owner->Email ?: null)
            ->setDescription($owner->FooterText ?: null)
            ->setAddress(array_filter([
                'streetAddress' => (string) $owner->Street,
                'postalCode' => (string) $owner->PostalCode,
                'addressLocality' => (string) $owner->City,
                'addressRegion' => (string) $owner->Region,
                'addressCountry' => (string) ($owner->CountryCode ?: 'DE'),
            ]));

        $business->update(['@type' => (string) ($owner->BusinessType ?: 'MedicalBusiness')]);

        if ($owner->Latitude && $owner->Longitude) {
            $business->setGeo((float) $owner->Latitude, (float) $owner->Longitude);
        }

        if ($owner->DefaultOGImage()->exists()) {
            $business->setImage($owner->DefaultOGImage()->getAbsoluteURL());
        }

        $specs = [];
        foreach ($owner->OpeningHours()->sort('Sort') as $entry) {
            $spec = $entry->toSchemaSpecification();
            if ($spec !== null) {
                $specs[] = $spec;
            }
        }
        if ($specs) {
            $business->setOpeningHours($specs);
        }

        if ($owner->Fax) {
            $business->update(['faxNumber' => (string) $owner->Fax]);
        }

        if ($owner->RouteURL) {
            $business->update(['hasMap' => (string) $owner->RouteURL]);
        }

        $entities[] = $business;
    }

    public static function localBusinessID(): string
    {
        return \DorsetDigital\SchemaManager\Control\SchemaIDs::forEntity('localbusiness', 'main');
    }
}

<?php

declare(strict_types=1);

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\i18n\i18n;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * Base page: SEO fields and helpers shared by every page type.
 *
 * @property string $MetaTitle
 * @property bool $NoIndex
 * @property int $OGImageID
 * @method Image OGImage()
 */
class Page extends SiteTree
{
    private static string $table_name = 'Page';

    private static array $db = [
        'MetaTitle' => 'Varchar(70)',
        'NoIndex' => 'Boolean',
    ];

    private static array $has_one = [
        'OGImage' => Image::class,
    ];

    private static array $owns = [
        'OGImage',
    ];

    public function fieldLabels($includerelations = true): array
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['MetaTitle'] = _t(self::class . '.MetaTitle', 'Meta-Titel');
        $labels['OGImage'] = _t(self::class . '.OGImage', 'Social-Media-Bild');
        $labels['NoIndex'] = _t(self::class . '.NoIndex', 'Nicht von Suchmaschinen indexieren (noindex)');

        return $labels;
    }

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields): void {
            $fields->addFieldsToTab('Root.SEO', [
                TextField::create('MetaTitle', $this->fieldLabel('MetaTitle'))
                    ->setAttribute('maxlength', '70')
                    ->setDescription(_t(self::class . '.MetaTitleHint', 'Max. 60 Zeichen, Haupt-Keyword vorne. Leer = „Seitentitel – Website-Name“.')),
                UploadField::create('OGImage', $this->fieldLabel('OGImage'))
                    ->setFolderName('SEO')
                    ->setAllowedFileCategories('image/supported')
                    ->setDescription(_t(self::class . '.OGImageHint', '1200 × 630 px. Leer = Standardbild aus den Einstellungen.')),
                CheckboxField::create('NoIndex', $this->fieldLabel('NoIndex')),
            ]);
        });

        return parent::getCMSFields();
    }

    public function getSeoTitle(): string
    {
        if ($this->MetaTitle) {
            return (string) $this->MetaTitle;
        }

        $siteTitle = (string) SiteConfig::current_site_config()->Title;

        return $siteTitle !== '' && $siteTitle !== $this->Title ? $this->Title . ' – ' . $siteTitle : (string) $this->Title;
    }

    public function getSeoDescription(): string
    {
        return (string) $this->MetaDescription;
    }

    public function getSocialImage(): ?Image
    {
        if ($this->OGImage()->exists()) {
            return $this->OGImage();
        }

        $default = SiteConfig::current_site_config()->DefaultOGImage();

        return $default && $default->exists() ? $default : null;
    }

    public function getOGLocale(): string
    {
        return (string) i18n::get_locale();
    }

    public function getIsCareerPage(): bool
    {
        return $this instanceof \App\Pages\CareerPage;
    }

    /**
     * wilr/silverstripe-googlesitemaps hook (invokeWithExtensions, minimum of all results wins):
     * noindex pages are not listed in sitemap.xml.
     */
    public function alterCanIncludeInGoogleSitemap(bool $can): bool
    {
        return $can && !$this->NoIndex;
    }
}

<?php

declare(strict_types=1);

namespace App\Pages;

use DNADesign\Elemental\Models\ElementalArea;
use Page;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataList;

/**
 * Single service. Layout: header hero (first block), main column + sidebar, full-width bottom area.
 *
 * @property string $Teaser
 * @property string $TeaserImageAlt
 * @property string $ServiceType
 * @method Image TeaserImage()
 * @method ElementalArea BottomArea()
 */
class ServicePage extends Page
{
    private static string $table_name = 'App_ServicePage';

    private static string $cms_icon_class = 'font-icon-p-document';

    private static string $singular_name = 'Leistung';

    private static string $plural_name = 'Leistungen';

    private static string $class_description = 'Detailseite einer Pflegeleistung mit Seitenleiste';

    private static bool $can_be_root = false;

    private static $allowed_children = 'none';

    private static array $db = [
        'Teaser' => 'Varchar(200)',
        'TeaserImageAlt' => 'Varchar(255)',
        'ServiceType' => 'Varchar(120)',
    ];

    private static array $has_one = [
        'TeaserImage' => Image::class,
        'BottomArea' => ElementalArea::class,
    ];

    private static array $owns = [
        'TeaserImage',
        'BottomArea',
    ];

    private static array $cascade_duplicates = [
        'BottomArea',
    ];


    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields): void {
            $fields->addFieldsToTab('Root.Teaser', [
                TextareaField::create('Teaser', _t(self::class . '.Teaser', 'Kurzbeschreibung'))
                    ->setRows(2)
                    ->setDescription(_t(self::class . '.TeaserHint', 'Erscheint in der Leistungsübersicht (max. 200 Zeichen).')),
                UploadField::create('TeaserImage', _t(self::class . '.TeaserImage', 'Vorschaubild'))
                    ->setFolderName('Leistungen')
                    ->setAllowedFileCategories('image/supported'),
                TextField::create('TeaserImageAlt', _t(self::class . '.TeaserImageAlt', 'Alternativtext Vorschaubild')),
                TextField::create('ServiceType', _t(self::class . '.ServiceType', 'Leistungsart (Schema.org serviceType)'))
                    ->setDescription(_t(self::class . '.ServiceTypeHint', 'z. B. „Behandlungspflege“. Leer = Seitentitel.')),
            ]);
        });

        return parent::getCMSFields();
    }

    public function getSiblingServices(): DataList
    {
        return ServicePage::get()->filter('ParentID', $this->ParentID)->sort('Sort');
    }

    public function getTeaserImageAltText(): string
    {
        return (string) ($this->TeaserImageAlt ?: $this->Title);
    }
}

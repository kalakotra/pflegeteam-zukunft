<?php

declare(strict_types=1);

namespace App\Extensions\Elements;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Core\Extension;
use SilverStripe\Core\Validation\ValidationResult;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use YouWillLikeIT\Elements\Elements\ElementFaq;

/**
 * FAQ layout: stacked (centered) or intro column on the left with optional image (e.g. service area map).
 *
 * @property string $Layout
 * @property string $SideImageAlt
 * @method Image SideImage()
 * @extends Extension<ElementFaq>
 */
class FaqExtension extends Extension
{
    private static array $db = [
        'Layout' => "Enum('stacked,intro-left','stacked')",
        'SideImageAlt' => 'Varchar(255)',
    ];

    private static array $has_one = [
        'SideImage' => Image::class,
    ];

    private static array $owns = [
        'SideImage',
    ];

    private static array $defaults = [
        'Layout' => 'stacked',
    ];

    protected function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName(['Layout', 'SideImage', 'SideImageAlt']);
        $fields->addFieldsToTab('Root.Settings', [
            DropdownField::create('Layout', _t(self::class . '.Layout', 'Aufteilung'), [
                'stacked' => _t(self::class . '.Stacked', 'Untereinander (zentriert)'),
                'intro-left' => _t(self::class . '.IntroLeft', 'Einleitung links, Fragen rechts'),
            ]),
            UploadField::create('SideImage', _t(self::class . '.SideImage', 'Bild in der Einleitungsspalte'))
                ->setFolderName('Elements/FAQ')
                ->setAllowedFileCategories('image/supported'),
            TextField::create('SideImageAlt', _t(self::class . '.SideImageAlt', 'Alternativtext Bild')),
        ]);
    }

    protected function updateValidate(ValidationResult $result): void
    {
        $owner = $this->getOwner();
        if ((int) $owner->SideImageID > 0 && trim((string) $owner->SideImageAlt) === '') {
            $result->addFieldError('SideImageAlt', _t(self::class . '.AltRequired', 'Bitte einen Alternativtext für das Bild eingeben.'));
        }
    }
}

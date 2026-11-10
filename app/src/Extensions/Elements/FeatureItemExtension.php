<?php

declare(strict_types=1);

namespace App\Extensions\Elements;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use YouWillLikeIT\Elements\Models\FeatureItem;

/**
 * Optional icon per entry (from the theme's icon sprite, Includes/IconSprite.ss).
 *
 * @property string $Icon
 * @extends Extension<FeatureItem>
 */
class FeatureItemExtension extends Extension
{
    /**
     * Icon keys available in the theme sprite → CMS labels.
     */
    public const ICONS = [
        'heart' => 'Herz',
        'hand' => 'Hand / Pflege',
        'pill' => 'Medikament',
        'bandage' => 'Verband',
        'home' => 'Zuhause',
        'cart' => 'Einkauf',
        'users' => 'Menschen',
        'user' => 'Person',
        'chat' => 'Sprechblase',
        'clock' => 'Uhr',
        'calendar' => 'Kalender',
        'euro' => 'Geld',
        'school' => 'Weiterbildung',
        'sun' => 'Urlaub',
        'shield' => 'Schutz',
        'award' => 'Auszeichnung',
        'phone' => 'Telefon',
        'check' => 'Häkchen',
    ];

    private static array $db = [
        'Icon' => 'Varchar(30)',
    ];

    protected function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName('Icon');
        $fields->insertAfter(
            'Text',
            DropdownField::create('Icon', _t(self::class . '.Icon', 'Symbol'), self::ICONS)
                ->setEmptyString(_t(self::class . '.NoIcon', '– kein Symbol –'))
                ->setDescription(_t(self::class . '.IconHint', 'Wird in den Darstellungen „Karten mit Symbol“ genutzt.'))
        );
    }
}

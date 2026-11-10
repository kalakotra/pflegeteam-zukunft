<?php

declare(strict_types=1);

namespace App\Extensions\Elements;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use YouWillLikeIT\Elements\Elements\ElementCallToAction;

/**
 * CTA presentation: boxed (rounded brand-colour panel inside the container) or band (uses the section background).
 *
 * @property string $Variant
 * @extends Extension<ElementCallToAction>
 */
class CallToActionExtension extends Extension
{
    private static array $db = [
        'Variant' => "Enum('boxed,band','boxed')",
    ];

    private static array $defaults = [
        'Variant' => 'boxed',
    ];

    protected function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName('Variant');
        $fields->addFieldToTab('Root.Settings', DropdownField::create('Variant', _t(self::class . '.Variant', 'Darstellung'), [
            'boxed' => _t(self::class . '.Boxed', 'Farbige Box'),
            'band' => _t(self::class . '.Band', 'Band (Hintergrund aus „Hintergrund“)'),
        ]));
    }
}

<?php

declare(strict_types=1);

namespace App\Extensions\Elements;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use YouWillLikeIT\Elements\Elements\ElementTextMedia;

/**
 * Image left or right. Without an image the text is set narrow and centred (intro statements).
 *
 * @property string $ImagePosition
 * @extends Extension<ElementTextMedia>
 */
class TextMediaExtension extends Extension
{
    private static array $db = [
        'ImagePosition' => "Enum('left,right','left')",
    ];

    private static array $defaults = [
        'ImagePosition' => 'left',
    ];

    protected function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName('ImagePosition');
        $fields->addFieldToTab('Root.Settings', DropdownField::create('ImagePosition', _t(self::class . '.ImagePosition', 'Bildposition'), [
            'left' => _t(self::class . '.Left', 'Links'),
            'right' => _t(self::class . '.Right', 'Rechts'),
        ])->setDescription(_t(self::class . '.ImagePositionHint', 'Ohne Bild wird der Text schmal und zentriert gesetzt.')));
    }
}

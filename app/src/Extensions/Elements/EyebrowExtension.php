<?php

declare(strict_types=1);

namespace App\Extensions\Elements;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use YouWillLikeIT\Elements\Elements\ElementBase;

/**
 * Short kicker above the heading, e.g. "Wir stellen ein" (sentence case, accent colour).
 *
 * @property string $Eyebrow
 * @extends Extension<ElementBase>
 */
class EyebrowExtension extends Extension
{
    private static array $db = [
        'Eyebrow' => 'Varchar(80)',
    ];

    protected function updateFieldLabels(array &$labels): void
    {
        $labels['Eyebrow'] = _t(self::class . '.Eyebrow', 'Dachzeile');
    }

    protected function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName('Eyebrow');
        $field = TextField::create('Eyebrow', _t(self::class . '.Eyebrow', 'Dachzeile'))
            ->setDescription(_t(self::class . '.EyebrowHint', 'Kurzes Stichwort über der Überschrift, z. B. „Wir stellen ein“. Optional, sparsam einsetzen.'));

        if ($fields->dataFieldByName('Title')) {
            $fields->insertBefore('Title', $field);
        } else {
            $fields->addFieldToTab('Root.Main', $field);
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Extensions\Elements;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use YouWillLikeIT\Elements\Elements\ElementFeatureGrid;

/**
 * Feature grid as quiet lists separated by hairlines (no cards):
 * - list: one entry per row, linked entries get an arrow (services);
 * - columns: two columns of short entries (benefits).
 * Layout "side" puts heading + intro in a left column, "stacked" above the list.
 *
 * @property string $Variant
 * @property string $Layout
 * @extends Extension<ElementFeatureGrid>
 */
class FeatureGridExtension extends Extension
{
    private static array $db = [
        'Variant' => "Enum('list,columns','list')",
        'Layout' => "Enum('side,stacked','side')",
    ];

    private static array $defaults = [
        'Variant' => 'list',
        'Layout' => 'side',
    ];

    protected function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName(['Variant', 'Layout']);
        $fields->addFieldsToTab('Root.Settings', [
            DropdownField::create('Variant', _t(self::class . '.Variant', 'Darstellung'), [
                'list' => _t(self::class . '.List', 'Liste (ein Eintrag pro Zeile)'),
                'columns' => _t(self::class . '.Columns', 'Zwei Spalten (kurze Einträge)'),
            ]),
            DropdownField::create('Layout', _t(self::class . '.Layout', 'Überschrift'), [
                'side' => _t(self::class . '.Side', 'Links neben der Liste'),
                'stacked' => _t(self::class . '.Stacked', 'Über der Liste'),
            ]),
        ]);
    }
}

<?php

declare(strict_types=1);

namespace App\Extensions\Elements;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use YouWillLikeIT\Elements\Elements\ElementFeatureGrid;

/**
 * Feature grid presentation: image cards (services), icon cards (benefits), steps (process),
 * check list (short facts). Columns apply from the large breakpoint.
 *
 * @property string $Variant
 * @property int $Columns
 * @property string $HeaderAlign
 * @extends Extension<ElementFeatureGrid>
 */
class FeatureGridExtension extends Extension
{
    private static array $db = [
        'Variant' => "Enum('image-cards,icon-cards,steps,check-list','icon-cards')",
        'Columns' => "Enum('2,3,4','3')",
        'HeaderAlign' => "Enum('start,split,center','start')",
    ];

    private static array $defaults = [
        'Variant' => 'icon-cards',
        'Columns' => '3',
        'HeaderAlign' => 'start',
    ];

    protected function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName(['Variant', 'Columns', 'HeaderAlign']);
        $fields->addFieldsToTab('Root.Settings', [
            DropdownField::create('Variant', _t(self::class . '.Variant', 'Darstellung'), [
                'image-cards' => _t(self::class . '.ImageCards', 'Karten mit Bild (Leistungen)'),
                'icon-cards' => _t(self::class . '.IconCards', 'Karten mit Symbol (Vorteile)'),
                'steps' => _t(self::class . '.Steps', 'Nummerierte Schritte (Ablauf)'),
                'check-list' => _t(self::class . '.CheckList', 'Häkchen-Liste'),
            ]),
            DropdownField::create('Columns', _t(self::class . '.Columns', 'Spalten (Desktop)'), ['2' => '2', '3' => '3', '4' => '4']),
            DropdownField::create('HeaderAlign', _t(self::class . '.HeaderAlign', 'Kopfbereich'), [
                'start' => _t(self::class . '.AlignStart', 'Links'),
                'split' => _t(self::class . '.AlignSplit', 'Überschrift links, Einleitung rechts'),
                'center' => _t(self::class . '.AlignCenter', 'Zentriert'),
            ]),
        ]);
    }

    public function getColumnClass(): string
    {
        return match ((string) $this->getOwner()->Columns) {
            '2' => 'row-cols-1 row-cols-md-2',
            '4' => 'row-cols-1 row-cols-sm-2 row-cols-lg-4',
            default => 'row-cols-1 row-cols-md-2 row-cols-lg-3',
        };
    }
}

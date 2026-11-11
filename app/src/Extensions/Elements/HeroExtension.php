<?php

declare(strict_types=1);

namespace App\Extensions\Elements;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use YouWillLikeIT\Elements\Elements\ElementHero;

/**
 * Hero layout:
 * - image: full-width photo with a white text panel overlapping its lower left edge (home, careers);
 * - compact: text left, photo right, no background (subpages).
 *
 * @property string $Variant
 * @property bool $ShowBreadcrumbs
 * @extends Extension<ElementHero>
 */
class HeroExtension extends Extension
{
    private static array $db = [
        'Variant' => "Enum('image,compact','compact')",
        'ShowBreadcrumbs' => 'Boolean',
    ];

    private static array $defaults = [
        'Variant' => 'compact',
        'ShowBreadcrumbs' => true,
    ];

    protected function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName(['Variant', 'ShowBreadcrumbs']);
        $fields->addFieldsToTab('Root.Settings', [
            DropdownField::create('Variant', _t(self::class . '.Variant', 'Darstellung'), [
                'image' => _t(self::class . '.VariantImage', 'Großes Bild mit Textfeld (Startseite, Karriere)'),
                'compact' => _t(self::class . '.VariantCompact', 'Text links, Bild rechts (Unterseiten)'),
            ])->setDescription(_t(self::class . '.VariantHint', '„Großes Bild“ braucht ein Foto im Querformat (mind. 1920 px breit).')),
            CheckboxField::create('ShowBreadcrumbs', _t(self::class . '.ShowBreadcrumbs', 'Brotkrumen-Navigation anzeigen')),
        ]);
    }

    /**
     * The hero renders its own container (full-bleed image variant), see ElementHolder.ss.
     */
    public function getHasOwnContainer(): bool
    {
        return true;
    }
}

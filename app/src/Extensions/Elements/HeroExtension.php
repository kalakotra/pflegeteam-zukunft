<?php

declare(strict_types=1);

namespace App\Extensions\Elements;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\LinkField\Form\LinkField;
use SilverStripe\LinkField\Models\Link;
use SilverStripe\Model\ArrayData;
use SilverStripe\Model\List\ArrayList;
use YouWillLikeIT\Elements\Elements\ElementHero;

/**
 * Hero layout options for this site:
 * - Variant: home (large, trust items, side teaser card), compact (subpages), accent (careers);
 * - TrustItems: short facts under the buttons, one per line;
 * - ShowBreadcrumbs: breadcrumbs above the heading on subpages;
 * - Side teaser: small linked card over the image (e.g. "Wir stellen ein").
 *
 * @property string $Variant
 * @property string $TrustItems
 * @property bool $ShowBreadcrumbs
 * @property string $TeaserBadge
 * @property string $TeaserTitle
 * @property string $TeaserText
 * @method Link TeaserLink()
 * @extends Extension<ElementHero>
 */
class HeroExtension extends Extension
{
    private static array $db = [
        'Variant' => "Enum('home,compact,accent','compact')",
        'TrustItems' => 'Text',
        'ShowBreadcrumbs' => 'Boolean',
        'TeaserBadge' => 'Varchar(40)',
        'TeaserTitle' => 'Varchar(120)',
        'TeaserText' => 'Varchar(160)',
    ];

    private static array $has_one = [
        'TeaserLink' => Link::class,
    ];

    private static array $owns = [
        'TeaserLink',
    ];

    private static array $cascade_deletes = [
        'TeaserLink',
    ];

    private static array $cascade_duplicates = [
        'TeaserLink',
    ];

    private static array $defaults = [
        'Variant' => 'compact',
        'ShowBreadcrumbs' => true,
    ];

    /**
     * Icons for the trust items, in order (cycled).
     */
    private static array $trust_icons = ['award', 'shield', 'chat', 'heart'];

    protected function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName(['Variant', 'TrustItems', 'ShowBreadcrumbs', 'TeaserBadge', 'TeaserTitle', 'TeaserText', 'TeaserLink', 'TeaserLinkID']);

        $fields->addFieldsToTab('Root.Main', [
            TextareaField::create('TrustItems', _t(self::class . '.TrustItems', 'Vertrauensmerkmale'))
                ->setRows(3)
                ->setDescription(_t(self::class . '.TrustItemsHint', 'Ein Merkmal pro Zeile, kurz (z. B. „Vertragspartner aller Kassen“). Nur in der Variante „Startseite“.')),
        ]);

        $fields->addFieldsToTab('Root.Hinweiskarte', [
            TextField::create('TeaserBadge', _t(self::class . '.TeaserBadge', 'Kennzeichnung'))
                ->setDescription(_t(self::class . '.TeaserBadgeHint', 'z. B. „Wir stellen ein“. Karte erscheint nur mit Titel und Link.')),
            TextField::create('TeaserTitle', _t(self::class . '.TeaserTitle', 'Titel')),
            TextField::create('TeaserText', _t(self::class . '.TeaserText', 'Text')),
            LinkField::create('TeaserLink', _t(self::class . '.TeaserLink', 'Link')),
        ]);

        $fields->addFieldsToTab('Root.Settings', [
            DropdownField::create('Variant', _t(self::class . '.Variant', 'Variante'), [
                'home' => _t(self::class . '.VariantHome', 'Startseite (groß, mit Merkmalen)'),
                'compact' => _t(self::class . '.VariantCompact', 'Unterseite (kompakt)'),
                'accent' => _t(self::class . '.VariantAccent', 'Karriere (Akzentfarbe)'),
            ]),
            CheckboxField::create('ShowBreadcrumbs', _t(self::class . '.ShowBreadcrumbs', 'Brotkrumen-Navigation anzeigen')),
        ]);
    }

    public function getTrustItemList(): ArrayList
    {
        $lines = array_values(array_filter(array_map('trim', preg_split('/\R/', (string) $this->getOwner()->TrustItems) ?: [])));
        $icons = (array) $this->getOwner()->config()->get('trust_icons') ?: ['check'];

        $list = ArrayList::create();
        foreach ($lines as $i => $line) {
            $list->push(ArrayData::create(['Text' => $line, 'Icon' => $icons[$i % count($icons)]]));
        }

        return $list;
    }

    public function getHasTeaser(): bool
    {
        $owner = $this->getOwner();

        return trim((string) $owner->TeaserTitle) !== '' && $owner->TeaserLink()->exists();
    }
}

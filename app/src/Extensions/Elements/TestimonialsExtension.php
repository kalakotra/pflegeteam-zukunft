<?php

declare(strict_types=1);

namespace App\Extensions\Elements;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Model\List\SS_List;
use YouWillLikeIT\Elements\Elements\ElementTestimonials;

/**
 * single: one large centred quote (the first entry); stacked: all quotes below each other.
 *
 * @property string $Variant
 * @extends Extension<ElementTestimonials>
 */
class TestimonialsExtension extends Extension
{
    private static array $db = [
        'Variant' => "Enum('single,stacked','single')",
    ];

    private static array $defaults = [
        'Variant' => 'single',
    ];

    protected function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName('Variant');
        $fields->addFieldToTab('Root.Settings', DropdownField::create('Variant', _t(self::class . '.Variant', 'Darstellung'), [
            'single' => _t(self::class . '.Single', 'Ein Zitat, groß (nur der erste Eintrag)'),
            'stacked' => _t(self::class . '.Stacked', 'Alle Zitate untereinander'),
        ]));
    }

    public function getVisibleItems(): SS_List
    {
        $items = $this->getOwner()->getSortedItems();

        return (string) $this->getOwner()->Variant === 'single' ? $items->limit(1) : $items;
    }
}

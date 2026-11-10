<?php

declare(strict_types=1);

namespace App\Extensions\Elements;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\LinkField\Form\LinkField;
use SilverStripe\LinkField\Models\Link;
use SilverStripe\Model\ArrayData;
use SilverStripe\Model\List\ArrayList;
use YouWillLikeIT\Elements\Elements\ElementTextMedia;

/**
 * Text with image, extended by:
 * - ImagePosition left/right;
 * - Chips: short tags under the text (e.g. languages);
 * - Highlight card instead of the image (e.g. quality grade): eyebrow, value, label, detail rows, link.
 *
 * @property string $ImagePosition
 * @property string $Chips
 * @property string $CardEyebrow
 * @property string $CardValue
 * @property string $CardLabel
 * @property string $CardRows
 * @method Link CardLink()
 * @extends Extension<ElementTextMedia>
 */
class TextMediaExtension extends Extension
{
    private static array $db = [
        'ImagePosition' => "Enum('left,right','right')",
        'Chips' => 'Text',
        'CardEyebrow' => 'Varchar(160)',
        'CardValue' => 'Varchar(20)',
        'CardLabel' => 'Varchar(80)',
        'CardRows' => 'Text',
    ];

    private static array $has_one = [
        'CardLink' => Link::class,
    ];

    private static array $owns = [
        'CardLink',
    ];

    private static array $cascade_deletes = [
        'CardLink',
    ];

    private static array $cascade_duplicates = [
        'CardLink',
    ];

    private static array $defaults = [
        'ImagePosition' => 'right',
    ];

    protected function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName(['ImagePosition', 'Chips', 'CardEyebrow', 'CardValue', 'CardLabel', 'CardRows', 'CardLink', 'CardLinkID']);

        $fields->addFieldToTab(
            'Root.Main',
            TextareaField::create('Chips', _t(self::class . '.Chips', 'Schlagworte'))
                ->setRows(3)
                ->setDescription(_t(self::class . '.ChipsHint', 'Eins pro Zeile, z. B. Sprachen. Optional.'))
        );

        $fields->addFieldsToTab('Root.Infokarte', [
            TextField::create('CardEyebrow', _t(self::class . '.CardEyebrow', 'Kopfzeile'))
                ->setDescription(_t(self::class . '.CardHint', 'Die Infokarte ersetzt das Bild, sobald „Wert“ ausgefüllt ist.')),
            TextField::create('CardValue', _t(self::class . '.CardValue', 'Wert (groß)')),
            TextField::create('CardLabel', _t(self::class . '.CardLabel', 'Bezeichnung')),
            TextareaField::create('CardRows', _t(self::class . '.CardRows', 'Detailzeilen'))
                ->setRows(4)
                ->setDescription(_t(self::class . '.CardRowsHint', 'Eine Zeile pro Eintrag: „Bezeichnung | Wert“.')),
            LinkField::create('CardLink', _t(self::class . '.CardLink', 'Link')),
        ]);

        $fields->addFieldToTab('Root.Settings', DropdownField::create('ImagePosition', _t(self::class . '.ImagePosition', 'Bildposition'), [
            'left' => _t(self::class . '.Left', 'Links'),
            'right' => _t(self::class . '.Right', 'Rechts'),
        ]));
    }

    public function getChipList(): ArrayList
    {
        return ArrayList::create(array_map(
            static fn (string $t): ArrayData => ArrayData::create(['Text' => $t]),
            self::lines((string) $this->getOwner()->Chips)
        ));
    }

    public function getHasCard(): bool
    {
        return trim((string) $this->getOwner()->CardValue) !== '';
    }

    public function getCardRowList(): ArrayList
    {
        $list = ArrayList::create();
        foreach (self::lines((string) $this->getOwner()->CardRows) as $line) {
            [$label, $value] = array_map('trim', explode('|', $line, 2)) + [1 => ''];
            $list->push(ArrayData::create(['Label' => $label, 'Value' => $value]));
        }

        return $list;
    }

    /**
     * @return array<int, string>
     */
    private static function lines(string $text): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\R/', $text) ?: [])));
    }
}

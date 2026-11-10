<?php

declare(strict_types=1);

namespace App\Extensions\Elements;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use YouWillLikeIT\Elements\Elements\ElementTestimonials;

/**
 * Short rating summary next to the heading, e.g. "5,0 bei Google".
 *
 * @property string $RatingSummary
 * @extends Extension<ElementTestimonials>
 */
class TestimonialsExtension extends Extension
{
    private static array $db = [
        'RatingSummary' => 'Varchar(60)',
    ];

    protected function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName('RatingSummary');
        $fields->addFieldToTab(
            'Root.Main',
            TextField::create('RatingSummary', _t(self::class . '.RatingSummary', 'Bewertungs-Zusammenfassung'))
                ->setDescription(_t(self::class . '.RatingSummaryHint', 'z. B. „5,0 bei Google“. Nur mit belegbarer Quelle.'))
        );
    }
}

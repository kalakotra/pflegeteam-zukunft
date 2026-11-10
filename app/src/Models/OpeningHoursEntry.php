<?php

declare(strict_types=1);

namespace App\Models;

use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * One opening-hours range. Several ranges may share a label (e.g. Friday morning + afternoon).
 *
 * @property string $Label
 * @property string $Days
 * @property string $Opens
 * @property string $Closes
 * @property bool $Closed
 * @property int $Sort
 * @method SiteConfig SiteConfig()
 */
class OpeningHoursEntry extends DataObject
{
    private static string $table_name = 'App_OpeningHoursEntry';

    private static string $singular_name = 'Öffnungszeit';

    private static string $plural_name = 'Öffnungszeiten';

    private static array $db = [
        'Label' => 'Varchar(40)',
        'Days' => "MultiEnum('Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday')",
        'Opens' => 'Time',
        'Closes' => 'Time',
        'Closed' => 'Boolean',
        'Sort' => 'Int',
    ];

    private static array $has_one = [
        'SiteConfig' => SiteConfig::class,
    ];

    private static string $default_sort = 'Sort ASC';

    private static array $summary_fields = [
        'Label' => 'Tage',
        'TimeRange' => 'Zeit',
    ];

    private const DAY_LABELS = [
        'Monday' => 'Montag',
        'Tuesday' => 'Dienstag',
        'Wednesday' => 'Mittwoch',
        'Thursday' => 'Donnerstag',
        'Friday' => 'Freitag',
        'Saturday' => 'Samstag',
        'Sunday' => 'Sonntag',
    ];

    public function getCMSFields(): FieldList
    {
        $fields = parent::getCMSFields();
        $fields->removeByName(['SiteConfigID', 'Sort']);
        $fields->dataFieldByName('Label')?->setDescription(_t(self::class . '.LabelHint', 'Anzeige, z. B. „Mo–Fr“. Gleiche Bezeichnung = eine Zeile mit mehreren Zeiten.'));
        $fields->replaceField('Days', CheckboxSetField::create('Days', _t(self::class . '.Days', 'Wochentage (für Schema.org)'), self::DAY_LABELS));
        $fields->dataFieldByName('Closed')?->setTitle(_t(self::class . '.Closed', 'Geschlossen'));

        return $fields;
    }

    public function getTitle(): string
    {
        return trim($this->Label . ' ' . $this->getTimeRange());
    }

    public function getTimeRange(): string
    {
        if ($this->Closed) {
            return _t(self::class . '.ClosedLabel', 'geschlossen');
        }

        return substr((string) $this->Opens, 0, 5) . '–' . substr((string) $this->Closes, 0, 5);
    }

    /**
     * @return array<string, mixed>|null Schema.org OpeningHoursSpecification
     */
    public function toSchemaSpecification(): ?array
    {
        $days = array_values(array_filter(explode(',', (string) $this->Days)));
        if ($this->Closed || !$days || !$this->Opens || !$this->Closes) {
            return null;
        }

        return [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => array_map(static fn (string $d): string => 'https://schema.org/' . $d, $days),
            'opens' => substr((string) $this->Opens, 0, 5),
            'closes' => substr((string) $this->Closes, 0, 5),
        ];
    }

    public function canView($member = null): bool
    {
        return true;
    }

    public function canEdit($member = null): bool
    {
        return Permission::checkMember($member, 'EDIT_SITECONFIG');
    }

    public function canDelete($member = null): bool
    {
        return $this->canEdit($member);
    }

    public function canCreate($member = null, $context = []): bool
    {
        return Permission::checkMember($member, 'EDIT_SITECONFIG');
    }
}

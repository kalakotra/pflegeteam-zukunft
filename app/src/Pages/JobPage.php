<?php

declare(strict_types=1);

namespace App\Pages;

use Page;
use SilverStripe\Core\Validation\ValidationResult;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Model\ArrayData;
use SilverStripe\Model\List\ArrayList;
use SilverStripe\ORM\DataList;

/**
 * One job posting (child of CareerPage). Provides JobPosting structured data (PageSchemaExtension).
 * Layout: header hero, job description + blocks in the main column, key facts + apply box in the sidebar.
 *
 * @property string $Teaser
 * @property string $EmploymentTypes
 * @property string $Location
 * @property string $StartLabel
 * @property string $Qualification
 * @property string $JobDescription
 * @property string $DatePosted
 * @property string $ValidThrough
 * @property float $SalaryMin
 * @property float $SalaryMax
 * @property string $SalaryUnit
 * @method CareerPage Parent()
 */
class JobPage extends Page
{
    private static string $table_name = 'App_JobPage';

    private static string $cms_icon_class = 'font-icon-p-document';

    private static string $singular_name = 'Stellenangebot';

    private static string $plural_name = 'Stellenangebote';

    private static string $class_description = 'Einzelnes Stellenangebot (Google for Jobs: JobPosting)';

    private static bool $can_be_root = false;

    private static $allowed_children = 'none';

    private const EMPLOYMENT_TYPES = [
        'FULL_TIME' => 'Vollzeit',
        'PART_TIME' => 'Teilzeit',
        'PER_DIEM' => 'Minijob / Aushilfe',
        'TEMPORARY' => 'Befristet',
        'INTERN' => 'Ausbildung / Praktikum',
    ];

    private static array $db = [
        'Teaser' => 'Varchar(200)',
        'EmploymentTypes' => "MultiEnum('FULL_TIME,PART_TIME,PER_DIEM,TEMPORARY,INTERN','FULL_TIME,PART_TIME')",
        'Location' => 'Varchar(120)',
        'StartLabel' => 'Varchar(60)',
        'Qualification' => 'Varchar(200)',
        'JobDescription' => 'HTMLText',
        'DatePosted' => 'Date',
        'ValidThrough' => 'Date',
        'SalaryMin' => 'Decimal(9,2)',
        'SalaryMax' => 'Decimal(9,2)',
        'SalaryUnit' => "Enum('HOUR,MONTH,YEAR','MONTH')",
    ];

    private static array $defaults = [
        'StartLabel' => 'ab sofort',
        'SalaryUnit' => 'MONTH',
    ];

    public function fieldLabels($includerelations = true): array
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['Teaser'] = _t(self::class . '.Teaser', 'Kurzbeschreibung');
        $labels['EmploymentTypes'] = _t(self::class . '.EmploymentTypes', 'Arbeitszeit');
        $labels['Location'] = _t(self::class . '.Location', 'Einsatzort');
        $labels['StartLabel'] = _t(self::class . '.StartLabel', 'Beginn');
        $labels['Qualification'] = _t(self::class . '.Qualification', 'Qualifikation');
        $labels['JobDescription'] = _t(self::class . '.JobDescription', 'Stellenbeschreibung');
        $labels['DatePosted'] = _t(self::class . '.DatePosted', 'Veröffentlicht am');
        $labels['ValidThrough'] = _t(self::class . '.ValidThrough', 'Gültig bis');
        $labels['SalaryMin'] = _t(self::class . '.SalaryMin', 'Gehalt von (€)');
        $labels['SalaryMax'] = _t(self::class . '.SalaryMax', 'Gehalt bis (€)');
        $labels['SalaryUnit'] = _t(self::class . '.SalaryUnit', 'Gehalt pro');

        return $labels;
    }

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields): void {
            $fields->removeByName(['Teaser', 'EmploymentTypes', 'Location', 'StartLabel', 'Qualification', 'JobDescription', 'DatePosted', 'ValidThrough', 'SalaryMin', 'SalaryMax', 'SalaryUnit']);
            $fields->addFieldsToTab('Root.Stelle', [
                TextareaField::create('Teaser', $this->fieldLabel('Teaser'))
                    ->setRows(2)
                    ->setDescription(_t(self::class . '.TeaserHint', 'Erscheint in der Stellenliste (max. 200 Zeichen).')),
                CheckboxSetField::create('EmploymentTypes', $this->fieldLabel('EmploymentTypes'), $this->employmentTypeLabels()),
                TextField::create('Location', $this->fieldLabel('Location'))
                    ->setDescription(_t(self::class . '.LocationHint', 'z. B. „Hamburg-Hamm“. Die Adresse für Google kommt aus den Einstellungen.')),
                TextField::create('StartLabel', $this->fieldLabel('StartLabel')),
                TextField::create('Qualification', $this->fieldLabel('Qualification')),
                HTMLEditorField::create('JobDescription', $this->fieldLabel('JobDescription'))
                    ->setRows(18)
                    ->setDescription(_t(self::class . '.JobDescriptionHint', 'Aufgaben, Profil, Angebot. Wird vollständig an Google for Jobs übergeben.')),
                DateField::create('DatePosted', $this->fieldLabel('DatePosted')),
                DateField::create('ValidThrough', $this->fieldLabel('ValidThrough'))
                    ->setDescription(_t(self::class . '.ValidThroughHint', 'Leer = unbefristet ausgeschrieben.')),
                NumericField::create('SalaryMin', $this->fieldLabel('SalaryMin'))->setScale(2),
                NumericField::create('SalaryMax', $this->fieldLabel('SalaryMax'))->setScale(2),
                DropdownField::create('SalaryUnit', $this->fieldLabel('SalaryUnit'), [
                    'HOUR' => _t(self::class . '.Hour', 'Stunde'),
                    'MONTH' => _t(self::class . '.Month', 'Monat'),
                    'YEAR' => _t(self::class . '.Year', 'Jahr'),
                ]),
            ]);
        });

        return parent::getCMSFields();
    }

    public function validate(): ValidationResult
    {
        $result = parent::validate();
        if ($this->SalaryMin && $this->SalaryMax && (float) $this->SalaryMax < (float) $this->SalaryMin) {
            $result->addFieldError('SalaryMax', _t(self::class . '.SalaryRange', '„Gehalt bis“ muss größer sein als „Gehalt von“.'));
        }

        return $result;
    }

    protected function onBeforeWrite(): void
    {
        parent::onBeforeWrite();
        if (!$this->DatePosted) {
            $this->DatePosted = date('Y-m-d');
        }
    }

    /**
     * @return array<string, string>
     */
    public function employmentTypeLabels(): array
    {
        $labels = [];
        foreach (self::EMPLOYMENT_TYPES as $key => $label) {
            $labels[$key] = _t(self::class . '.Type_' . $key, $label);
        }

        return $labels;
    }

    /**
     * @return array<int, string> schema.org employmentType values
     */
    public function getEmploymentTypeList(): array
    {
        return array_values(array_filter(explode(',', (string) $this->EmploymentTypes)));
    }

    public function getEmploymentLabel(): string
    {
        $labels = $this->employmentTypeLabels();

        return implode(' / ', array_map(static fn (string $t): string => $labels[$t] ?? $t, $this->getEmploymentTypeList()));
    }

    /**
     * Key facts for list cards and sidebar.
     */
    public function getFacts(): ArrayList
    {
        $facts = [
            ['Key' => 'clock', 'Label' => _t(self::class . '.FactTime', 'Arbeitszeit'), 'Value' => $this->getEmploymentLabel()],
            ['Key' => 'map', 'Label' => _t(self::class . '.FactPlace', 'Einsatzort'), 'Value' => (string) $this->Location],
            ['Key' => 'calendar', 'Label' => _t(self::class . '.FactStart', 'Beginn'), 'Value' => (string) $this->StartLabel],
            ['Key' => 'award', 'Label' => _t(self::class . '.FactQualification', 'Qualifikation'), 'Value' => (string) $this->Qualification],
        ];

        return ArrayList::create(array_map(
            static fn (array $f): ArrayData => ArrayData::create($f),
            array_values(array_filter($facts, static fn (array $f): bool => trim($f['Value']) !== ''))
        ));
    }

    public function getSiblingJobs(): DataList
    {
        return self::get()->filter('ParentID', $this->ParentID)->exclude('ID', $this->ID)->sort('Sort');
    }

    public function getApplyLink(): string
    {
        $parent = $this->Parent();

        return $parent instanceof CareerPage ? $parent->getApplyLink() : '';
    }
}

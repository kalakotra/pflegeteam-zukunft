<?php

declare(strict_types=1);

namespace App\Pages;

use DNADesign\Elemental\Models\ElementalArea;
use Page;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Core\Validation\ValidationResult;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Model\ArrayData;
use SilverStripe\Model\List\ArrayList;
use SilverStripe\ORM\DataList;

/**
 * Careers: header hero, blocks (benefits, job list, …), application section (form area + contact aside),
 * bottom area (FAQ). Child pages are the individual job postings.
 *
 * @property string $ApplyAsideTitle
 * @property string $ApplyAsideText
 * @property string $ApplySteps
 * @property string $ContactImageAlt
 * @method Image ContactImage()
 * @method ElementalArea ApplicationArea()
 * @method ElementalArea BottomArea()
 */
class CareerPage extends Page
{
    private static string $table_name = 'App_CareerPage';

    private static string $cms_icon_class = 'font-icon-torsos-all';

    private static string $singular_name = 'Karriereseite';

    private static string $plural_name = 'Karriereseiten';

    private static string $class_description = 'Stellenangebote mit Bewerbungsformular und Kontakt-Seitenleiste';

    private static array $allowed_children = [
        JobPage::class,
    ];

    private static string $default_child = JobPage::class;

    /**
     * Anchor of the application section; job pages link to it.
     */
    public const APPLY_ANCHOR = 'bewerben';

    private static array $db = [
        'ApplyAsideTitle' => 'Varchar(120)',
        'ApplyAsideText' => 'Text',
        'ApplySteps' => 'Text',
        'ContactImageAlt' => 'Varchar(255)',
    ];

    private static array $has_one = [
        'ContactImage' => Image::class,
        'ApplicationArea' => ElementalArea::class,
        'BottomArea' => ElementalArea::class,
    ];

    private static array $owns = [
        'ContactImage',
        'ApplicationArea',
        'BottomArea',
    ];

    private static array $cascade_duplicates = [
        'ApplicationArea',
        'BottomArea',
    ];

    public function fieldLabels($includerelations = true): array
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['ApplyAsideTitle'] = _t(self::class . '.ApplyAsideTitle', 'Überschrift Seitenleiste');
        $labels['ApplyAsideText'] = _t(self::class . '.ApplyAsideText', 'Text Seitenleiste');
        $labels['ApplySteps'] = _t(self::class . '.ApplySteps', 'Ablauf der Bewerbung');
        $labels['ContactImage'] = _t(self::class . '.ContactImage', 'Foto Ansprechperson');
        $labels['ContactImageAlt'] = _t(self::class . '.ContactImageAlt', 'Alternativtext Foto');

        return $labels;
    }

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields): void {
            $fields->addFieldsToTab('Root.Bewerbung', [
                TextField::create('ApplyAsideTitle', $this->fieldLabel('ApplyAsideTitle')),
                TextareaField::create('ApplyAsideText', $this->fieldLabel('ApplyAsideText'))->setRows(3),
                TextareaField::create('ApplySteps', $this->fieldLabel('ApplySteps'))
                    ->setRows(4)
                    ->setDescription(_t(self::class . '.ApplyStepsHint', 'Ein Schritt pro Zeile.')),
                UploadField::create('ContactImage', $this->fieldLabel('ContactImage'))
                    ->setFolderName('Karriere')
                    ->setAllowedFileCategories('image/supported'),
                TextField::create('ContactImageAlt', $this->fieldLabel('ContactImageAlt')),
            ]);
        });

        return parent::getCMSFields();
    }

    public function validate(): ValidationResult
    {
        $result = parent::validate();
        if ((int) $this->ContactImageID > 0 && trim((string) $this->ContactImageAlt) === '') {
            $result->addFieldError('ContactImageAlt', _t(self::class . '.AltRequired', 'Bitte einen Alternativtext für das Foto eingeben.'));
        }

        return $result;
    }

    public function getJobs(): DataList
    {
        return JobPage::get()->filter('ParentID', $this->ID)->sort('Sort');
    }

    public function getApplyStepList(): ArrayList
    {
        $lines = array_values(array_filter(array_map('trim', preg_split('/\R/', (string) $this->ApplySteps) ?: [])));

        return ArrayList::create(array_map(static fn (string $line): ArrayData => ArrayData::create(['Text' => $line]), $lines));
    }

    public function getApplyLink(): string
    {
        return $this->Link() . '#' . self::APPLY_ANCHOR;
    }

    public function getApplyAnchor(): string
    {
        return self::APPLY_ANCHOR;
    }
}

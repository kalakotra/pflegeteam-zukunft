<?php

declare(strict_types=1);

namespace App\Elements;

use App\Pages\CareerPage;
use App\Pages\JobPage;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\DataList;
use YouWillLikeIT\Elements\Elements\ElementBase;

/**
 * Lists the job postings (JobPage children) of a career page. Without a chosen career page the
 * first one is used. Each JobPage provides its own JobPosting structured data.
 *
 * @property string $Intro
 * @property string $Eyebrow
 * @property int $CareerPageID
 * @method CareerPage CareerPage()
 */
class ElementJobList extends ElementBase
{
    private static string $table_name = 'App_ElementJobList';

    private static string $icon = 'font-icon-torsos-all';

    private static string $singular_name = 'Stellenliste';

    private static string $plural_name = 'Stellenlisten';

    private static string $class_description = 'Listet die Stellenangebote einer Karriereseite';

    private static bool $has_cta_links = false;

    private static string $anchor_name = 'offene-stellen';

    private static array $db = [
        'Eyebrow' => 'Varchar(80)',
        'Intro' => 'Text',
    ];

    private static array $has_one = [
        'CareerPage' => CareerPage::class,
    ];

    public function fieldLabels($includerelations = true): array
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['Eyebrow'] = _t(self::class . '.Eyebrow', 'Dachzeile');
        $labels['Intro'] = _t(self::class . '.Intro', 'Einleitung');
        $labels['CareerPage'] = _t(self::class . '.CareerPage', 'Karriereseite');
        $labels['CareerPageID'] = $labels['CareerPage'];

        return $labels;
    }

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields): void {
            $fields->removeByName(['CareerPageID']);
            $fields->replaceField('Intro', TextareaField::create('Intro', $this->fieldLabel('Intro'))->setRows(2));
            $fields->insertBefore('Title', $fields->dataFieldByName('Eyebrow'));
            $fields->addFieldToTab(
                'Root.Main',
                DropdownField::create('CareerPageID', $this->fieldLabel('CareerPage'), CareerPage::get()->map('ID', 'Title'))
                    ->setEmptyString(_t(self::class . '.FirstCareerPage', '– erste Karriereseite –'))
                    ->setDescription(_t(self::class . '.CareerPageHint', 'Neue Stellen legen Sie als Unterseite der Karriereseite an.'))
            );
        });

        return parent::getCMSFields();
    }

    public function getSourcePage(): ?CareerPage
    {
        $page = $this->CareerPage();
        if ($page && $page->exists()) {
            return $page;
        }

        return CareerPage::get()->first();
    }

    /**
     * @return DataList<JobPage>
     */
    public function getJobs(): DataList
    {
        $source = $this->getSourcePage();

        return $source ? $source->getJobs() : JobPage::get()->filter('ID', 0);
    }

    /**
     * Stable anchor "#offene-stellen" for buttons linking to the list.
     */
    public function getAnchorTitle(): string
    {
        return (string) $this->config()->get('anchor_name');
    }

    public function getSummary(): string
    {
        return _t(self::class . '.Summary', '{count} Stellen', ['count' => $this->getJobs()->count()]);
    }
}

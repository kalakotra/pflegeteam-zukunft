<?php

declare(strict_types=1);

namespace App\Extensions;

use App\Pages\JobPage;
use App\Pages\ServicePage;
use DorsetDigital\SchemaManager\Control\SchemaIDs;
use DorsetDigital\SchemaManager\Model\Schema\JobPostingSchema;
use DorsetDigital\SchemaManager\Model\Schema\ServiceSchema;
use DorsetDigital\SchemaManager\Model\Schema\WebPageSchema;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Extension;
use SilverStripe\i18n\i18n;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * Page-level structured data, added to the schema-manager graph:
 * - WebPage: inLanguage from the current locale;
 * - ServicePage: Service provided by the LocalBusiness (main entity of the page);
 * - JobPage: JobPosting (Google for Jobs), hiring organisation = site organisation.
 *
 * @extends Extension<SiteTree>
 */
class PageSchemaExtension extends Extension
{
    /**
     * @param array<int, mixed> $entities
     */
    protected function updateSchemaManagerEntities(array &$entities): void
    {
        $page = $this->getOwner();
        $language = str_replace('_', '-', (string) i18n::get_locale());

        foreach ($entities as $entity) {
            if ($entity instanceof WebPageSchema) {
                $entity->update(['inLanguage' => $language]);
            }
        }

        $config = SiteConfig::current_site_config();

        if ($page instanceof ServicePage) {
            $url = $page->AbsoluteLink();
            $service = ServiceSchema::create('page-' . $page->ID, (string) $page->Title, $page->MetaDescription ?: ($page->Teaser ?: null))
                ->setURL($url)
                ->setProvider(SiteConfigExtension::localBusinessID())
                ->setMainEntityOfPage($url);

            $service->update(['serviceType' => (string) ($page->ServiceType ?: $page->Title)]);
            if ($config->City) {
                $service->setAreaServed((string) $config->City);
            }
            if ($page->TeaserImage()->exists()) {
                $service->update(['image' => $page->TeaserImage()->getAbsoluteURL()]);
            }

            $entities[] = $service;
        }

        if ($page instanceof JobPage && trim(strip_tags((string) $page->JobDescription)) !== '') {
            $url = $page->AbsoluteLink();
            $job = JobPostingSchema::create('page-' . $page->ID, (string) $page->Title, (string) $page->JobDescription)
                ->setURL($url)
                ->setHiringOrganization(SchemaIDs::organisation())
                ->setDatePosted($page->DatePosted ?: null)
                ->setValidThrough($page->ValidThrough ?: null)
                ->setEmploymentType($page->getEmploymentTypeList() ?: null)
                ->setJobLocation(
                    $config->City ?: null,
                    $config->Region ?: null,
                    $config->CountryCode ?: 'DE',
                    $config->Street ?: null,
                    $config->PostalCode ?: null
                )
                ->setMainEntityOfPage($url);

            if ((float) $page->SalaryMin > 0 && (float) $page->SalaryMax > 0) {
                $job->setBaseSalaryRange((float) $page->SalaryMin, (float) $page->SalaryMax, 'EUR', (string) $page->SalaryUnit);
            } elseif ((float) $page->SalaryMin > 0) {
                $job->setBaseSalary((float) $page->SalaryMin, 'EUR', (string) $page->SalaryUnit);
            }

            $entities[] = $job;
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Pages;

use Page;
use SilverStripe\ORM\DataList;

/**
 * Overview of services. Child ServicePages are listed automatically as image cards
 * between the header hero and the remaining blocks.
 */
class ServiceHolderPage extends Page
{
    private static string $table_name = 'App_ServiceHolderPage';

    private static string $cms_icon_class = 'font-icon-p-list';

    private static string $singular_name = 'Leistungsübersicht';

    private static string $plural_name = 'Leistungsübersichten';

    private static string $class_description = 'Listet alle Leistungsseiten als Karten auf';

    private static array $allowed_children = [
        ServicePage::class,
    ];

    private static string $default_child = ServicePage::class;

    public function getServices(): DataList
    {
        return ServicePage::get()->filter('ParentID', $this->ID)->sort('Sort');
    }
}

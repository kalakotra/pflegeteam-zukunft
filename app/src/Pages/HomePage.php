<?php

declare(strict_types=1);

namespace App\Pages;

use Page;

/**
 * Start page: blocks only, no breadcrumbs.
 */
class HomePage extends Page
{
    private static string $table_name = 'App_HomePage';

    private static string $cms_icon_class = 'font-icon-p-home';

    private static string $singular_name = 'Startseite';

    private static string $plural_name = 'Startseiten';

    private static string $class_description = 'Startseite der Website (nur einmal verwenden)';

    private static bool $can_be_root = true;

    public function canCreate($member = null, $context = []): bool
    {
        return !self::get()->exists() && parent::canCreate($member, $context);
    }
}

<?php

declare(strict_types=1);

namespace App\Pages;

use Page;

/**
 * Contact: header hero, contact details from SiteConfig (left), form block(s) (right).
 */
class ContactPage extends Page
{
    private static string $table_name = 'App_ContactPage';

    private static string $cms_icon_class = 'font-icon-p-mail';

    private static string $singular_name = 'Kontaktseite';

    private static string $plural_name = 'Kontaktseiten';

    private static string $class_description = 'Kontaktdaten aus den Einstellungen plus Formular-Block';

    private static $allowed_children = 'none';
}

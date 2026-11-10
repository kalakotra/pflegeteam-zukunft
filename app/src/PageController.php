<?php

declare(strict_types=1);

use App\Pages\CareerPage;
use App\Pages\ContactPage;
use DNADesign\Elemental\Controllers\ElementController;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Model\List\ArrayList;
use YouWillLikeIT\Elements\Elements\ElementHero;

/**
 * @template T of Page
 * @extends ContentController<T>
 */
class PageController extends ContentController
{
    /**
     * First block of the main area when it is a hero; rendered full width above column layouts.
     */
    public function HeaderElement(): ?ElementController
    {
        $area = $this->data()->hasMethod('ElementalArea') ? $this->data()->ElementalArea() : null;
        if (!$area || !$area->exists()) {
            return null;
        }

        $first = $area->ElementControllers()->first();

        return $first && $first->getElement() instanceof ElementHero ? $first : null;
    }

    /**
     * Main-area blocks without the header hero (for column layouts).
     */
    public function MainElements(): ArrayList
    {
        $list = ArrayList::create();
        $area = $this->data()->hasMethod('ElementalArea') ? $this->data()->ElementalArea() : null;
        if (!$area || !$area->exists()) {
            return $list;
        }

        $header = $this->HeaderElement();
        $headerID = $header ? (int) $header->getElement()->ID : 0;

        foreach ($area->ElementControllers() as $controller) {
            if ((int) $controller->getElement()->ID !== $headerID) {
                $list->push($controller);
            }
        }

        return $list;
    }

    public function ContactPage(): ?ContactPage
    {
        return ContactPage::get()->first();
    }

    public function CareerPage(): ?CareerPage
    {
        return CareerPage::get()->first();
    }
}

<?php

namespace App\Services\MenuBuilder;

abstract class BaseMenu
{
    /**
     * @return MenuItem[]
     */
    abstract public function menuItems(): array;

    /**
     * @return MenuItem[]
     */
    public function get(): array
    {
        $grantedItems = [];

        foreach ($this->menuItems() as $item) {
            if ($item->isGranted() && (!$item->hasChildren() || $item->isAtLeastOneChildrenGranted())) {
                $grantedItems[] = $item->filterGrantedChildren();
            }
        }

        return $grantedItems;
    }
}

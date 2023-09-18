<?php

namespace App\View\Components;

use App\Services\MenuBuilder\SidebarMenu;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarMenuTree extends Component
{
    private SidebarMenu $sidebarMenu;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->sidebarMenu = app(SidebarMenu::class);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|\Closure|string
    {
        return view('components.sidebar-menu-tree', [
            'menu' => $this->sidebarMenu->get(),
        ]);
    }
}

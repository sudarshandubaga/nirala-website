<?php

namespace App\View\Components;

use App\Models\AdminMenu;
use Illuminate\View\Component;

class SideMenubar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $adminMenus = AdminMenu::with('children')->whereNull('admin_menu_id')->whereRaw('FIND_IN_SET("' . auth()->user()->role . '", role)')->oldest()->get();

        return view('components.side-menubar', compact('adminMenus'));
    }
}

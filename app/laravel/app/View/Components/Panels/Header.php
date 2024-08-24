<?php

namespace App\View\Components\Panels;

use Illuminate\View\Component;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\User;


class Header extends Component
{
    // public $user;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        // $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // $screen_ids = ScreenRole::joinRoles($this->user->roles()->select('roles.*'))
        //     ->pluck('screen_id');

        // $menu_items = MenuItem::joinMenu(Menu::byMenuKey('header.menu')->enabled())
        //     ->byScreenIds($screen_ids)
        //     ->enabled()
        //     ->displayOrder()
        //     ->select('menu_items.*')
        //     ->get();

//        return view('components.panels.header', compact('menu_items'));
        return view('components.panels.header');
    }
}

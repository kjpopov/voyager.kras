<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Menu;
use App\MyMenuItem;


class KrasMenuItemsSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */

    public function run()
    {
        $menu = Menu::where('name', 'main')->firstOrFail();

        $menuItem = MyMenuItem::CreateMenuItem(
            [
                'menu_id' => $menu->id,
                'title'   => 'Home',
            ]
        );
        $menuItem = MyMenuItem::CreateMenuItem(
            [
                'menu_id' => $menu->id,
                'title'   => 'Contacts',
            ]
        );
        $menuItem = MyMenuItem::CreateMenuItem(
            [
                'menu_id' => $menu->id,
                'title'   => 'Categories',
            ]
        );
        MyMenuItem::CreateMenuItem(
            [
                'menu_id' => $menu->id,
                'title'   => 'Subcategorie 1',
                'parent_id'  => $menuItem->id,

            ]
        );
        MyMenuItem::CreateMenuItem(
            [
                'menu_id' => $menu->id,
                'title'   => 'Subcategorie 2',
                'parent_id'  => $menuItem->id,
                'order'      => 1,
            ]
        );
    }
}

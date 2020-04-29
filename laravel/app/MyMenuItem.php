<?php

namespace App;

use TCG\Voyager\Models\MenuItem;

class MyMenuItem extends MenuItem
{

    public static function CreateMenuItem($attr = null)
    {
        $default_attr = [
            'menu_id' => '2',
            'title'   => 'Testmain',
            'url'     => '',
            'route'   => '/',
            'target'     => '_self',
            'icon_class' => 'voyager-boat',
            'color'      => null,
            'parent_id'  => null,
            'order'      => 1,
        ];
        $attr = array_replace_recursive($default_attr, $attr);

        $menuItem = MenuItem::firstOrNew($attr);
        if (!$menuItem->exists) {
            $menuItem->fill($attr)->save();
        }

        return $menuItem;
    }
}

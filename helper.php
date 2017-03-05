<?php

    const PRENOT_DACONFERMARE = 0;
    const PRENOT_CONFERMATA = 1;
    const PRENOT_ORIG_WEB = 1;

    const OPT_TYPE_TEXT = 'TEXT';
    const OPT_TYPE_LONG_TEXT = 'LTEXT';
    const OPT_TYPE_TOGGLE = 'TOGGLE';


    const MONTHS = [
        'Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'
    ];

    function get_option($slug, $default = null)
    {
        $option = App\Option::whereSlug($slug)->first(['value']);
        if($option)
            return $option->value;

        return $default;

    }

    function save_option($slug, $value, $name = null, $type = OPT_TYPE_TEXT)
    {
        $option = App\Option::firstOrNew(['slug' => $slug]);
        dd($option->toArray());
        $option->value = $value;
        if(!$option->exists) {
            $option->name = $name;
            $option->type = $type;
        }
        return $option->save();
    }

    function halex_url($url = null)
    {
        return "http://www.halex.it/$url";
    }

    function loadMenu(App\Menu $parentMenu = null)
    {
        if($parentMenu)
            $menu = $parentMenu->submenus()->get();
        else
            $menu = \App\Menu::whereParent(0)->whereLang(\App::getLocale())->get();

        if($parentMenu)
            echo "<ul>";
        else
            echo '<ul class="nav sf-menu">';

        foreach($menu as $item) {

            echo "<li><a href=\"{$item->url}\">{$item->titolo}</a>";
            if($item->submenus()->count())
                loadMenu($item);
            echo "</li>";

        }

        echo '</ul>';

    }
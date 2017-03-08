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
        return "https://www.halex.it/$url";
    }

    function loadMenu(App\Menu $parentMenu = null)
    {

        if($parentMenu)
            $menu = $parentMenu->submenus();
        else
            $menu = \App\Menu::whereParent(0)->whereLang(\App::getLocale());

        $menu = $menu->orderBy('position')->get();

        if($parentMenu)
            echo "<ul>";
        else
            echo '<ul class="nav sf-menu">';

        foreach($menu as $item) {

            echo "<li".($item->url == '/'.\Request::path() ? ' class="active"' : '')."><a href=\"".url($item->url)."\">{$item->titolo}</a>";
            if($item->submenus()->count())
                loadMenu($item);
            echo "</li>";

        }

        echo '</ul>';

    }

    function promoVenereSPA($id = null)
    {
        $service_url = 'http://www.venerespa.it/api/promo.asp'.($id ? '?idpromo='.$id : '');
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, 'utf-8');
        $curl_response = curl_exec($curl);
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        curl_close($curl);


        $decoded = json_decode(utf8_encode($curl_response), true);
        if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
            die('error occured: ' . $decoded->response->errormessage);
        }


        return $decoded;
    }

    function getLocale()
    {
        $locale = \Request::segment(1);

        if(!in_array($locale, \App\Locale::pluck('code')->toArray())) $locale = '';

        return $locale;

    }
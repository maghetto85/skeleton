<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('testi', function() {

    $files = \File::allFiles(resource_path('views'));

    $lista = [];

    foreach($files as $file) {
        $data = \File::get($file);

        preg_match_all("/__\([\'\"].*[\'\"]\)/", $data, $results);

        if(count($results) > 1) dd($results);

        foreach($results[0] as $result) {

            if(!$result) continue;

            /*$res = preg_replace("/__\([\'\"]/", "", $result);
            $res = preg_replace("/[\'\"]\)/", "", $res);*/
            dump($result);
            $res = substr($result,4, strlen($result)-6);
            $lista[$res]= $res;
        }
    }

    \File::put(resource_path('lang/it.json'), json_encode($lista, JSON_PRETTY_PRINT));




});
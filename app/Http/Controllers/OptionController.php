<?php

namespace App\Http\Controllers;

use App\AdminMenu;
use App\HomeFoto;
use App\Option;
use App\OptionGroup;
use App\Room;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Option::where('slug','like','paypal%')->update(['option_group_id' => 2]);

        $groups = OptionGroup::with('options')->orderBy('name')->get();

        if(Option::whereOptionGroupId(null)->count()) {
            $altre = new OptionGroup(['name' => 'Altre Opzioni']);
            $altre->options = Option::whereOptionGroupId(null)->get();
            $groups = $groups->add($altre);
        }

        return view('options', compact('groups'));
    }

    public function save()
    {
        $options = request()->except('_token');

        \DB::beginTransaction();

        foreach($options as $option) {

            Option::find($option['id'])->update(['value' => $option['value']]);
        }

        \DB::commit();

        return back()->with('message','Opzioni Salvate!');


    }
}

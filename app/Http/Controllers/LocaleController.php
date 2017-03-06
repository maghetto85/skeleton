<?php

namespace App\Http\Controllers;

use App\Locale;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $locales = Locale::query();

        if($q = request('q')) {

            $locales->where(function($users) {
                $users->whereRaw("name like ?", [request('q') . '%']);
                $users->OrWhereRaw("code like ?", [request('q') . '%']);
            });
        }

        $locales = $locales->paginate(25);

        return view('locales.index', compact('locales'));
    }

    public function create()
    {
        $locale = new Locale();
        return view('locales.form', compact('locale'));
    }

    public function show($id)
    {
        return $this->edit($id);
    }

    public function edit($id)
    {
        $locale = Locale::find($id);
        return view('locales.form', compact('locale'));
    }

    public function store()
    {
        return $this->update(request(), 0);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'code' => "required|string|unique:locales,code,$id",
        ]);

        if($request->hasFile('flag')) {

            $name = $request->get('code').'.png';
            $file = $request->file('flag')->storeAs('img/flags', $name, 'halex');
        }

        $locale = Locale::query()->updateOrCreate(['id' => $id], $request->only(['name','code']));

        return back()->with('locale', $locale);
    }

    public function destroy($id)
    {
        Locale::destroy($id);
        return back();
    }

    public function translation(Locale $locale)
    {
        $file = resource_path("lang/{$locale->code}.json");

        if(!\File::exists($file)) \File::put($file,'{}');
        $data = json_decode(\File::get($file));

        return view('locales.translation', compact('locale','data'));
    }

    public function saveTranslation(Locale $locale)
    {
        $file = resource_path("lang/{$locale->code}.json");
        $data = request()->all();
        unset($data['_token']);

        $trans = [];
        foreach($data as $word) {
            $trans[$word['key']] = $word['value'];
        }

        \File::put($file, json_encode($trans));

        return redirect()->route('locales.index');

    }

}

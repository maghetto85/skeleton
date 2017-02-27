<?php

namespace App\Http\Controllers;

use App\Page;
use App\PageC;
use App\PageParagraph;
use Illuminate\Http\Request;

class PageParagraphController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request,[
            'titolo' => 'required',
            'descrizione' => 'required',
            'idpagina' => 'required|exists:paginec,id'
        ]);

        $id = (int)$request->get('id');
        if(!$id) {

            $page = PageC::find($request->get('idpagina'));
            $request->merge(['posizione' => $page->paragraphs()->max('posizione')+1]);



        }


        $paragraph = PageParagraph::updateOrCreate(['id' => $id], $request->except('id'));

        return $paragraph;
    }

    public function edit($id)
    {
        $paragraph = PageParagraph::find($id);
        return $paragraph;
    }

    public function destroy($id)
    {
        $paragraph = PageParagraph::find($id);
        if($paragraph)
            $paragraph->delete();

        return $paragraph;
    }

    public function move($id)
    {
        $pos = request('position');
        $paragraph = PageParagraph::find($id);
        if($paragraph) {

            $paragraph->page->paragraphs()->wherePosizione($pos)->update(['posizione' => $paragraph->posizione]);
            $paragraph->posizione = $pos;
            $paragraph->save();

        }

        return $paragraph;
    }

    public function upload()
    {
        $file = request()->file('file');

        if(!$file->isValid())
            return ['errore' => 'Foto non valida'];


        $ext = '.'.$file->getClientOriginalExtension();
        $name = str_replace($ext, '', $file->getClientOriginalName());

        $prefix = '';
        $i = 0;
        while(\File::exists(app_path('../../httpdocs/uploads/pagesc/'.($fname = $name.$prefix.$ext)))) {
            $i++;
            $prefix = "[$i]";
        }

        $file->move(app_path('../../httpdocs/uploads/pagesc/'), $fname);
        $url = '/uploads/pagesc/'.$fname;

        return ['url' => $url];

    }
}

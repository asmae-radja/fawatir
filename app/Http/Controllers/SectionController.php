<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
       // dd($sections);
        return view('sections.sections',compact('sections'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sections|max:255',
        ],
    /**[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',


        ] */
    );

            Section::create([
                'name' => $request->name,
                'note' => $request->note,
                'Created_by' => (Auth::user()->name),

            ]);
         //   return redirect()->back()->with(['Add', 'Ajouté avec succès']);
            
            session()->flash('Add', 'Ajouté avec succès');
            return redirect('/sections');
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'name' => 'required|max:255|unique:sections,name,'.$id,
        ]);

        $section = Section::find($id);
        $section->update([
            'name' => $request->name,
            'note' => $request->note,
        ]);

        session()->flash('edit','Modification avec succès');
        return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Section::find($id)->delete();
        session()->flash('delete','Suppression avec succès');
        return redirect('/sections');
    }
}

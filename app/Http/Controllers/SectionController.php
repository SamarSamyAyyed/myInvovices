<?php

namespace App\Http\Controllers;

use App\Models\Section;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=Section::all();
        return view('sections.section',compact('sections'));
    }

    /**
     * Show the form for creating a new re
     *    source.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required',
        ],
        [
            'section_name.required'=>'الرجاء ادخال اسم القسم ',
            'section_name.unique'=>' اسم القسم مسجل مسبقا',
            'description.required'=>'الوصف المطلوب',
        
        ]);
        Section::create([
            'section_name'=> $request->section_name,
            'description'=> $request->description,
            'created_by'=> (Auth::user()->name),
        ]);
        session()->flash('Add','تم اضافة القسم بنجاح');
        return redirect('/section');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=$request->id;
        $this->validate($request,[
            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ],
        [
            'section_name.required'=>'الرجاء ادخال اسم القسم ',
            'section_name.unique'=>' اسم القسم مسجل مسبقا',
            'description.required'=>'الوصف المطلوب',
        
        ]);
        $sections=Section::find($id);

        $sections->update([
            'section_name'=>$request->section_name,
            'description' => $request->description,

        ]);


        session()->flash('ُEdit','تم تعديل  القسم بنجاح');
        return redirect('/section');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
            $id=$request->id;
            section::find($id)->delete();
            session()->flash('delete','تم حذف القسم بنجاح');
            return redirect('/sections');
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=Section::all();
       $products=products::all();
        return view('products.products',compact('sections','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        products::create([
            'product_name'=> $request->product_name,
            'section_id'=> $request->section_id,
            'description'=> $request->description,    
            ]);

        $validatedData = $request->validate([
            'product_name' => 'required|unique:products|max:255',
            'description' => 'required',
            'section_id' => 'required',
        ],
        [
            'product_name.required'=>'الرجاء ادخال اسم القسم ',
            'product_name.unique'=>' اسم القسم مسجل مسبقا',
            'description.required'=>'الوصف المطلوب',
        
        ]);
      
        session()->flash('Add','تم اضافة المنتج بنجاح');
        return redirect('/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $section_id = section::where('section_name',$request->section_name)->first()->id;
        $products=product::findOrFail($request->pro_id);
       $products->update([
           'product_name'=>$request->product_name,
           'description' =>$request->description,
           'section_id'=>$id,
       ]);


        session()->flash('ُEdit','تم تعديل  القسم بنجاح');
        return back();
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $products=products::findOrFail($request->pro_id);
        $products()->detele();
        session()->flash('delete','تم حذف المنتج بنجاح');
        return back();
        
    }
}

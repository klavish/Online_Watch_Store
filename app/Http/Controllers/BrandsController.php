<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $brands = Brands::all();
        return view('admin.brands_list', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.add_brand');
     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:15|string',
            'description' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);
        $requestData = $request->except(['_token', 'add']);
        $imgName = Str::snake($request->name) . '.'. $request->image->extension();
        $request->image->move(public_path('brands/'), $imgName);
        $requestData['image'] = $imgName;
        $brand = Brands::create($requestData);
        if(!empty($brand)){
            $brand->update($requestData);
            return redirect()->route('brands.index')->with('success', 'Brand added Successfully');
         }else{
            return redirect()->route('brands.index')->with('danger', 'Something went wrong');
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brands $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brands $brand)
    {
        return view('admin.brand_edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brands $brand)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:15|string',
            'description' => 'required|string',
        ]);
        $brand->name = $request->name ?? $brand->name;
        $brand->description = $request->description ?? $brand->description;
        $brand->save();
        return redirect()->route('brands.index')->with('success', 'Brand has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brands $brands)
    {
        
    }

    public function changeBrandImage(Request $request, $id){

        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);
        $requestData = $request->except(['_token', '_method', 'update']);
        $brand = Brands::find($id);
        if(!empty($brand)){
        $imgName = Str::snake($brand->name).'.'. $request->image->extension();
        $request->image->move(public_path('brands/'), $imgName);
        $requestData['image'] = Str::snake($imgName);
            $existingImage = $brand->image;
            $brand->update($requestData);
            // $imageExists = public_path("brands/ $existingImage");
            // if(file_exists($imageExists)){
            //   unlink("brands/ $existingImage");
            // }
            return redirect()->route('brands.index')->with('success', 'Brand Image Updated Successfully');
          }else{
            return redirect()->route('brands.index')->with('danger', 'Something went wrong');
  
          }
    }

    public function changeBrandStatus(Request $request, $id, $status = 1){
        $brand = Brands::find($id);
        if(!empty($brand)){
            $brand->is_active = $status;
            $brand->save();
            return redirect()->route('brands.index')->with('success', 'Brand status updated Successfully');
        }else{
           return redirect()->route('brands.index')->with('danger', 'Something went wrong');
        }
    }
}

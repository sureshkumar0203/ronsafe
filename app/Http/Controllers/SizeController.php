<?php

namespace App\Http\Controllers;

use App\Size;
use Illuminate\Http\Request;

//custom user login middle ware
use App\Http\Middleware\checkAdminLogin;

class SizeController extends Controller
{
	public function __construct(){
         $this->middleware(checkAdminLogin::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $size_data = Size::all()->sortByDesc("id");
        return view('admin.size.index', compact('size_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.size.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'size' => 'required',
        ]);
		
		$count = Size::where('size', $request->size)->count();
        if ($count == 0) {
            Size::create($input);
			return redirect('administrator/manage-size/create')->with('success', 'Saved successfully.');
        } else {
            return redirect('administrator/manage-size/create')->with('error', 'This record exist.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size,$id)
    {
        if(Size::find($id)!=null){
			$size_data = Size::findOrfail($id);
		  	return view('admin.size.edit', compact('size_data'));
		}else{
			return redirect('administrator/manage-size');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size,$id)
    {
        $cat_id = Size::findOrfail($id);
        $all_input = $request->all();
        $this->validate($request, [
            'size' => 'required',
        ]);
		
		if(Size::find($id)!=null){
			$count = Size::where('size', $request->size)->where('id', '!=', $id)->count();
			if ($count > 0) {
				return redirect('administrator/manage-size/'.$id.'/edit')->with('error', 'This record exist.');
			}
			Size::find($id)->update($all_input);
			return redirect('administrator/manage-size/'.$id.'/edit')->with('success', 'Record updated successfully.');
		}else{
			return redirect('administrator/manage-size');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size,$id)
    {
        if(Size::find($id)!=null){
			Size::destroy($id);
        	return redirect('administrator/manage-size')->with('success','Record deleted successfully');
		}else{
			return redirect('administrator/manage-size');
		}
    }
}

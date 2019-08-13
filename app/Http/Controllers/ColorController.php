<?php

namespace App\Http\Controllers;

use App\Color;
use Illuminate\Http\Request;

//custom user login middle ware
use App\Http\Middleware\checkAdminLogin;

class ColorController extends Controller
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
        $color_data = Color::all()->sortByDesc("id");
        return view('admin.color.index', compact('color_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.color.create');
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
            'color' => 'required',
			'color_code' => 'required',
        ]);
		
		$count = Color::where('color', $request->color_code)->count();
        if ($count == 0) {
            Color::create($input);
			return redirect('administrator/manage-color/create')->with('success', 'Saved successfully.');
        } else {
            return redirect('administrator/manage-color/create')->with('error', 'This record exist.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color,$id)
    {
        if(Color::find($id)!=null){
			$color_data  = Color::findOrfail($id);
		  	return view('admin.color.edit', compact('color_data'));
		}else{
			return redirect('administrator/manage-color');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color,$id)
    {
        $color_id = Color::findOrfail($id);
        $all_input = $request->all();
        $this->validate($request, [
            'color' => 'required',
			'color_code' => 'required',
        ]);
		
		if(Color::find($id)!=null){
			$count = Color::where('color_code', $request->color_code)->where('id', '!=', $id)->count();
			if ($count > 0) {
				return redirect('administrator/manage-color/'.$id.'/edit')->with('error', 'This record exist.');
			}
			Color::find($id)->update($all_input);
			return redirect('administrator/manage-color/'.$id.'/edit')->with('success', 'Record updated successfully.');
		}else{
			return redirect('administrator/manage-color');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        if(Color::find($id)!=null){
			Color::destroy($id);
        	return redirect('administrator/manage-color')->with('success','Record deleted successfully');
		}else{
			return redirect('administrator/manage-color');
		}
    }
}

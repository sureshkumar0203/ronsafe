<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

//custom user login middle ware
use App\Http\Middleware\checkAdminLogin;

class CategoryController extends Controller
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
		$cat_data = Category::all()->sortByDesc("id");
        return view('admin.category.index', compact('cat_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.category.create');
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
            'cat_name' => 'required',
        ]);
		
		$count = Category::where('cat_name', $request->cat_name)->count();
        if ($count == 0) {
            $input['cat_slug'] = str_slug($request->cat_name, '-');
            Category::create($input);
			return redirect('administrator/manage-category/create')->with('success', 'Saved successfully.');
        } else {
            return redirect('administrator/manage-category/create')->with('error', 'This record exist.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category,$id)
    {
		if(Category::find($id)!=null){
			$cat_data = Category::findOrfail($id);
		  	return view('admin.category.edit', compact('cat_data'));
		}else{
			return redirect('administrator/manage-category');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category,$id)
    {
        $cat_id = Category::findOrfail($id);
        $all_input = $request->all();
        $this->validate($request, [
            'cat_name' => 'required',
        ]);
		
		if(Category::find($id)!=null){
			$count = Category::where('cat_name', $request->cat_name)->where('id', '!=', $id)->count();
			if ($count > 0) {
				return redirect('administrator/manage-category/'.$id.'/edit')->with('error', 'This record exist.');
			}
			$all_input['cat_slug'] = str_slug($request->cat_name, '-');
			Category::find($id)->update($all_input);
			return redirect('administrator/manage-category/'.$id.'/edit')->with('success', 'Record updated successfully.');
		}else{
			return redirect('administrator/manage-category');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,$id)
    {
        if(Category::find($id)!=null){
			Category::destroy($id);
        	return redirect('administrator/manage-category')->with('success','Record deleted successfully');
		}else{
			return redirect('administrator/manage-category');
		}
    }
}

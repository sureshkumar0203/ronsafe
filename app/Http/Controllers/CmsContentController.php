<?php

namespace App\Http\Controllers;

use App\cmsContent;
use Illuminate\Http\Request;
//custom user login middle ware
use App\Http\Middleware\checkAdminLogin;
use Image;


class CmsContentController extends Controller
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
		$cms_data = cmsContent::all()->sortByDesc("id");
		return view('admin.cms.index',compact('cms_data'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cmsContent  $cmsContent
     * @return \Illuminate\Http\Response
     */
    public function show(cmsContent $cmsContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cmsContent  $cmsContent
     * @return \Illuminate\Http\Response
     */
    public function edit(cmsContent $cmsContent,$id)
    {
		if(cmsContent::find($id)!=null){
			$cms_data = cmsContent::findOrfail($id);
			return view('admin.cms.edit', compact('cms_data'));
		}else{
			return redirect('administrator/manage-contents');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cmsContent  $cmsContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cmsContent $cmsContent,$id)
    {
		$this->validate($request,[
		    'page_title' => 'required',
            'content' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
			'cms_photo' => 'nullable|mimes:jpeg,bmp,png|dimensions:min_width=200,min_height=200'],

			['page_title.required' => 'Please enter paga title',
			 'meta_title.required' => 'Please enter meta title']
        );
		
		if(cmsContent::find($id)!=null){
			$cms_data = cmsContent::find($id);
			//dd($cms_data);
			if ($request->hasFile('cms_photo') && !empty($cms_data->cms_photo)) {
				$cms_ph_path = public_path('cms-photo/' . $cms_data->cms_photo);
				if (file_exists($cms_ph_path)) {
					unlink($cms_ph_path);
				}
			}
				
			if ($request->hasFile('cms_photo')) {
				$filename = 'CMS'.rand(11111,99999). '.' .$request->file('cms_photo')->getClientOriginalExtension();
		         $request->file('cms_photo')->move(public_path() . '/cms-photo/', $filename);
				 cmsContent::where('id', $id)->update(['cms_photo' => $filename]);
			}
			
			$input = request()->except(['cms_photo','_method','_token']);
			//dd($input);
			$pageUpdate = cmsContent::find($id)->update($input);
			return redirect('administrator/manage-contents/'.$id.'/edit')->with('success', 'Record updated successfully.');
		}else{
			return redirect('administrator/manage-contents');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cmsContent  $cmsContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(cmsContent $cmsContent)
    {
        //
    }

}

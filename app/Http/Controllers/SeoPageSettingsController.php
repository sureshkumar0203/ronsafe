<?php

namespace App\Http\Controllers;

use App\SeoPageSetting;


use Illuminate\Http\Request;
//custom user login middle ware
use App\Http\Middleware\checkAdminLogin;

class SeoPageSettingsController extends Controller {

	public function __construct(){
         $this->middleware(checkAdminLogin::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $seo_data = SeoPageSetting::get();
        return view('admin.seo.index', compact('seo_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SeoPageSettings  $seoPageSettings
     * @return \Illuminate\Http\Response
     */
    public function show(SeoPageSetting $seoPageSettings) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SeoPageSettings  $seoPageSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(SeoPageSetting $seoPageSettings, $id) {
		if(SeoPageSetting::find($id)!=null){
			$seo_data = SeoPageSetting::findOrfail($id);
			return view('admin.seo.edit', compact('seo_data'));
		}else{
			return redirect('administrator/manage-seo-settings');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SeoPageSettings  $seoPageSettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $inputData = $request->all();
        $this->validate($request, [
            'meta_title' => 'required',
        ]);
        $updated = SeoPageSetting::find($id)->update($inputData);
        return redirect('administrator/manage-seo-settings/'.$id.'/edit')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SeoPageSettings  $seoPageSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(SeoPageSettings $seoPageSettings) {
        //
    }

}

<?php

namespace App\Http\Controllers;

use App\Banner;
use App\cmsContent;
use Illuminate\Http\Request;
use Image;
//custom user login middle ware
use App\Http\Middleware\checkAdminLogin;

class BannerController extends Controller
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
		$banner_data = Banner::with(['cmsPageLink' => function($query) {
			$query->select(['id', 'page_title','content']);
		}])->get();
        return view('admin.banners.index', compact('banner_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$cms_data = cmsContent::pluck('page_title', 'id');
        return view('admin.banners.create',compact('cms_data'));
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
            'banner_photo' => 'required|mimes:jpeg,bmp,png|dimensions:min_width=10,min_height=10',
        ]);
		
        if ($request->hasFile('banner_photo')) {
			$banner_photo = $request->file('banner_photo');
            $filename = 'B' . rand(11111, 99999) . '.' . $banner_photo->getClientOriginalExtension();
            $image_resize = Image::make($banner_photo->getRealPath())->resize(1920, 600);
            $image_resize->save(public_path('banners/' . $filename));
            
			$input['banner_photo'] = $filename;
			Banner::create($input);
			
			return redirect('administrator/manage-banners/create')->with('success', 'Record saved successfully.');
        }else{
			return redirect('administrator/manage-banners/create')->with('error', 'Record saved failed.');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner,$id)
    {
		if(Banner::find($id)!=null){
			$baner_data = Banner::findOrfail($id);
			$cms_data = cmsContent::pluck('page_title', 'id');
			return view('admin.banners.edit', compact('baner_data','cms_data'));
		}else{
			return redirect('administrator/manage-banners');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner,$id)
    {
		$baner_data = Banner::find($id);
		$this->validate($request, [
            'banner_photo' => 'mimes:jpeg,bmp,png',
        ]);
		
		if(Banner::find($id)!=null &&  $request->hasFile('banner_photo')){
			if (!empty($baner_data->banner_photo)) {
                $banner_path = public_path('banners/' . $baner_data->banner_photo);
                if (file_exists($banner_path)) {
                    unlink($banner_path);
                }
            }
			
			$banner_photo = $request->file('banner_photo');
            $filename = 'B' . rand(11111, 99999) . '.' . $banner_photo->getClientOriginalExtension();
            $image_resize = Image::make($banner_photo->getRealPath())->resize(1920, 600);
            $image_resize->save(public_path('banners/' . $filename));
            
			Banner::where('id', $id)->update(['banner_photo' => $filename]);
					
			return redirect('administrator/manage-banners/'.$id.'/edit')->with('success', 'Record updated successfully.');
		}else{
			Banner::where('id', $id)->update(['cp_id' => $request->cp_id]);
			return redirect('administrator/manage-banners/'.$id.'/edit')->with('success', 'Record updated successfully.');
			//return redirect('administrator/manage-banners');
		 }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner,$id)
    {
		if(Banner::find($id)!=null){
			$baner_data = Banner::find($id);
			if (!empty($baner_data->banner_photo)) {
				$banner_path = public_path('banners/' . $baner_data->banner_photo);
				if (file_exists($banner_path)) {
					unlink($banner_path);
				}
			}
			Banner::destroy($id);
			return redirect('administrator/manage-banners')->with('success', 'Record deleted successfully');
		}else{
			return redirect('administrator/manage-banners');
		}
	}
}

<?php

namespace App\Http\Controllers;

use App\OurService;
use Illuminate\Http\Request;
//custom user login middle ware
use App\Http\Middleware\checkAdminLogin;
use Image;

class OurServiceController extends Controller
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
        $service_data = OurService::all()->sortByDesc("id");
		return view('admin.service.index',compact('service_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all_input = $request->all();
        $this->validate($request, [
            'service_title' => 'required',
            'service_photo' => 'required|mimes:jpeg,png',
			'service_details' => 'required',
        ]);

        $count = OurService::where('service_title', $request->service_title)->count();

        if ($count == 0) {
            if ($request->hasFile('service_photo')) {
                $service_photo = $request->file('service_photo');
				$filename = 'OS'.rand(11111,99999). '.' .$request->file('service_photo')->getClientOriginalExtension();
                $image_resize = Image::make($service_photo->getRealPath())->resize(370, 240);
                $image_resize->save(public_path('service-photo/' . $filename));
				
                $all_input['service_photo'] = $filename;
            }
            OurService::create($all_input);
			return redirect('administrator/manage-services/create')->with('success', 'Record saved successfully.');
        } else {
			return redirect('administrator/manage-services/create')->with('error', 'This record exist.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OurService  $ourService
     * @return \Illuminate\Http\Response
     */
    public function show(OurService $ourService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OurService  $ourService
     * @return \Illuminate\Http\Response
     */
    public function edit(OurService $ourService,$id)
    {
        if(OurService::find($id)!=null){
			$service_data = OurService::findOrfail($id);
			return view('admin.service.edit', compact('service_data'));
		}else{
			return redirect('administrator/manage-services');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OurService  $ourService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OurService $ourService,$id)
    {
		$all_input = $request->all();
        $this->validate($request,[
		    'service_title' => 'required',
            'service_details' => 'required',
			'service_photo' => 'nullable|mimes:jpeg,bmp,png|dimensions:min_width=200,min_height=200'],

			['service_title.required' => 'Please enter service title']
        );
		
		if(OurService::find($id)!=null){
			$service_data = OurService::find($id);
			//dd($service_data);
			if ($request->hasFile('service_photo') && !empty($service_data->service_photo)) {
				$service_ph_path = public_path('service-photo/' . $service_data->service_photo);
				if (file_exists($service_ph_path)) {
					unlink($service_ph_path);
				}
			}
				
			if ($request->hasFile('service_photo')) {
				$filename = 'OS'.rand(11111,99999). '.' .$request->file('service_photo')->getClientOriginalExtension();
                $image_resize = Image::make($request->file('service_photo')->getRealPath())->resize(370, 240);
                $image_resize->save(public_path('service-photo/' . $filename));
				$all_input['service_photo'] = $filename;
				
				OurService::where('id', $id)->update(['service_photo' => $filename]);
			}else {
				$all_input['service_photo'] = $service_data->service_photo;
			}
			OurService::find($id)->update($all_input);
			return redirect('administrator/manage-services/'.$id.'/edit')->with('success', 'Record updated successfully.');
		}else{
			return redirect('administrator/manage-services');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OurService  $ourService
     * @return \Illuminate\Http\Response
     */
    public function destroy(OurService $ourService,$id)
    {
        if(OurService::find($id)!=null){
			$service_data = OurService::find($id);
			if (!empty($service_data->service_photo)) {
				$service_ph_path = public_path('service-photo/' . $service_data->service_photo);
				if (file_exists($service_ph_path)) {
					unlink($service_ph_path);
				}
			}
			OurService::destroy($id);
			return redirect('administrator/manage-services')->with('success', 'Record deleted successfully');
		}else{
			return redirect('administrator/manage-services');
		}
    }
}

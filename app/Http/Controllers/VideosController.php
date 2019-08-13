<?php

namespace App\Http\Controllers;

use App\Videos;
use Illuminate\Http\Request;

//custom user login middle ware
use App\Http\Middleware\checkAdminLogin;

class VideosController extends Controller
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
        $video_data = Videos::all()->sortByDesc("id");
		return view('admin.video.index',compact('video_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.video.create');
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
       
        $count = Videos::where('title', $request->title)->count();
		if ($count > 0) {
			return redirect('administrator/manage-videos/create')->with('error', 'This record exist.');
		}else{
			if($request->hasFile('video')) {
				$ext = strtolower($request->file('video')->getClientOriginalExtension());
				if ($request->file('video') != "" && $ext != "mp4" && $ext != "mov") {
					return redirect('administrator/manage-videos/create')->with('error', 'Invalid file format.');
				}
				
				$size = round($request->file('video')->getClientSize()/1024/1024);
				if($size > 10){
					return redirect('administrator/manage-videos/create')->with('error', 'Video size should not more than 10 MB.');
				}
				
				
               
				$video = $request->file('video');
				$filename = 'V'.rand(11111,99999). '.' .strtolower($request->file('video')->getClientOriginalExtension());
				$destination_path = public_path('/video');
				$video->move($destination_path, $filename);
				
                $all_input['video'] = $filename;
            }
			Videos::create($all_input);
			return redirect('administrator/manage-videos/create')->with('success', 'Record saved successfully.');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function show(Videos $videos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function edit(Videos $videos,$id)
    {
        if(Videos::find($id)!=null){
			$video_data = Videos::findOrfail($id);
			return view('admin.video.edit', compact('video_data'));
		}else{
			return redirect('administrator/manage-videos');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Videos $videos,$id)
    {
        $all_input = $request->all();
		if(Videos::find($id)!=null){
			$video_data = Videos::find($id);
			//dd($video_data);
			if ($request->hasFile('video') && !empty($video_data->video)) {
				$video_path = public_path('video/' . $video_data->video);
				if (file_exists($video_path)) {
					unlink($video_path);
				}
			}
				
			if ($request->hasFile('video')) {
				$video = $request->file('video');
				$filename = 'V'.rand(11111,99999). '.' .strtolower($request->file('video')->getClientOriginalExtension());
				$destination_path = public_path('/video');
				$video->move($destination_path, $filename);
				
				$all_input['video'] = $filename;
				
				Videos::where('id', $id)->update(['video' => $filename]);
			}else {
				$all_input['video'] = $video_data->video;
			}
			Videos::find($id)->update($all_input);
			return redirect('administrator/manage-videos/'.$id.'/edit')->with('success', 'Record updated successfully.');
		}else{
			return redirect('administrator/manage-videos');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Videos $videos,$id)
    {
        if(Videos::find($id)!=null){
			$video_data = Videos::find($id);
			if (!empty($video_data->video)) {
				$video_path = public_path('video/' . $video_data->video);
				if (file_exists($video_path)) {
					unlink($video_path);
				}
			}
			Videos::destroy($id);
			return redirect('administrator/manage-videos')->with('success', 'Record deleted successfully');
		}else{
			return redirect('administrator/manage-videos');
		}
    }
    
}

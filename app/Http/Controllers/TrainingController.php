<?php

namespace App\Http\Controllers;

use App\Training;
use Illuminate\Http\Request;
use Image;
//custom user login middle ware
use App\Http\Middleware\checkAdminLogin;

class TrainingController extends Controller
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
        $training_data = Training::all()->sortByDesc("id");
        return view('admin.training.index', compact('training_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.training.create');
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
            'training_title' => 'required',
			'training_price' => 'required',
            'training_icon' => 'required|mimes:jpeg,png',
			'training_details' => 'required',
        ]);

        $count = Training::where('training_title', $request->training_title)->count();

        if ($count == 0) {
            if ($request->hasFile('training_icon')) {
                $training_icon = $request->file('training_icon');
                $filename = rand(11111, 99999) . $training_icon->getClientOriginalName();
                $image_resize = Image::make($training_icon->getRealPath())->resize(100, 100);
                $image_resize->save(public_path('training-icons/' . $filename));
				
                $all_input['training_icon'] = $filename;
            }
            Training::create($all_input);
			return redirect('administrator/manage-trainings/create')->with('success', 'Record saved successfully.');
        } else {
			return redirect('administrator/manage-trainings/create')->with('error', 'This record exist.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training,$id)
    {
        if(Training::find($id)!=null){
			$training_data = Training::findOrfail($id);
			return view('admin.training.edit', compact('training_data'));
		}else{
			return redirect('administrator/manage-trainings');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Training $training,$id)
    {
		$all_input = $request->all();
        $this->validate($request, [
            'training_title' => 'required',
			'training_price' => 'required',
			'training_icon' => 'nullable|mimes:jpeg,bmp,png',
			'training_details' => 'required',
        ]);
		
		$training_data = Training::find($id);
		$count = Training::where('training_title', $request->training_title)->where('id', '!=', $training_data->id)->count();
		if ($count > 0) {
			return redirect('administrator/manage-category/'.$id.'/edit')->with('error', 'This record exist.');
		}
		
		if ($request->hasFile('training_icon')) {
			if (!empty($training_data->training_icon)) {
				$training_icon_path = public_path('training-icons/' . $training_data->training_icon);
				if (file_exists($training_icon_path)) {
					unlink($training_icon_path);
				}
			}
			$training_icon = $request->file('training_icon');
			$filename = rand(11111, 99999) . $training_icon->getClientOriginalName();
			$image_resize = Image::make($training_icon->getRealPath())->resize(100, 100);
			$image_resize->save(public_path('training-icons/' . $filename));
			$all_input['training_icon'] = $filename;
		} else {
			$all_input['training_icon'] = $training_data->training_icon;
		}
		Training::find($id)->update($all_input);
		
		return redirect('administrator/manage-trainings/'.$id.'/edit')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training,$id)
    {
		$training_data = Training::find($id);
        if($training_data!=null){
		  if (!empty($training_data->training_icon)) {
			  $training_path = public_path('training-icons/' . $training_data->training_icon);
			  if (file_exists($training_path)) {
				  unlink($training_path);
			  }
		  }
		  Training::destroy($id);
		  return redirect('administrator/manage-trainings')->with('success', 'Record deleted successfully');
		}else{
			return redirect('administrator/manage-trainings');
		}
    }
}

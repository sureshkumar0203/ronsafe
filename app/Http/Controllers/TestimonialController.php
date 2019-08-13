<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Testimonial;




//custom user login middle ware
use App\Http\Middleware\checkAdminLogin;


class TestimonialController extends Controller
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
        $testimonial_data = Testimonial::all()->sortByDesc("id");
		return view('admin.testimonial.index',compact('testimonial_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonial.create');
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
            'name' => 'required',
			'message' => 'required',
        ]);
		
		Testimonial::create($all_input);
		return redirect('administrator/manage-testimonials/create')->with('success', 'Record saved successfully.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OurService  $ourService
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $ourService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OurService  $ourService
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $Testimonial,$id)
    {
        if(Testimonial::find($id)!=null){
			$testimonial_data = Testimonial::findOrfail($id);
			return view('admin.testimonial.edit', compact('testimonial_data'));
		}else{
			return redirect('administrator/manage-testimonials');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OurService  $ourService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $Testimonial,$id)
    {
		$all_input = $request->all();
        $this->validate($request, [
            'name' => 'required',
			'message' => 'required',
        ]);
		
		if(Testimonial::find($id)!=null){
			Testimonial::find($id)->update($all_input);
			return redirect('administrator/manage-testimonials/'.$id.'/edit')->with('success', 'Record updated successfully.');
		}else{
			return redirect('administrator/manage-testimonials ');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OurService  $ourService
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $Testimonial,$id)
    {
        if(Testimonial::find($id)!=null){
			Testimonial::destroy($id);
			return redirect('administrator/manage-testimonials')->with('success', 'Record deleted successfully');
		}else{
			return redirect('administrator/manage-testimonials');
		}
    }
}

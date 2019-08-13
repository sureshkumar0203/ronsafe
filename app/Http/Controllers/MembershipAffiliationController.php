<?php

namespace App\Http\Controllers;

use App\MembershipAffiliation;
use Illuminate\Http\Request;

use Image;
//custom user login middle ware
use App\Http\Middleware\checkAdminLogin;

class MembershipAffiliationController extends Controller
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
		$ma_data  = MembershipAffiliation::orderBy('id', 'DESC')->get();
        return view('admin.ma.index', compact('ma_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ma.create');
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
            'member_photo' => 'required|mimes:jpeg,bmp,png|dimensions:min_width=10,min_height=10',
        ]);
		
        if ($request->hasFile('member_photo')) {
			$member_photo = $request->file('member_photo');
            $filename = 'MA' . rand(11111, 99999) . '.' . $member_photo->getClientOriginalExtension();
            $image_resize = Image::make($member_photo->getRealPath())->resize(119, 89);
            $image_resize->save(public_path('ma-photo/' . $filename));
            
			$input['member_photo'] = $filename;
			MembershipAffiliation::create($input);
			return redirect('administrator/manage-ma/create')->with('success', 'Record saved successfully.');
        }else{
			return redirect('administrator/manage-ma/create')->with('error', 'Record saved failed.');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MembershipAffiliation  $membershipAffiliation
     * @return \Illuminate\Http\Response
     */
    public function show(MembershipAffiliation $membershipAffiliation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MembershipAffiliation  $membershipAffiliation
     * @return \Illuminate\Http\Response
     */
    public function edit(MembershipAffiliation $membershipAffiliation,$id)
    {
        if(MembershipAffiliation::find($id)!=null){
			$ma_data = MembershipAffiliation::findOrfail($id);
			return view('admin.ma.edit', compact('ma_data'));
		}else{
			return redirect('administrator/manage-ma');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MembershipAffiliation  $membershipAffiliation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MembershipAffiliation $membershipAffiliation,$id)
    {
        $ma_data = MembershipAffiliation::find($id);
		$this->validate($request, [
            'member_photo' => 'required|mimes:jpeg,bmp,png',
        ]);
		if(MembershipAffiliation::find($id)!=null &&  $request->hasFile('member_photo')){
			if (!empty($ma_data->member_photo)) {
                $ma_path = public_path('ma-photo/' . $ma_data->member_photo);
                if (file_exists($ma_path)) {
                    unlink($ma_path);
                }
            }
			
			$member_photo = $request->file('member_photo');
            $filename = 'MA' . rand(11111, 99999) . '.' . $member_photo->getClientOriginalExtension();
            $image_resize = Image::make($member_photo->getRealPath())->resize(119, 89);
            $image_resize->save(public_path('ma-photo/' . $filename));
            
			MembershipAffiliation::where('id', $id)->update(['member_photo' => $filename]);
					
			return redirect('administrator/manage-ma/'.$id.'/edit')->with('success', 'Record updated successfully.');
		}else{
			MembershipAffiliation::where('id', $id)->update(['cp_id' => $request->cp_id]);
			return redirect('administrator/manage-ma/'.$id.'/edit')->with('success', 'Record updated successfully.');
		 }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MembershipAffiliation  $membershipAffiliation
     * @return \Illuminate\Http\Response
     */
    public function destroy(MembershipAffiliation $membershipAffiliation)
    {
        if(MembershipAffiliation::find($id)!=null){
			$ma_data = MembershipAffiliation::find($id);
			if (!empty($ma_data->member_photo)) {
				$ma_path = public_path('ma-photo/' . $ma_data->member_photo);
				if (file_exists($ma_path)) {
					unlink($ma_path);
				}
			}
			MembershipAffiliation::destroy($id);
			return redirect('administrator/manage-ma')->with('success', 'Record deleted successfully');
		}else{
			return redirect('administrator/manage-ma');
		}
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Faculty;
use App\User;
use App\SecretKey;
use App\Course;
use App\Role;
use App\Profile;
use Auth;


class ProfileController extends Controller{

	/**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checkother');
    }

	public function getIndex($id=null){
		if($id){
			$profile = Profile::find($id);
		}else{
			$profile = Profile::find(Auth::user()->id);
		}
		$image = asset('asset/img/avatar.jpg');
		
		if($profile->image != ""){
			$image = asset('asset/userimage/'.$profile->image);
		}
		$profile->image = $image;
		return view('profile')->with([
									'title'=>'Profile',
									'profile' => $profile
									]);

	}

	public function getEdit(){
		$profile = Profile::find(Auth::user()->id);
		$courses = Course::all();
		return view('profile-edit')->with([
											'title'=>'Profile Edit',
											'profile' => $profile,
											'course' => $courses
											]);
	}

	public function getSetting(){
		return view('password')->with([
											'title'=>'Password',
											
											]);
	}

	public function postSetting(){
		return 'post password change';
	}

	public function postEdit(Request $request){
		$profile = Profile::find($request->input('profile_id'));

		$profile->name = $request->input('name');
		$profile->address = $request->input('address');
		$profile->email = $request->input('email');
		$profile->phone = $request->input('phone');
		$profile->dob = $request->input('dob');

		$profile->save();

		try{
			if ($request->file('image')->isValid()) {
				$path = public_path() . '/uploads/profile/';

				if(!file_exists($path)){
				    mkdir($path, 0777, true);
				}

				// $destinationPath = 'uploads/image'; // upload path
				$extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
				$fileName = Auth::user()->clz_key.'.'.$extension; // renameing image
				$request->file('image')->move($path, $fileName); // uploading file to given path
				// sending back with message

				$profile->image = $path.$fileName;

				$profile->save();

				Session::flash('message', 'Uploaded Successfully');
				// return redirect('/profile');
		    }
		    else {
				// sending back with error message.
				Session::flash('error', 'Profile Created but Uploaded image file is not valid');
				return redirect('/profile');
		    }
		}catch(\Exception $e){
			Session::flash('error', 'Profile Created but Error Uploading Image');
			// return $e->getMessage();
		}

		return redirect('/profile');

	}
}

?>
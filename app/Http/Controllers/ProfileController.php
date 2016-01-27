<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\PasswordChange;
use App\Http\Requests\ProfileRequest;

use App\Faculty;
use App\User;
use App\SecretKey;
use App\Course;
use App\CourseProfile;
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
        $this->middleware('checkother', ['except'=> ['getSetting', 'postSetting']]);
    }

	public function getIndex($id=null){
		if($id){
			$profile = Profile::find($id);
		}else{
			$profile = Profile::where('user_id', Auth::user()->id)->first();
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
		$profile = Profile::where('user_id', Auth::user()->id)->first();
		$courses = Course::all();
		return view('profile-edit')->with([
											'title'=>'Profile Edit',
											'profile' => $profile,
											'course' => $courses
											]);
	}

	public function getSetting(){
		if(Auth::user()->role->permission == 25){
			$img = url('/').'/asset/img/male.png';
		}else{
			$img = Auth::user()->profile->image;
	        if($img == ""){
	            $img = asset('asset/img/avatar.jpg');
	        }else{
	            $img = asset('asset/userimage/'.Auth::user()->profile->image);
	        }
	    }
        // Auth::user()->profile->image = $img;
        view()->share('auth', Auth::user());
		return view('password')->with([
											'title'=>'Password',
											'user_id' => Auth::user()->id
											]);
	}

	public function postSetting(PasswordChange $request){
		if(Auth::user()->id == $request->input('id')){
			try{
				$user = User::find($request->input('id'));
				if(\Hash::check($request->input('old_password'), $user->password)){
					$user->password = \Hash::make($request->input('new_password'));
					$user->save();

					$message = ['message'=>'Password changed successfully!!', 'type'=>'success'];
					Auth::logout();
					return redirect('auth/login')->with($message);
				}else{
					$message = ['old_password'=>'Password do not match the record'];
					return redirect()->back()->withErrors($message);
				}
			}catch(\Exception $e){
				$message = ['message'=>'Password Change Failed', 'type'=>'danger'];	
			}
		}else{
			$message = ['message'=>'Invalid Request', 'type'=>'danger'];
		}
		return redirect()->back()->with($message);
	}

	public function postEdit(ProfileRequest $request){
		// return [$request->input('gender')=='Male'];
		$profile = Profile::find($request->input('profile_id'));

		$profile->name = $request->input('name');
		$profile->address = $request->input('address');
		$profile->email = $request->input('email');
		$profile->phone = $request->input('phone');
		$profile->dob = $request->input('dob');
		$profile->gender = ($request->input('gender') == 'Male')?'Male':(($request->input('gender') == 'Female')?'Female':'');

		$profile->year_joined = ($request->has('year_joined'))?$request->input('year_joined'):"";
		if(Auth::user()->role->permission == 5){
			$profile->semester = ($request->has('semester'))?$request->input('semester'):"";
		}elseif (Auth::user()->role->permission == 15) {
			if($request->has('courses')){
				foreach ($profile->courseprofiles as $each) {
					$each->delete();
				}
				foreach ($request->input('courses') as $key => $value) {
					$courseProfile = new CourseProfile;
					$courseProfile->profile_id = $request->input('profile_id');
					$courseProfile->course_id = $value;
					$courseProfile->save();
				}
			}
		}

		$profile->save();

		try{
			if($request->input('img_org') == 0 && $request->input('img_select') == 1){
				\Session::flash('message', 'Updated Successfully');
				$profile->image = "";
				$profile->save();
			}elseif ($request->input('img_org') == 1 && $request->input('img_select') == 1) {
				//do nothing with the image
				\Session::flash('message', 'Updated Successfully');
			}elseif($request->input('img_select') == 2){
				if ($request->file('image')) {
					$path = public_path() . '/asset/userimage/';

					if(!file_exists($path)){
					    mkdir($path, 0777, true);
					}


					if(!in_array($request->file('image')->getMimeType(), ['image/jpg', 'image/png', 'image/jpeg'])){
						\Session::flash('message', 'Profile updated without image(invali file type)');
					}else{

						// $destinationPath = 'uploads/image'; // upload path
						$extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
						$fileName = Auth::user()->clz_key.'.'.$extension; // renameing image
						$request->file('image')->move($path, $fileName); // uploading file to given path
						// sending back with message

						$profile->image = $fileName;

						$profile->save();

						\Session::flash('message', 'Updated Successfully');
						// return redirect('/profile');
					}
			    }
			}
		}catch(\Exception $e){
			\Session::flash('message', 'Profile Created but Error Uploading Image');
			// return $e->getMessage();
		}

		return redirect('/profile');

	}
}

?>
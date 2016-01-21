<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Faculty;
use App\User;
use App\SecretKey as Key;
use App\Course;
use App\Role;
use Auth;

class AdminController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('checkadmin');
    }


    public function getIndex(){
        $role = Role::all();
        foreach ($role as $eachrole) {
            if($eachrole->permission == 5){
                $students = User::where('role_id', $eachrole->id)->get();
            }else if($eachrole->permission == 15){
                $teachercount = User::where('role_id', $eachrole->id)->count();
            }
        }
        $faculty = Faculty::all();

        
    	return view('admin.student')->with([
                                            'title' => 'Dashboard',
                                            'students' => $students,
                                            'teachercount' => $teachercount,
                                            'facultycount' => count($faculty)
                                            ]);
    }

    public function getRemove($id=null){
        $user = User::find($id);
        $message = 'Invalid Request';
        $type = 'invalid';
        if($user){
            $user->delete();
            $message = 'Remove Success';
            $type = 'valid';
        }

        return redirect()->back()->with(['message'=> $message, 'type'=>$type]);
    }

    public function getStatus($id=null){
        $user = User::find($id);
        $message = 'Invalid Request';
        $type = 'invalid';
        if($user){
            $status = 0;
            if($user->active == 0){
                $status = 1;
            }
            $user->active = $status;
            $user->save();
            $message = 'Status Changed';
            $type = 'valid';
        }

        return redirect()->back()->with(['message'=> $message, 'type'=>$type]);
    }

    public function getFacultymember(){
        $role = Role::all();
        foreach ($role as $eachrole) {
            if($eachrole->permission == 15){
                $teacher = User::where('role_id', $eachrole->id)->get();
            }
        }


    	return view('admin.teacher')->with([
                                            'title' => 'Faculty Member',
                                            'teacher' => $teacher
                                            ]);
    }

    public function getCourseremove($id=null){
    	$course = Course::find($id);
        $message = 'Invalid Request';
        $type = 'invalid';
        if($course){
            foreach ($course->courseprofiles as $each) {
                $each->delete();
            }
            $course->delete();
            
            $message = 'Remove Success';
            $type = 'valid';
        }

        return redirect()->back()->with(['message'=> $message, 'type'=>$type]);
    }

    public function getFaculty(){
        $faculty = Faculty::all();
    	return view('admin.faculty')->with([
                                            'faculty' => $faculty,
                                            'title' => 'Faculty',
                                            ]);
    }

    public function getKey(){
        $keys = Key::all();
        return view('admin.key')->with([
                                        'title' => 'Key',
                                        'key' => $keys
                                        ]);
    }

    public function getKeygenerate(){
        $date = date('Y-m-d H:i:s');
        $key = substr(bcrypt($date), 6, 6);

        $keys = Key::where('key', $key)->first();
        while ($keys) {
            $date = date('Y-m-d H:i:s');
            $key = substr(bcrypt($date), 6, 6);

            $keys = Key::where('key', $key)->first();
        }

        return ['key'=>$key];
    }

    public function postAddfaculty(Request $request){
    	$faculty = new Faculty;

    	$faculty->name = $request->input('name');
    	$faculty->save();

    	return redirect('admin/faculty');
    }

    public function postAddcourse(Request $request){
    	$course = new Course;

    	$course->name = $request->input('name');
    	$course->faculty_id = $request->input('id');
        $course->course_code = $request->input('course_code');
    	$course->save();

    	return redirect('admin/faculty');
    }


    // public function postFacultymember(Request $request){
    // 	$user = new User;
    // 	$profile = new Profile;

    // 	$user->username = $request->input('username');
    // 	$user->password = bcrypt($request->input('password'));
    // 	$user->active = 1;
    // 	$user->clz_key = $request->input('clz_key');
    // 	$user->role_id = $reqeust->input('role_id');
    // 	$user->save();

    // 	$profile->name = $reqeust->input('name');
    // 	$profile->user_id = $user->id;
    // 	$profile->faculty_id = $request->input('faculty_id');
    // 	$profile->save();

    // 	return redirect('admin/facultymember');
    // }

    public function postKey(Request $reqeust){
    	$key = new Key;

    	$key->key = $reqeust->input('key');
        $key->type = $reqeust->input('type');
    	$key->status = 0;
    	$key->save();

    	return redirect('admin/key');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\File;
use App\Course;
use App\CourseProfile;
use App\Faculty;
use Auth;

class FileController extends Controller
{

	/**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checkother');
    }
    
    public function getIndex(Request $request){
    	if(Auth::user()->role->permission == 5){
    		$faculty = Auth::user()->profile->faculty; //student faculty
    		$course_ids = $faculty->courses->lists('id')->toArray();
    		$faculty = $faculty->courses;
    	}else{
    		$faculty = Auth::user()->profile->courseprofiles; //teacher course profile relation
    		$course_ids = $faculty->lists('course_id')->toArray();
    	}
    	$id = null;
    	if(count($course_ids)){
    		$id = $course_ids[0];
    	}
    	if($request->has('course')){
    		$id = $request->input('course');
    		if(!in_array($request->input('course'), $course_ids)){
    			return redirect()->back()->with(['error'=>'Invalid Request']);
    		}
    	}
    	$files = File::where('course_id', $id)->get();
    	return view('file')->with([
    								'title' => 'Files',
    								'faculty' => $faculty,
    								'files'	=> $files,
    								'course_id' => $id
    								]);
    }

    // public function getAddfiles(){
    // 	return view('add-file');
    // }

    public function postCreate(Request $request, File $file){
    	if($request->input('title') == ""){
    		\Session::flash('error', 'File title required.');
    	}elseif(!$request->hasFile('file')){
    		\Session::flash('error', 'Please post a file.');
    	}else{
	    	$course = Course::find($request->input('course'));
	    	$faculty = Faculty::find($course->faculty_id);
	    	// checking file is valid.
		    if ($request->file('file')) {
		      	$path = public_path() . '/uploads/';
		      	$datapath = date('Y').'/'.$faculty->name.'/'.$course->name.'/';
		        $fullpath = $path.$datapath;

		        if(!file_exists($path)){
		            mkdir($path, 0777, true);
		        }

		        if(!file_exists($fullpath)){
		            mkdir($fullpath, 0777, true);
		        }
		        
		      // $destinationPath = 'uploads/image'; // upload path
		      $extension = $request->file('file')->getClientOriginalExtension(); // getting image extension
		      $fileName = $request->input('title').'.'.$extension; // renameing image
		      $request->file('file')->move($fullpath, $fileName); // uploading file to given path
		      // sending back with message
		      
		      $file->user_id = Auth::user()->id;
		      $file->course_id = $course->id;
		      $file->title = $request->input('title');
		      $file->path = $datapath.$fileName;
		      $file->notes = $request->input('notes');

		      $file->save();

		      \Session::flash('message', 'Uploaded Successfully!!');
		      
		    }
		    else {
		      // sending back with error message.
		      \Session::flash('error', 'Upload Failed!!');
		    }
		}
		return redirect('/file');
    }


    public function getDelete($id){
    	$file = File::find($id);
    	if(Auth::user()->id == $file->user_id){
    		$file->delete();
    		$message = ['message'=>'File Removed Successfully'];
    	}else{
    		$message = ['error'=>'Invalid Request'];
    	}

    	return redirect('/file')->with($message);
    }


    public function getDownload($id){
       $file = File::find($id);
       $filename = $file->path;
       $fullpath = public_path().'/uploads/'.$filename;
       return response()->download($fullpath);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\File;
use App\Course;
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
    
    public function getIndex(){
    	return view('file')->with([
    								'title' => 'Files',
    								]);
    }

    public function getAddfiles(){
    	return view('add-file');
    }

    public function postCreate(FileRequest $request, File $file){
    	$course = Course::find($request->course_id);
    	$faculty = Faculty::find($course->faculty_id);
    	// checking file is valid.
	    if ($request->file('notes')->isValid()) {
	      $path = public_path() . '/uploads/notes/'.$faculty->name.'/'.$course->name.'/';
	        
	        if(!file_exists($path)){
	            mkdir($path, 0777, true);
	        }
	        
	      // $destinationPath = 'uploads/image'; // upload path
	      $extension = $request->file('notes')->getClientOriginalExtension(); // getting image extension
	      $fileName = $request->input('title').'.'.$extension; // renameing image
	      $request->file('notes')->move($path, $fileName); // uploading file to given path
	      // sending back with message
	      
	      $file->user_id = Auth::user()->id;
	      $file->course_id = $course->id;
	      $file->title = $request->input('title');
	      $file->path = $path.$fileName;
	      $file->notes = $request->input('notes');

	      $file->save();

	      Session::flash('message', 'Uploaded Successfully');
	      return redirect('/notes');
	    }
	    else {
	      // sending back with error message.
	      Session::flash('error', 'uploaded file is not valid');
	      return redirect('/notes');
	    }	
    }


    public function getDelete($id){
    	$file = File::find($id);
    	$file->delete();

    	return redirect('/notes');
    }
}

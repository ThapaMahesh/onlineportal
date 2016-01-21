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
use App\Forum;
use App\Reply;
use Auth;


class ForumController extends Controller
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
		return view('forum.questions')->with([
												'title' => 'Forum' 
												]);
	}

	public function postAsk(Request $request){
		$forum = new Forum;

		$forum->question = $request->input('question');
		$forum->user_id = $request->input('user_id');
		$forum->solved = 0;
		$forum->tags = $request->input('tags');
		$forum->save();

		return redirect('forum/reply/'.$forum->id);
	}

	public function getReply($id){
		return view('forum.reply')->with([
										'title' => 'Discussion' 
										]);
	}

	public function postReply(Request $request){
		$reply = new Reply;

		$reply->forum_id = $request->input('forum_id');
		$reply->reply = $request->input('reply');
		$reply->user_id = $request->input('user_id');
		$reply->solution = 0;
		$reply->save();

		return redirect('forum/reply/'.$reply->forum_id);
	}

	public function postEditthread(Request $request){
		$forum = Forum::find($request->input('forum_id'));

		$forum->question = $request->input('question');
		// $forum->user_id = $request->input('user_id');
		// $forum->solved = 0;
		$forum->tags = $request->input('tags');
		$forum->save();

		return redirect('forum/reply/'.$forum->id);
	}

	public function postEditreply(Request $request){
		$reply = Reply::find($request->input('reply_id'));

		// $reply->forum_id = $request->input('forum_id');
		$reply->reply = $request->input('reply');
		// $reply->user_id = $request->input('user_id');
		// $reply->solution = 0;
		$reply->save();

		return redirect('forum/reply/'.$reply->forum_id);
	}

	public function getSolved($id){
		$reply = Reply::find($id);

		// $reply->forum_id = $request->input('forum_id');
		// $reply->reply = $request->input('reply');
		// $reply->user_id = $request->input('user_id');
		$reply->solution = 1;
		$reply->save();

		$forum = Forum::find($reply->forum_id);

		// $forum->question = $request->input('question');
		// $forum->user_id = $request->input('user_id');
		$forum->solved = 1;
		// $forum->tags = $request->input('tags');
		$forum->save();

		

		return redirect('forum/reply/'.$reply->forum_id);
	}

	public function getRemovereply($id){
		$reply = Reply::find($id);
		$forum_id = $reply->forum_id;
		$reply->delete();

		return redirect('forum/reply/'.$forum_id);	
	}

	public function getRemovethread($id){
		$forum = Forum::find($id);
		$forum->delete();

		return redirect('forum/');
	}
}
?>
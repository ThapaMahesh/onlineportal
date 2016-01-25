<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Faculty;
use App\User;
use App\Profile;
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

	public function getIndex(Request $request){
		$questionIds = [];
		$query = "";
		$inputTags = [];
		if($request->has('q')){
			$search = Forum::where('question', 'like', '%'.$request->input('q').'%')->lists('id')->toArray();
			$questionIds = array_merge($questionIds, $search);
			$query = $request->input('q');
		}
		if($request->has('tags')){
			if(count($questionIds)){
				$search = Forum::whereIn('id', $questionIds)->get();
			}else{
				$search = Forum::all();
			}
			$inputTags = $request->input('tags');
			foreach ($search as $eachsearch) {
				$tags = explode(', ', $eachsearch->tags);
				$result = array_intersect($tags, $request->input('tags'));
				if(count($result)){
					array_push($questionIds, $eachsearch->id);
				}
			}	
		}
		$questionIds = array_unique($questionIds);
		if($request->has('q') || $request->has('tags')){
			$forum = Forum::whereIn('id', $questionIds)->paginate(10);
		}else{
			$forum = Forum::orderBy('id', 'desc')->paginate(10);
		}
		$tagForum = new Forum;
		$tags = $tagForum->tags();
		return view('forum.questions')->with([
												'title' => 'Forum',
												'tags' => $tags,
												'forum' => $forum,
												'query' => $query,
												'inputTags' => $inputTags
												]);
	}

	public function postAsk(Request $request){
		$forum = new Forum;

		$forum->question = $request->input('question');
		$forum->user_id = Auth::user()->id;
		$forum->description = $request->input('description');
		$forum->solved = 0;
		$forum->tags = str_replace(',', ', ', $request->input('tags'));
		$forum->save();

		return redirect('forum/reply/'.$forum->id);
	}

	public function getReply($id){
		$forum = Forum::find($id);
		if($forum){
			return view('forum.reply')->with([
										'title' => 'Discussion',
										'forum' => $forum
										]);
		}else{
			return redirect('forum')->with(['error'=>'Invalid Request']);
		}
	}

	public function postReply(Request $request){
		$reply = new Reply;

		$reply->forum_id = $request->input('forum_id');
		$reply->reply = $request->input('reply');
		$reply->user_id = Auth::user()->id;
		$reply->solution = 0;
		$reply->save();

		return redirect('forum/reply/'.$reply->forum_id);
	}

	// public function postEditthread(Request $request){
	// 	$forum = Forum::find($request->input('forum_id'));

	// 	$forum->question = $request->input('question');
	// 	// $forum->user_id = $request->input('user_id');
	// 	// $forum->solved = 0;
	// 	$forum->tags = $request->input('tags');
	// 	$forum->save();

	// 	return redirect('forum/reply/'.$forum->id);
	// }

	// public function postEditreply(Request $request){
	// 	$reply = Reply::find($request->input('reply_id'));

	// 	// $reply->forum_id = $request->input('forum_id');
	// 	$reply->reply = $request->input('reply');
	// 	// $reply->user_id = $request->input('user_id');
	// 	// $reply->solution = 0;
	// 	$reply->save();

	// 	return redirect('forum/reply/'.$reply->forum_id);
	// }

	// public function getSolved($id){
	// 	$reply = Reply::find($id);

	// 	// $reply->forum_id = $request->input('forum_id');
	// 	// $reply->reply = $request->input('reply');
	// 	// $reply->user_id = $request->input('user_id');
	// 	$reply->solution = 1;
	// 	$reply->save();

	// 	$forum = Forum::find($reply->forum_id);

	// 	// $forum->question = $request->input('question');
	// 	// $forum->user_id = $request->input('user_id');
	// 	$forum->solved = 1;
	// 	// $forum->tags = $request->input('tags');
	// 	$forum->save();

		

	// 	return redirect('forum/reply/'.$reply->forum_id);
	// }

	public function getRemovereply($id){
		$reply = Reply::find($id);
		if($reply){
			if($reply->user_id != Auth::user()->id){
				return redirect()->back()->with(['error'=>'Invalid Request.']);
			}
			$forum_id = $reply->forum_id;
			$reply->delete();
		}else{
			return redirect()->back()->with(['error'=>'Invalid Request.']);
		}

		return redirect('forum/reply/'.$forum_id);	
	}

	public function getRemovethread($id){
		$forum = Forum::find($id);
		if($forum){
			if($forum->user_id != Auth::user()->id){
				return redirect('forum/')->with(['error'=>'Invalid Request.']);
			}
			$forum->delete();
		}else{
			return redirect('forum/')->with(['error'=>'Invalid Request.']);
		}

		return redirect('forum/');
	}

}
?>
@extends('default')
@section('content')
<!-- start: Content -->
<div id="content" class="panel box-v7">
@if(session('error'))
  <p class="alert alert-danger">{{session('error')}}</p>
@endif
                        <div class="panel-body">
                          <div class="col-md-12 padding-0 box-v7-header">
                              <div class="col-md-12 padding-0">
                                  <div class="col-md-10 padding-0">
                                  <img src="{{$forum->user->profile->imgloc($forum->user->profile->id)}}" class="box-v7-avatar pull-left" />
                                  <h4>{{$forum->user->username}}</h4>
                                  <p>{{$forum->created_at}}</p>
                                  </div>
                                  <div class="col-md-2 padding-0">
                                    <div class="btn-group right-option-v1">
                                    @if($forum->user_id == $auth->id)
                                    <a href="{{url('forum/removethread/'.$forum->id)}}">
                                      <span class="fa fa-remove icons icon text-right" style="color:red;" data-toggle="tooltip" data-placement="left" title="Remove Thread"></span>
                                    </a>
                                    @endif
                                  </div>
                                  </div>
                              </div>
                          </div>
                         <div class="col-md-12 padding-0 box-v7-body">
                              <h3>{{$forum->question}}</h3>
                              <p>{{$forum->description}}</p>
                          </div>
                          <div class="col-md-12 padding-0 box-v7-comment">
                          @foreach($forum->replies as $eachreply)
                              <div class="media">
                                <div class="media-left" style="min-width:75px;">
                                  <a href="#">
                                    <img src="{{$eachreply->user->profile->imgloc($eachreply->user->profile->id)}}" class="media-object box-v7-avatar"/>
                                    {{$eachreply->user->username}}
                                    {{date('Y-m-d', strtotime($eachreply->created_at))}}
                                  </a>
                                </div>
                                <div class="media-body">
                                  <!-- <h4 class="media-heading">Fulan</h4> -->
                                   <p class="col-sm-11">{{$eachreply->reply}}</p>
                                   @if($eachreply->user_id == $auth->id)
                                   <a class="col-sm-1" href="{{url('forum/removereply/'.$eachreply->id)}}">
                                      <span class="fa fa-remove icons icon text-right" style="color:red;" data-toggle="tooltip" data-placement="left" title="Remove Reply"></span>
                                    </a>
                                    @endif
                                </div>
                              </div>
                              <br/><hr style="border-color:#ABA7A7;" />
                              @endforeach

                              <div class="media">
                                <div class="media-left" style="min-width:75px;">
                                  <a href="#">
                                    <img src="{{$auth->profile->imgloc($auth->profile->id)}}" class="media-object box-v7-avatar"/>
                                    {{$auth->username}}
                                  </a>
                                </div>
                                
                                <div class="media-body">
                                {{Form::open(['url'=>'forum/reply'])}}
                                  <input type="hidden" name="forum_id" value="{{$forum->id}}">
                                  <textarea class="box-v7-commenttextbox" name="reply" placeholder="write comments..."></textarea>
                                  <input type="submit" name="submit" value="Post" class="btn btn-primary">
                                  {{Form::close()}}
                                </div>
                                
                              </div>
                          </div>
                        </div>
                    </div>
        <!-- end: content -->

@stop
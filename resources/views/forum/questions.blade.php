@extends('default')
@section('content')
<!-- start: Content -->
          <div id="content" class="search-v1">
          @if(session('error'))
            <p class="alert alert-danger">{{session('error')}}</p>
          @endif
            <div class="panel">
              <div class="panel-body">
                <div class="col-md-10">
                     <!-- <div class="input-group"> -->
                      <!-- <input type="text" class="form-control" aria-label="..."> -->
                      <!-- <div class="input-group-btn"> -->
                      {{Form::open(['url'=>'forum/index', 'method'=>'get'])}}
                      <div class="form-group">
                        <input type="text" name="q" value="{{$query}}" class="col-sm-4">&nbsp;&nbsp;
                        <select class="select2-A col-sm-4" name="tags[]" multiple="multiple">
                          @foreach($tags as $eachtag)
                            <?php $selected = ""; ?>
                            @if(in_array($eachtag, $inputTags))
                              <?php $selected = "selected"; ?>
                            @endif
                            <option {{$selected}} value="{{$eachtag}}">{{$eachtag}}</option>
                          @endforeach
                        </select>
                        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                        </div>
                        {{Form::close()}}
                      <!-- </div> --><!-- /btn-group -->
                    <!-- </div> --><!-- /input-group -->
                </div>
                 <div class="col-md-2">
                   <span class="icon-question icons icon text-right"></span> <a href="javascript:void(0)" id="add-question-modal" data-toggle="modal" data-target="#questionmodal">Ask New Question</a>
                 </div>
              </div>
            </div>
            <div class="col-md-12">
               <div class="col-md-12 tabs-area box-shadow-none">
                  <div id="tabsDemo6Content" class="tab-content tab-content-v6 col-md-12">
                    <div role="tabpanel" class="tab-pane search-v1-menu1 fade active in" id="tabs-demo7-area1" aria-labelledby="tabs-demo7-area1">
                      <h4> {{count($forum)}} results found</h4></br></br>
                      <div class="col-md-9 padding-0">
                          @foreach($forum as $eachforum)
                          <div class="media">
                            <div class="media-left" style="min-width:85px;">
                              <img style="width:50px; border-radius:100% " src="{{$eachforum->user->profile->imgloc($eachforum->user->profile->id)}}"> 
                              <small style="font-size:55%">{{$eachforum->user->username}}</small>
                              </div>
                            <div class="media-body">
                              <a href="{{url('/forum/reply/'.$eachforum->id)}}" class="media-heading">{{$eachforum->question}}</a>
                               <p>{{$eachforum->description}}</p>
                               <?php $questiontags = explode(', ', $eachforum->tags); ?>
                               @foreach($questiontags as $eachtag)
                                <span class="label label-default">{{$eachtag}}</span>
                               @endforeach
                            </div>
                          </div>
                          @endforeach
                      </div>
                    </div>
                  </div>
                </div>
                {!! $forum->links() !!}
            </div>
          </div>
          <!-- end: content -->

          <!-- modal starts -->
          <div class="modal fade" id="questionmodal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
              {{ Form::open(['url'=>'forum/ask', 'class'=>'question-form']) }}
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Ask</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group row"><label class="col-sm-2 control-label text-right">Question</label>
                    <div class="col-sm-10"><input type="text" name="question" class="form-control"></div>
                  </div><br />
                  <div class="form-group row"><label class="col-sm-2 control-label text-right">Description</label>
                    <div class="col-sm-10"><textarea name="description" class="form-control"></textarea></div>
                  </div><br />
                  <div class="form-group row"><label class="col-sm-2 control-label text-right">Tags</label>
                    <div class="col-sm-10"><input type="text" data-role="tagsinput" name="tags" multiple class="form-control"></div>
                  </div><br />
                <div class="modal-footer">
                  <input type="hidden" name="key" id="key_value">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="save-btn btn btn-primary">Save changes</button>
                </div>
                {{ Form::close() }}
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
@stop

@section('js')
<script src="{{ asset('asset/js/bootstrap-tagsinput.js') }}"></script>
<script type="text/javascript">
$(".select2-A").select2({
      placeholder: "Select Tags",
      allowClear: true
    });

$('.save-btn').click(function(){
  $('.question-form').submit();
});
</script>
@stop
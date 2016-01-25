@extends('default')

@section('content')
<!-- start: Content -->
            <div id="content">
              @if(session('error'))
                <p class="alert alert-danger">{{session('error')}}</p>
              @elseif(session('message'))
                <p class="alert alert-success">{{session('message')}}</p>
              @endif
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-10">
                        <h3 class="animated fadeInLeft">Course Files</h3>
                        {{Form::open(['url'=>'file/index', 'method'=>'get', 'class'=>'course_file'])}}
                        <p class="animated fadeInDown">
                          @if($auth->role->permission == 5)
                          <select class="select_course" name="course">
                            @foreach($faculty as $eachcourse)
                            <?php $selected = ""; ?>
                            @if($course_id == $eachcourse->id)
                              <?php $selected = 'selected'; ?>
                            @endif
                            <option {{$selected}} value="{{$eachcourse->id}}">{{$eachcourse->name.' '.$eachcourse->course_code}}</option>
                            @endforeach
                          </select>
                          @else
                          <select class="select_course" name="course">
                            @foreach($faculty as $eachcourseprofile)
                            <?php $selected = ""; ?>
                            @if($course_id == $eachcourseprofile->course_id)
                              <?php $selected = 'selected'; ?>
                            @endif
                            <option {{$selected}} value="{{$eachcourseprofile->course_id}}">{{$eachcourseprofile->course->name.' '.$eachcourseprofile->course->course_code}}</option>
                            @endforeach
                          </select>
                          @endif
                        </p>
                        {{Form::close()}}
                        <!-- <span class="icon-user-follow icons icon text-right"></span> -->
                    </div>
                    <div class="col-md-2">
                        <h3 class="animated fadeInLeft"></h3>
                        @if($auth->role->permission == 15)
                        <p class="animated fadeInDown">
                          <span class="icon-notebook icons icon text-right"></span> <a href="javascript:void(0)" id="add_notes" data-toggle="modal" data-target="#filemodal">Add New File</a>
                        </p>
                        @endif
                    </div>
                  </div>
              </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <!-- <div class="panel-heading"><h3></h3></div> -->
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                            <th>File Name</th>
                            <th>Notes</th>
                            <th>Download</th>
                            <th>Uploaded By</th>
                            @if($auth->role->permission == 15)
                            <th>Remove</th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($files as $eachfile)
                        <tr>
                            <th>{{$eachfile->title}}</th>
                            <th><span data-toggle="tooltip" data-placement="left" title="{{$eachfile->notes}}">{{ substr($eachfile->notes, 0, 20) }}{{ (strlen($eachfile->notes) >=20 )?"..":"" }}</span></th>
                            <th><a href="{{url('/').'/file/download/'.$eachfile->id}}"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a></th>
                            <th>{{($eachfile->user_id == $auth->id)?'Self':$eachfile->user->profile->name}}</th>
                            @if($auth->role->permission == 15)
                            @if($eachfile->user_id == $auth->id)
                            <th><a href="{{url('file/delete/'.$eachfile->id)}}"><span class="fa fa-remove icons icon text-right" style="color:red;" data-toggle="tooltip" data-placement="left" title="Remove"></span></a></th>
                            @else
                            <th>&nbsp;</th>
                            @endif
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>  
              </div>
            </div>
          <!-- end: content -->

          @if($auth->role->permission == 15)
          <!-- modal starts -->
          <div class="modal fade" id="filemodal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
              {{ Form::open(['url'=>'file/create', 'files'=>true]) }}
              <input type="hidden" name="user_id" value="{{$auth->id}}">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Add new file</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group row"><label class="col-sm-2 control-label text-right">File*</label>
                    <div class="col-sm-10"><input type="file" name="file" class="form-control"></div>
                  </div><br />
                  <div class="form-group row"><label class="col-sm-2 control-label text-right">Title*</label>
                    <div class="col-sm-10"><input type="text" name="title" class="form-control"></div>
                  </div><br />
                  <div class="form-group row"><label class="col-sm-2 control-label text-right">Course*</label>
                    <div class="col-sm-10">
                      <select name="course" class="form-control">
                        @foreach($faculty as $eachfaculty)
                          <option value="{{$eachfaculty->course_id}}">{{$eachfaculty->course->faculty->name.': '.$eachfaculty->course->name.' '.$eachfaculty->course->course_code}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div><br />
                  <div class="form-group row"><label class="col-sm-2 control-label text-right">Important Notes</label>
                    <div class="col-sm-10"><textarea name="notes" class="form-control"></textarea></div>
                  </div><br />
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="key" id="key_value">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                {{ Form::close() }}
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          @endif
@stop

@section('js')
<script type="text/javascript">
  $('#add-key-modal').click(function(){
    $('#key').text('');
    $('#key_value').val('');
  });

  $('.select_course').change(function(){
    $('form.course_file').submit();
  });
</script>
@stop
@extends('default')

@section('content')
<!-- start: Content -->
            <div id="content">
            @if(session()->has('message'))
            <?php $alert = 'danger'; ?>
              @if(session('type') == 'valid')
              <?php $alert = 'success'; ?>
              @endif
                <p class="alert alert-{{$alert}}">{{session('message')}}</p>
            @endif
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-8">
                        <h3 class="animated fadeInLeft">Faculty</h3>
                        <!-- <p class="animated fadeInDown">
                          Table <span class="fa-angle-right fa"></span> Data Tables
                        </p> -->
                        <!-- <span class="icon-user-follow icons icon text-right"></span> -->
                    </div>
                    <div class="col-md-4">
                        <h3 class="animated fadeInLeft"></h3>
                        <p class="animated fadeInDown">
                          <span class="icon-graduation icons icon text-right"></span> <a href="javascript:void(0)" id="add-faculty-modal" data-toggle="modal" data-target="#facultymodal"> Add New Faculty</a>
                          &nbsp;
                          <span class="icon-docs icons icon text-right"></span> <a href="javascript:void(0)" id="add-course-modal" data-toggle="modal" data-target="#coursemodal"> Add New Course</a>
                        </p>
                        
                    </div>
                  </div>
              </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <!-- <div class="panel-heading"><h3>Data Tables</h3></div> -->
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                            <th>Name</th>
                            <th>Courses</th>
                            <!-- <th>Email</th>
                            <th>Courses</th>
                            <th>Status</th>
                            <th>Remove</th> -->
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($faculty as $eachfaculty)

                          <tr>
                            <td>{{$eachfaculty->name}}</td>
                            <td>
                              <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                @foreach($eachfaculty->courses as $eachcourse)
                                <tr>
                                  <td>{{$eachcourse->name}}</td>
                                  <td>{{$eachcourse->course_code}}</td>
                                  <td>
                                    <a href="{{url('admin/courseremove/'.$eachcourse->id)}}"><span class="fa fa-remove icons icon text-right" style="color:red;" data-toggle="tooltip" data-placement="left" title="Remove"></span></a>
                                  </td>
                                </tr>
                                @endforeach
                              </table>
                            </td>
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

          <!-- faculty modal starts -->
          <div class="modal fade" id="facultymodal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
              {{ Form::open(['url'=>'admin/addfaculty']) }}
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Add new Facutly</h4>
                </div>
                <div class="modal-body">
                  
                  <div class="form-group row"><label class="col-sm-2 control-label text-right">name</label>
                    <div class="col-sm-10"><input type="text" name="name" class="form-control"></div>
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

          <!-- course modal starts -->
          <div class="modal fade" id="coursemodal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
              {{ Form::open(['url'=>'admin/addcourse']) }}
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Add new Course</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group row"><label class="col-sm-2 control-label text-right">Faculty</label>
                    <div class="col-sm-10">
                      <select name="id" class="form-control">
                      @foreach($faculty as $eachfaculty)
                        <option value="{{$eachfaculty->id}}">{{$eachfaculty->name}}</option>
                        <!-- <option value="2">Student</option> -->
                      @endforeach
                      </select>
                    </div>
                  </div><br />
                  <div class="form-group row"><label class="col-sm-2 control-label text-right">Course</label>
                    <div class="col-sm-10"><input type="text" name="name" class="form-control"></div>
                  </div><br />
                  <div class="form-group row"><label class="col-sm-2 control-label text-right">Course Code</label>
                    <div class="col-sm-10"><input type="text" name="course_code" class="form-control"></div>
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
          
          <input type="hidden" id="base_url" value="{{url('/')}}">
@stop
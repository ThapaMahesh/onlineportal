@extends('default')

@section('content')
<!-- start: content -->
            <div id="content">
            @if(session()->has('message'))
            <?php $alert = 'danger'; ?>
              @if(session('type') == 'valid')
              <?php $alert = 'success'; ?>
              @endif
                <p class="alert alert-{{$alert}}">{{session('message')}}</p>
            @endif
                <div class="col-md-12" style="padding:20px;">
                    <div class="col-md-12 padding-0">
                        <div class="col-md-12 padding-0">
                            <div class="col-md-12 padding-0">
                                <div class="col-md-4">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">Students</h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-people icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body text-center">
                                        <h1>{{count($students)}}</h1>
                                        <p>Current Student Count</p>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">Faculty Members</h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-user icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body text-center">
                                        <h1>{{$teachercount}}</h1>
                                        <p>Current Faculty Members Count</p>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">Faculties</h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-graduation icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body text-center">
                                        <h1>{{$facultycount}}</h1>
                                        <p>Current Faculty</p>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table Starts -->
                <div class="col-md-12 padding-0">
                  <div class="col-md-12">
                    <div class="panel">
                      <div class="panel-heading"><h3>Data Tables</h3></div>
                      <div class="panel-body">
                        <div class="responsive-table">
                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Faculty</th>
                            <th>Semester/Year</th>
                            <th>Status</th>
                            <th>Remove</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $eachstudent)

                          <tr>
                            <td>{{$eachstudent->profile->name}}</td>
                            <td>{{$eachstudent->profile->phone}}</td>
                            <td>{{$eachstudent->profile->email}}</td>
                            <td>{{$eachstudent->profile->faculty->name}}</td>
                            <td>{{$eachstudent->profile->semester}}</td>
                            <td>{{ ($eachstudent->active == 1)?'Active':'Disabled' }}</td>
                            <td>
                            <a href="{{url('admin/status/'.$eachstudent->id)}}"><span class="fa fa-retweet icons icon text-right" style="color:green;" data-toggle="tooltip" data-placement="left" title="Disable/Enable"></span></a>
                            &nbsp;
                            <a href="{{url('admin/remove/'.$eachstudent->id)}}"><span class="fa fa-remove icons icon text-right" style="color:red;" data-toggle="tooltip" data-placement="left" title="Remove"></span></a>
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
@stop
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
                    <div class="col-md-10">
                        <h3 class="animated fadeInLeft">Faculty Members</h3>
                        <!-- <p class="animated fadeInDown">
                          Table <span class="fa-angle-right fa"></span> Data Tables
                        </p> -->
                        <!-- <span class="icon-user-follow icons icon text-right"></span> -->
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
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Courses</th>
                            <th>Status</th>
                            <th>Remove</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($teacher as $eachteacher)

                          <tr>
                            <td>{{$eachteacher->profile->name}}</td>
                            <td>{{$eachteacher->profile->phone}}</td>
                            <td>{{$eachteacher->profile->email}}</td>
                            <td>
                            <table id="datatables-example1" class="table table-striped" width="100%" cellspacing="0">
                            @foreach($eachteacher->profile->courseprofiles as $eachcourse)
                              <tr>
                                <td>{{$eachcourse->course->faculty->name}}:</td>
                                <td>{{$eachcourse->course->name.' '.$eachcourse->course->course_code}}</td>
                              </tr>
                            @endforeach
                            </table>
                            </td>
                            <td>{{ ($eachteacher->active == 1)?'Active':'Disabled' }}</td>
                            <td>
                            <a href="{{url('admin/status/'.$eachteacher->id)}}"><span class="fa fa-retweet icons icon text-right" style="color:green;" data-toggle="tooltip" data-placement="left" title="Disable/Enable"></span></a>
                            &nbsp;
                            <a href="{{url('admin/remove/'.$eachteacher->id)}}"><span class="fa fa-remove icons icon text-right" style="color:red;" data-toggle="tooltip" data-placement="left" title="Remove"></span></a>
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
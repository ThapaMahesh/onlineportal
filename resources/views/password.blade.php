@extends('default')
@section('content')
<!-- start: Content -->
            <div id="content">
              @if (session('message'))
                    <div class="alert alert-{{session('type')}}">
                      <!-- <strong>Whoops!</strong> There were some problems with your input.<br><br> -->
                      <!-- <ul> -->
                          <p>{{ session('message') }}</p>
                      <!-- </ul> -->
                    </div>
                  @endif
                <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Change Password</h3>
                        <!-- <p class="animated fadeInDown">
                          Form <span class="fa-angle-right fa"></span> Form Element
                        </p> -->
                    </div>
                  </div>
                </div>
                <div class="form-element">
                  <div class="col-md-12 padding-0">
                    <div class="col-md-8">
                      <div class="panel form-element-padding">
                        <div class="panel-heading">
                         <h4>Info</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                          <div class="col-md-12">
                            {{ Form::open(['url'=>'profile/setting', 'class'=>'form-horizontal']) }}
                            <input type="hidden" value="{{$user_id}}" name="id">
                            <div class="form-group"><label class="col-sm-2 control-label text-right">Old Password</label>
                              <div class="col-sm-10"><input type="password" name="old_password" class="form-control"></div>
                            </div>
                            @if($errors->has('old_password'))
                              <span class="col-sm-2"></span>
                              <span class="col-sm-10 alert alert-danger">{{$errors->first('old_password')}}</span>
                            @endif
                            <div class="form-group"><label class="col-sm-2 control-label text-right">New Password</label>
                              <div class="col-sm-10"><input type="password" name="new_password" class="form-control"></div>
                            </div>
                            @if($errors->has('new_password'))
                              <span class="col-sm-2"></span>
                              <span class="col-sm-10 alert alert-danger">{{$errors->first('new_password')}}</span>
                            @endif
                            <div class="form-group"><label class="col-sm-2 control-label text-right">Confirm Password</label>
                              <div class="col-sm-10"><input type="password" name="confirm_password" class="form-control"></div>
                            </div>
                            @if($errors->has('confirm_password'))
                              <span class="col-sm-2"></span>
                              <span class="col-sm-10 alert alert-danger">{{$errors->first('confirm_password')}}</span>
                            @endif
                            <div class="form-group"><label class="col-sm-2 control-label text-right"></label>
                              <div class="col-sm-10">
                                <input class="submit btn btn-success" type="submit" value="Submit">
                              </div>
                            </div>
                            {{ Form::close() }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>

</div>

@stop

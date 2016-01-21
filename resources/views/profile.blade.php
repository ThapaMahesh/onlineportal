@extends('default')
@section('content')
<div id="content" style="margin-top:75px !important;" class="col-md-12 col-sm-12 profile-v1-body">
                <div class="col-md-4">
                   <!-- <div class="box-v5 panel">
                    <div class="panel-heading padding-0 bg-white border-none">
                        <textarea placeholder="what do you think?"></textarea>
                    </div>
                    <div class="panel-body">
                      <div class="col-md-12 padding-0">
                        <div class="col-md-6 col-sm-6 col-xs-6 tool">
                          <a href="#">
                            <span class="fa fa-map-marker fa-2x"></span>
                          </a>
                          <a href="#">
                            <span class="fa fa-camera fa-2x"></span>
                          </a>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 padding-0">
                          <button class="btn btn-round pull-right">
                            <span>SEND</span>
                            <span class="icon-arrow profile-media-right icons"></span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div> -->
                    <div class="panel box-v7">
                        <div class="panel-body">
                          <img style="width:100%; height:auto;" src="{{$profile->image}}"/>
                          <h2>
                            <span class="icon-{{($profile->gender == 'Male')?'symbol-male':'symble-female'}} icons" style="font-size:0.5em;"></span>
                            {{$profile->name}}
                          </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                     <div class="panel box-v3">
                                <div class="panel-heading bg-white border-none">
                                  <h4>Details</h4>
                                </div>
                                <div class="panel-body">
                                  <div class="row profile-media">
                                  <div class="col-md-6">
                                    <div class="media-left">
                                        <span class="icon-home icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                      <p class="media-heading">Address: </p>
                                      <p>{{$profile->address}}</p>
                                        <!-- <div class="progress progress-mini">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
                                            <span class="sr-only">60% Complete</span>
                                          </div>
                                        </div> -->
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="media-left">
                                        <span class="icon-envelope icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                      <h5 class="media-heading">Email</h5>
                                      <p>{{$profile->email}}</p>
                                        <!-- <div class="progress progress-mini">
                                          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="19" aria-valuemin="0" aria-valuemax="100" style="width: 19%;">
                                            <span class="sr-only">60% Complete</span>
                                          </div>
                                        </div> -->
                                    </div>
                                  </div>
                                  </div>

                                  <div class="row profile-media">
                                  <div class="col-md-6">
                                    <div class="media-left">
                                        <span class="icon-calendar icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                      <h5 class="media-heading">Date of Birth</h5>
                                      <p>{{$profile->dob}}</p>
                                        <!-- <div class="progress progress-mini">
                                          <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%;">
                                            <span class="sr-only">60% Complete</span>
                                          </div>
                                        </div> -->
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="media-left">
                                        <span class="icon-phone icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                      <h5 class="media-heading">Phone</h5>
                                      <p>{{$profile->phone}}</p>
                                        <!-- <div class="progress progress-mini">
                                          <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%;">
                                            <span class="sr-only">60% Complete</span>
                                          </div>
                                        </div> -->
                                    </div>
                                  </div>
                                  </div>

                                  <div class="row profile-media">
                                   <div class="col-md-6">
                                    <div class="media-left">
                                        <span class="icon-calendar icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                      <h5 class="media-heading">Year Joined</h5>
                                      <p>{{$profile->year_joined}}</p>
                                        <!-- <div class="progress progress-mini">
                                          <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
                                            <span class="sr-only">60% Complete</span>
                                          </div>
                                        </div> -->
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="media-left">
                                        <span class="icon-book-open icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                      <h5 class="media-heading">Semester/Year</h5>
                                      <p>{{$profile->semester}}</p>
                                        <!-- <div class="progress progress-mini">
                                          <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
                                            <span class="sr-only">60% Complete</span>
                                          </div>
                                        </div> -->
                                    </div>
                                  </div>
                                  </div>
                                </div>
                                <div class="panel-footer bg-white border-none">
                                    <center>
                                      <a href="{{url('profile/edit')}}"><input type="button" value="Edit" class="btn btn-danger box-shadow-none"/></a>
                                    </center>
                                </div>
                              </div>
                </div>
                </div>
@stop
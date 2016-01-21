@extends('default')
@section('content')
<!-- start: Content -->
            <div id="content">
                <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Edit Profile</h3>
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
                            {{ Form::open(['url'=>'profile/edit', 'class'=>'form-horizontal']) }}
                            <div class="form-group"><label class="col-sm-2 control-label text-right">Profile Image</label>
                              <div class="col-sm-10"><input type="file" id="img" name="image" class="form-control"></div>
                            </div>
                            <?php $src = ""; $style = "style=display:none;"; ?>
                            @if($profile->image != "")
                            <?php
                              $src = asset('asset/userimage/'.$profile->image);
                              $style = "";
                            ?>
                            @endif
                            <div class="form-group" {{$style}}><label class="col-sm-2 control-label text-right"></label>
                              <div class="col-sm-10">
                                <img  src="{{$src}}" style="width:200px;" id="show_img">
                              </div>
                              <!-- <a class="col-sm-2" href="javascript:void(0);" id="remove_img" data-toggle="tooltip" data-placement="left" title="Remove"><span class="fa fa-remove icons icon text-right" style="color:red;"></span></a> -->
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label text-right">Name</label>
                              <div class="col-sm-10"><input type="text" name="name" value="{{$profile->name}}" class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label text-right">Address</label>
                              <div class="col-sm-10"><input type="text" name="address" value="{{$profile->address}}" class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label text-right">Phone</label>
                              <div class="col-sm-10"><input type="text" name="phone" value="{{$profile->phone}}" class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label text-right">Email</label>
                              <div class="col-sm-10"><input type="text" name="email" value="{{$profile->email}}" class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label text-right">Gender</label>
                            <?php
                              $male = $female = "";
                              if($profile->gender == 'Male')
                                $male = "checked";
                              else if($profile->gender == 'Female')
                                $female = "checked";
                            ?>
                              <div class="col-sm-10">
                                <div class="col-sm-6 padding-0">
                                <label>
                                  <input type="radio" {{$male}} name="gender"> Male
                                </label>
                                </div>
                                <div class="col-sm-6 padding-0">
                                <label>
                                  <input type="radio" {{$female}} name="gender"> Female
                                </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label text-right">Date of Birth</label>
                              <div class="col-sm-10"><input type="date" name="dob" value="{{date('Y-m-d', strtotime($profile->dob))}}" class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label text-right">Year Joined</label>
                              <div class="col-sm-10"><input type="text" name="year_joined" value="{{$profile->year_joined}}" class="form-control"></div>
                            </div>
                            <?php $sem = $year = ""; ?>
                            @if($auth->role->permission == 5)
                            <div class="form-group"><label class="col-sm-2 control-label text-right">Type</label>
                              <?php
                                $opt = explode(' ', $profile->semester);
                                if(count($opt) == 2 && $opt[1] == 'Semester')
                                  $sem = "checked";
                                else if(count($opt) == 2 && $opt[1] == 'Year')
                                  $year = "checked";
                              ?>
                              <div class="col-sm-10">
                                <div class="col-sm-6 padding-0">
                                <label>
                                  <input type="radio" id="sem_select" {{$sem}} name="sem"> Semester
                                </div>
                                </label>
                                <div class="col-sm-6 padding-0">
                                <label>
                                  <input type="radio" id="year_select" {{$year}} name="sem"> Year
                                </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group select_option"><label class="col-sm-2 control-label text-right"></label>
                              <div class="col-sm-10">
                                <div class="col-sm-12 padding-0">
                                  <select name="semester" id="semester" class="form-control">
                                    <option value="1st Semester" {{ ($profile->semester == '1st Semester')?"selected":"" }}>1st Semester</option>
                                    <option value="2nd Semester" {{ ($profile->semester == '2nd Semester')?"selected":"" }}>2nd Semester</option>
                                    <option value="3rd Semester" {{ ($profile->semester == '3rd Semester')?"selected":"" }}>3rd Semester</option>
                                    <option value="4th Semester" {{ ($profile->semester == '4th Semester')?"selected":"" }}>4th Semester</option>
                                    <option value="5th Semester" {{ ($profile->semester == '5th Semester')?"selected":"" }}>5th Semester</option>
                                    <option value="6th Semester" {{ ($profile->semester == '6th Semester')?"selected":"" }}>6th Semester</option>
                                    <option value="7th Semester" {{ ($profile->semester == '7th Semester')?"selected":"" }}>7th Semester</option>
                                    <option value="8th Semester" {{ ($profile->semester == '8th Semester')?"selected":"" }}>8th Semester</option>

                                  </select>
                                </div>
                                <div class="col-sm-12 padding-0">
                                  <select name="semester" id="year" class="form-control">
                                    <option name="1st Year" {{ ($profile->semester == "1st Year")?"selected":"" }}>1st Year</option>
                                    <option name="2nd Year" {{ ($profile->semester == "2nd Year")?"selected":"" }}>2nd Year</option>
                                    <option name="3rd Year" {{ ($profile->semester == "3rd Year")?"selected":"" }}>3rd Year</option>
                                    <option name="4th Year" {{ ($profile->semester == "4th Year")?"selected":"" }}>4th Year</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            @elseif($auth->role->permission == 15)
                            
                        
                                  <div class="form-group"><label class="col-sm-2 control-label text-right">Your Courses</label>
                                    <div class="col-sm-10">
                                      <div class="col-sm-12 padding-0">
                                      <select class="select2-A" multiple="multiple">
                                      @foreach($course as $eachcourse)
                                        <option value="{{$eachcourse->id}}">{{$eachcourse->faculty->name.':'.$eachcourse->name.''.$eachcourse->course_code}}</option>
                                      @endforeach
                                      </select>
                                    </div>
                                  </div>
                                </div>
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
@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    <?php if($sem == "" && $year == ""){ ?>
    $('.select_option').hide();

    <?php } ?>
    <?php if($sem == ""){ ?>
    $('#semester').hide();

    <?php } ?>
    <?php if($year == ""){ ?>
    $('#year').hide();
    <?php } ?>
    $('#sem_select').click(function(){
      $('.select_option').show();
      $('#semester').show().removeAttr('disabled');
      $('#year').attr('disabled', 'disabled').hide();
    });

    $('#year_select').click(function(){
      $('.select_option').show();
      $('#year').show().removeAttr('disabled');
      $('#semester').attr('disabled', 'disabled').hide();
    });

    $('.select2').css({'margin-top':'0px'});
  });

  function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#show_img').closest('.form-group').show();
            $('#show_img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }else{
      $('#show_img').closest('.form-group').hide();
      $('#show_img').attr('src', "");
    }
}

$("#img").change(function(){
  console.log('asdf');
    readURL(this);
});

$(".select2-A").select2({
      placeholder: "Select Your Courses",
      allowClear: true
    });

</script>
@stop
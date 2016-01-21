@extends('default')

@section('content')
<!-- start: Content -->
            <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-10">
                        <h3 class="animated fadeInLeft">Secret Keys</h3>
                        <!-- <p class="animated fadeInDown">
                          Table <span class="fa-angle-right fa"></span> Data Tables
                        </p> -->
                        <!-- <span class="icon-user-follow icons icon text-right"></span> -->
                    </div>
                    <div class="col-md-2">
                        <h3 class="animated fadeInLeft"></h3>
                        <p class="animated fadeInDown">
                          <span class="icon-key icons icon text-right"></span> <a href="javascript:void(0)" id="add-key-modal" data-toggle="modal" data-target="#keymodal">Add New Key</a>
                        </p>
                        
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
                            <th>Key</th>
                            <th>Status</th>
                            <th>Type</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($key as $eachkey)

                          <tr>
                            <td>{{ $eachkey->key }}</td>
                            <td>{{ ($eachkey->status == 0)?'Not Used':'Used' }}</td>
                            <td>{{ ($eachkey->type == 1)?'Teacher Key':'Student Key' }}</td>
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

          <!-- modal starts -->
          <div class="modal fade" id="keymodal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
              {{ Form::open(['url'=>'admin/key']) }}
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Add new key</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group row"><label class="col-sm-2 control-label text-right">Key</label>
                    <div class="col-sm-5" id="key"></div>
                    <div class="col-sm-5"><button type="button" id="key_generate" class="btn btn-primary">Generate</button></div>
                  </div><br />
                  <!-- <div class="form-group row"><label class="col-sm-2 control-label text-right">Value</label>
                    <div class="col-sm-10"><input type="text" name="value" class="form-control"></div>
                  </div><br /> -->
                  <div class="form-group row"><label class="col-sm-2 control-label text-right">Type</label>
                    <div class="col-sm-10">
                      <select name="type" class="form-control">
                        <option value="1">Faculty Member</option>
                        <option value="2">Student</option>
                      </select>
                    </div>
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

@section('js')
<script type="text/javascript">
  $('#add-key-modal').click(function(){
    $('#key').text('');
    $('#key_value').val('');
  });

  $('#key_generate').click(function(){
    var base_url = $('#base_url').val();
    $.ajax({
      url: base_url+'/admin/keygenerate',
      method: 'GET',
      success: function(response){
        $('#key').text(response.key);
        $('#key_value').val(response.key);
      }
    })
  });

</script>
@stop
@extends('layouts.app')

@section('content')
<hr>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                   src="{{ url('') }}/dist/img/user1-128x128.jpg"
                   alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{ $user['fullName'] }}</h3>

            <p class="text-muted text-center">{{ $user['referralCode'] }}</p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Deposited</b> <a class="float-right">{{ $user['deposited'] }}</a>
              </li>
              <li class="list-group-item">
                <b>Winning</b> <a class="float-right">{{ $user['winning'] }}</a>
              </li>
              <li class="list-group-item">
                <b>Bonus</b> <a class="float-right">{{ $user['bonus'] }}</a>
              </li>
            </ul>

            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Details</a></li>
              <!-- <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li> -->
              <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Documents</a></li>
              <li class="nav-item"><a class="nav-link" href="#referral" data-toggle="tab">Referral</a></li>
              <li class="nav-item"><a class="nav-link" href="#transaction" data-toggle="tab">Transaction History</a></li>
              <li class="nav-item"><a class="nav-link" href="#add_pancard" data-toggle="tab">Add Pancard</a></li>
              <li class="nav-item"><a class="nav-link" href="#add_balance" data-toggle="tab">Add Balance</a></li>
              <li class="nav-item"><a class="nav-link" href="#add_deposit" data-toggle="tab">Add Deposit</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <div class="timeline timeline-inverse">
                 
                  <div class="time-label">
                    <span class="bg-success">
                      Document
                    </span>
                  </div>
                  @isset($user['document'])
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <div>
                    <i class="fas fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <!-- <span class="time"><i class="far fa-clock"></i> 2 days ago</span> -->

                      <h3 class="timeline-header"><a href="#">{{ $user['fullName'] }}</a> uploaded Document</h3>
                      <div class="timeline-body">
                        Status : <strong>{{ $user['documentStatus'] }}</strong><br>
                        @if($user['documentRejectReason'] != "")
                        Reject Reason: <strong>{{$user['documentRejectReason']}}</strong><br>
                        @endif
                        Document Number: <strong>{{ isset($user['document']['documentNumber'])?$user['document']['documentNumber']:"" }}</strong>
                        <br>
                        <img style="width: 90%" src="https://www.rockingbravo.com/uploads/{{ isset($user['document']['documentFront'])?$user['document']['documentFront']:'' }}" alt="...">
                        <img style="width: 90%" src="https://www.rockingbravo.com/uploads/{{ isset($user['document']['documentBack'])?$user['document']['documentBack']:'' }}" alt="...">
                        @if($user['documentStatus'] != 'approve')
                        <form action="{{ route('change_document_status') }}" method="post">
                          @csrf
                          <input type="hidden" name="userId" value="{{ $user['_id'] }}">
                          <div class="form-group">
                            <label for="document_status">Status</label>
                            <select class="form-control custom-select" name="documentStatus" required onchange="open_reject_dialog(this.value)">
                              <option selected value="" disabled>Select one</option>
                              <option value="reject">Reject</option>
                              <option value="approve">Approve</option>
                            </select>
                          </div>
                          <div class="form-group" style="display: none;" id="document_reject_remark">
                            <label for="document_status">Reject Remark</label>
                            <textarea class="form-control" name="documentRejectReason" ></textarea>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <a href="#" class="btn btn-secondary">Cancel</a>
                              <input type="submit" value="Submit" class="btn btn-success float-right">
                            </div>
                          </div>
                        </form>
                        @endif
                      </div>
                    </div>
                  </div>
                  @endisset
                  <div class="time-label">
                    <span class="bg-success">
                      Pancard
                    </span>
                  </div>
                  @isset($user['pancard'])
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <div>
                    <i class="fas fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">{{ $user['fullName'] }}</a> uploaded new Pancard</h3>
                      <div class="timeline-body">
                        Status : <strong>{{ $user['pancardStatus'] }}</strong><br>
                        @if($user['pancardRejectReason'] != "")
                        Reject Reason: <strong>{{$user['pancardRejectReason']}}</strong><br>
                        @endif
                        Pancard Number: <strong>{{ isset($user['pancard']['pancardNumber'])?$user['pancard']['pancardNumber']:"" }}</strong>
                        <br>
                        <img style="width: 90%" src="https://www.rockingbravo.com/uploads/{{ isset($user['pancard']['pancardImage'])?$user['pancard']['pancardImage']:'' }}" alt="...">
                        @if($user['pancardStatus'] != 'approve')
                        <form action="{{ route('change_pancard_status') }}" method="post">
                          @csrf
                          <input type="hidden" name="userId" value="{{ $user['_id'] }}">
                          <div class="form-group">
                            <label for="document_status">Status</label>
                            <select class="form-control custom-select" name="pancardStatus" required onchange="open_reject_dialog1(this.value)">
                              <option selected value="" disabled>Select one</option>
                              <option value="reject">Reject</option>
                              <option value="approve">Approve</option>
                            </select>
                          </div>
                          <div class="form-group" style="display: none;" id="pancard_reject_remark">
                            <label for="pancard_status">Reject Remark</label>
                            <textarea class="form-control" name="pancardRejectReason" ></textarea>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <a href="#" class="btn btn-secondary">Cancel</a>
                              <input type="submit" value="Submit" class="btn btn-success float-right">
                            </div>
                          </div>
                        </form>
                        @endif
                      </div>
                    </div>
                  </div>
                  @endisset
                  <div class="time-label">
                    <span class="bg-success">
                      Bank Details
                    </span>
                  </div>
                  @isset($bank['accountNumber'])
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <div>
                    <i class="fas fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <!-- <span class="time"><i class="far fa-clock"></i> 2 days ago</span> -->

                      <h3 class="timeline-header"><a href="#">{{ $user['fullName'] }}</a> uploaded BankDetails</h3>
                      <div class="timeline-body">
                        Status : <strong>{{ $bank['status'] }}</strong><br>
                        Account Number : <strong>{{ $bank['accountNumber'] }}</strong><br>
                        
                        Account Name : <strong>{{ $bank['accountHolderName'] }}</strong><br>
                        
                        IFSC : <strong>{{ $bank['ifsc'] }}</strong><br>
                        
                        Address : <strong>{{ $bank['address'] }}</strong><br>
                        
                        State : <strong>{{ $bank['state'] }}</strong><br>
                        
                        City : <strong>{{ $bank['city'] }}</strong><br>
                        
                        Branch : <strong>{{ $bank['branch'] }}</strong><br>
                        
                        Bank Name : <strong>{{ $bank['bankName'] }}</strong><br>
                        
                        @if(isset($bank['bankRejectReason']) && $bank['bankRejectReason'] != "")
                        Reject Reason: <strong>{{$bank['bankRejectReason']}}</strong><br>
                        @endif
                        
                        <br>
                        <img style="width: 90%" src="https://www.rockingbravo.com/uploads/{{ $bank['proofImage'] }}" alt="...">
                        @if($bank['status'] != 'approve')
                        <form action="{{ route('change_bank_status') }}" method="post">
                          @csrf
                          <input type="hidden" name="userId" value="{{ $user['_id'] }}">
                          <div class="form-group">
                            <label for="bankStatus">Status</label>
                            <select class="form-control custom-select" name="bankStatus" required onchange="open_reject_dialog1(this.value)">
                              <option selected value="" disabled>Select one</option>
                              <option value="reject">Reject</option>
                              <option value="approve">Approve</option>
                            </select>
                          </div>
                          <div class="form-group" style="display: none;" id="bank_reject_remark">
                            <label for="bankRejectReason">Reject Remark</label>
                            <textarea class="form-control" name="bankRejectReason" ></textarea>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <a href="#" class="btn btn-secondary">Cancel</a>
                              <input type="submit" value="Submit" class="btn btn-success float-right">
                            </div>
                          </div>
                        </form>
                        @endif
                      </div>
                    </div>
                  </div>
                  @endisset
                  <!-- END timeline item -->
                  <!-- <div>
                    <i class="far fa-clock bg-gray"></i>
                  </div> -->
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="active tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" disabled class="form-control" id="inputName" placeholder="Name" value="{{ $user['fullName'] }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" disabled class="form-control" id="inputEmail" placeholder="Email" value="{{ $user['email'] }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName2" placeholder="Phone" value="{{ $user['phone'] }}">
                    </div>
                  </div>
                  <!-- <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div> -->
                  <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">DOB</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="" disabled value="{{ isset($user['dateOfBirth'])?$user['dateOfBirth']:'' }}">
                    </div>
                  </div>
                  <!-- <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div> -->
                  <!-- <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div> -->
                </form>
              </div>
              <div class="tab-pane" id="add_balance">
                <form action="{{ route('add_balance') }}" method="post">
                  @csrf
                  <input type="hidden" name="user_id" value="{{ $user['_id'] }}">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Balance</label>
                    <div class="col-sm-10">
                      <input type="number" name="balance" class="form-control" id="inputName" placeholder="Name" value="0">
                    </div>
                  </div>
                  <div class="form-group row">
                    <input type="submit" class="btn btn-primary" value="Add Balance" onclick="return confirm('Are you sure')">
                  </div>
                </form>
              </div>
              <div class="tab-pane" id="add_pancard">
                <form action="{{ route('add_pancard') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="user_id" value="{{ $user['_id'] }}">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Pancard Number</label>
                    <div class="col-sm-10">
                      <input type="text" name="pancardNumber" class="form-control" placeholder="Pancard Number" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Pancard Image</label>
                    <div class="col-sm-10">
                      <input type="file" name="pancardImage" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <input type="submit" class="btn btn-primary" value="Add Pancard" onclick="return confirm('Are you sure')">
                  </div>
                </form>
              </div>
              <div class="tab-pane" id="add_deposit">
                <form action="{{ route('add_deposit') }}" method="post">
                  @csrf
                  <input type="hidden" name="user_id" value="{{ $user['_id'] }}">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Balance</label>
                    <div class="col-sm-10">
                      <input type="number" name="balance" class="form-control" id="inputName" placeholder="Balance" value="0" min="1">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputName1" class="col-sm-2 col-form-label">Transaction Id</label>
                    <div class="col-sm-10">
                      <input type="text" name="transactionId" class="form-control" id="inputName1" placeholder="Transaction Id" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <input type="submit" class="btn btn-primary" value="Add Deposit" onclick="return confirm('Are you sure')">
                  </div>
                </form>
              </div>
              <div class="tab-pane" id="referral">
                <table class="table table-bordered" id="newUsers">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Email</th>
                      <th>Full Name</th>
                      <th>Phone</th>
                      <th>Referral Code</th>
                      <th style="">Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <div class="tab-pane" id="transaction">
                <table class="table table-bordered" id="transaction_history" style="width: 100%">
                  <thead>                  
                    <tr>
                      <th style="width: 20%">#</th>
                      <th style="width: 20%">Transaction Type</th>
                      <th style="width: 20%">Amount</th>
                      <th style="width: 20%">Transaction Id</th>
                      <th style="width: 20%">Date</th>
                      <th style="width: 20%">Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<script>
 $(function () {
    var id = '<?php echo $user['referralCode'] ?>';
    var userId = '<?php echo $user['_id'] ?>';
    var table = $('#newUsers').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('user_referral_list_ajax') }}",
            data: function(d) {
                 d.referralCode = id;
            }
       },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'email', name: 'email'},
            {data: 'fullName', name: 'fullName'},
            {data: 'phone', name: 'phone'},
            {data: 'referralCode', name: 'referralCode'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


    var table = $('#transaction_history').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('transaction_histories') }}",
            data: function(d) {
                 d.userId = userId;
            }
       },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'transactionType', name: 'transactionType'},
            {data: 'amount', name: 'amount'},
            {data: 'transactionId', name: 'transactionId'},
            {data: 'createdDate', name: 'createdDate'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
 </script>
@endsection

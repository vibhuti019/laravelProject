@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Users refer count</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered" id="newUsers">
              <thead>                  
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Email</th>
                  <th>Full Name</th>
                  <th>Phone</th>
                  <th>Referral Code</th>
                  <th>Referral Count</th>
                  <th style="">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
<script>
 $(function () {
    
    var table = $('#newUsers').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('user_referral_ajax') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'email', name: 'email'},
            {data: 'fullName', name: 'fullName'},
            {data: 'phone', name: 'phone'},
            {data: 'referralCode', name: 'referralCode'},
            {data: 'level', name: 'level'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
 </script>
@endsection

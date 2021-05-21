@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Unverified Bank Details</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered" id="newUsers">
              <thead>                  
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Full Name</th>
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
        ajax: "{{ route('unverified_bank_details_ajax') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'accountHolderName', name: 'accountHolderName'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
 </script>
@endsection

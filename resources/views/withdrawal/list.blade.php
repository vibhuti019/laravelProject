@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Withdrawal List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>                  
                <tr>
                  <!-- <th style="width: 10px">#</th> -->
                  <th>Name</th>
                  <th>Amount</th>
                  <!-- <th>Status</th> -->
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($withdrawals as $key=>$value)
                <?php $user = DB::collection('users')->where('_id',$value['userId'])->first(); 
                // dd($user);
                $amount = $value['amount'];
                $id = $value['_id'];
                $user_id = $user['_id'];
                ?>
                <tr>
                  <!-- <td>{{ $key+1 }}</td> -->
                  <td>{{ $user['fullName'] }}</td>
                  <td>{{ $value['amount'] }}</td>
                  
                  <td>
                    <a href="javascript:void(0)" class="btn btn-success btn-xs" onclick="approve_request('<?php echo $id ?>')">Approve</a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-xs" onclick="reject_request('<?php echo $id ?>','<?php echo $user_id ?>')">Reject</a>
                    <?php /* {{ route('view_details',$value['_id']) }} */ ?>
                    <!-- <a href="" class="btn btn-primary btn-xs">Delete</a> -->
                  </td>
                  
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            {{ $withdrawals->links() }}
            <!-- <ul class="pagination pagination-sm m-0 float-right">
              <li class="page-item"><a class="page-link" href="#">«</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul> -->
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

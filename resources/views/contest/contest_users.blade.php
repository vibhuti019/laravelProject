@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Contest User List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>                  
                <tr>
                  <!-- <th style="width: 10px">#</th> -->
                  <th>User Name</th>
                  <th>Email</th>
                  <th style="">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($contest_users as $key=>$contest_user)
                <?php $user = DB::collection('users')->where('_id',$contest_user['userId'])->first(); ?>
                <tr>
                  <!-- <td>{{ $key+1 }}</td> -->
                  <td>{{ $user['fullName'] }}</td>
                  <td>{{ $user['email'] }}</td>
                  <td>
                    <a href="{{ route('view_user',$contest_user['userId']) }}" class="btn btn-primary btn-xs">View</a>
                    <!-- <a href="" class="btn btn-primary btn-xs">Delete</a> -->
                  </td>
                  
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            {{ $contest_users->links() }}
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

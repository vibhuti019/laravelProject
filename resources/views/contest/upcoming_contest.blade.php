@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Contest List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>                  
                <tr>
                  <!-- <th style="width: 10px">#</th> -->
                  <th>Entry Fee</th>
                  <th>No of Particioant</th>
                  <th style="">Contest Prize</th>
                  <th style="">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($contests as $key=>$contest)
                <tr>
                  <!-- <td>{{ $key+1 }}</td> -->
                  <td>{{ $contest['entryFees'] }}</td>
                  <td>{{ $contest['totalSpots'] }}</td>
                  <td>{{ $contest['pricePool'] }}</td>
                  <td>
                    <a href="{{ route('contest_users',$contest['_id']) }}" class="btn btn-primary btn-xs">View</a>
                    <!-- <a href="" class="btn btn-primary btn-xs">Delete</a> -->
                  </td>
                  
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            {{ $contests->links() }}
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

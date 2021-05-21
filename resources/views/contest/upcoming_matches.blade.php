@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Matches List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>                  
                <tr>
                  <!-- <th style="width: 10px">#</th> -->
                  <th>Title</th>
                  <th>Date</th>
                  <th>Join Users Count</th>
                  <th style="">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($matches as $key=>$match)
                <?php 
                  $joinUsers = DB::collection('contest_users')->where('matchId',$match['match_id'])->count();
                ?>
                <tr>
                  <!-- <td>{{ $key+1 }}</td> -->
                  <td>{{ $match['short_title'] }}</td>
                  <td>{{ $match['date_start'] }}</td>
                  <td <?php if($joinUsers > 0) echo "style='color:red;font-weight:bold;'" ?>>{{ $joinUsers }}</td>
                  
                  <td>
                    <a href="{{ route('contest_list',$match['match_id']) }}" class="btn btn-primary btn-xs">View</a>
                    <!-- <a href="" class="btn btn-primary btn-xs">Delete</a> -->
                  </td>
                  
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            {{ $matches->links() }}
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

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
                  <th>Team A Name</th>
                  <th>Team b Name</th>
                  <th>Team A</th>
                  <th>Team B</th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach($matches as $key=>$match)
                <tr>
                  <!-- <td>{{ $key+1 }}</td> -->
                  <td>{{ $match->teama->name }}</td>
                  <td>{{ $match->teamb->name }}</td>
                  <td><img src="{{ $match->teama->logo_url }}" style="height: 100px"></td>
                  <td><img src="{{ $match->teamb->logo_url }}" style="height: 100px"></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            
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

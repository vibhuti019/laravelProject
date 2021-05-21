@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Add man of the match</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>                  
                <tr>
                  <!-- <th style="width: 10px">#</th> -->
                  <th>Match Title</th>
                  <th>Select Player</th>
                  <th style="">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($matches as $key=>$match)
                <form action="{{ route('manOfTheMatch') }}" method="post">
                @csrf
                <input type="hidden" name="mid" value="{{ $match['match_id'] }}">
                <tr>
                  <!-- <td>{{ $key+1 }}</td> -->
                  <td>{{ $match['title'] }}</td>
                  <td>
                    <div class="form-group">
                      <select class="form-control custom-select" name="pid">
                        <option selected="" disabled="">Select one</option>
                        @foreach($match['squads'] as $squad)
                        <option value="{{ $squad['pid'] }}">{{ $squad['title'] }}</option>
                        @endforeach
                      </select>
                    </div>
                  </td>
                  <td>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure')">Add</button>
                    <!-- <a href="" class="btn btn-primary btn-xs">Delete</a> -->
                  </td>
                  
                </tr>
                </form>
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

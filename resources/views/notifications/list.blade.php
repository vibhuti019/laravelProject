@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Send Notification</h3>
          </div>
          <div class="card-body">
            <form action="{{ route('send_notifications') }}" method="post" enctype="multipart/form-data">
              @csrf
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              <div class="form-group">
                <label for="inputName">Title</label>
                <input type="text" id="inputName" value="{{ old('title') }}" name="title" class="form-control">
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <!-- <textarea name="description" class="form-control">{{ old('description') }}</textarea> -->
                <p class="lead emoji-picker-container">
                  <textarea data-emoji-input="unicode" name="description" class="form-control" data-emojiable="true"></textarea>
                </p>            
                  
              </div>
              <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
                
              </div>
              <div class="form-group">
                <a href="#" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Create new Porject" class="btn btn-success float-right">
              </div>
          </div>
        </div>
      </div>
    
    
    </div>
    </form>
        
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
                  <th>Title</th>
                  <th>Description</th>
                  <th>Image</th>
                  <!-- <th>Created At</th> -->
                </tr>
              </thead>
              <tbody>
                @foreach($notifications as $key=>$value)
                <tr>
                  <!-- <td>{{ $key+1 }}</td> -->
                  <td>{{ $value['title'] }}</td>
                  <td>{{ $value['description'] }}</td>
                  <td><img height="150" src='{{ isset($value["image"])? url("images")."/".$value["image"] : "" }}'></td>
                  
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            {{ $notifications->links() }}
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

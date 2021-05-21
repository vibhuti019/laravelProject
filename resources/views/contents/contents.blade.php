@extends('layouts.app')

@section('content')
<div class="container">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Content Add</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Content Add</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Content Add</h3>
          </div>
          <div class="card-body">
            <form action="{{ route('add_content') }}" method="post">
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
                <input type="text" id="inputName" value="{{ $content['pageType'] }}" name="pageType" class="form-control">
              </div>
              <div class="form-group">
                <label for="text">Text</label>
                <textarea type="text" id="text" name="text" class="form-control">{{ $content['text'] }}</textarea>
              </div>
              
              </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="#" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Create new Porject" class="btn btn-success float-right">
      </div>
    </div>
    </form>
  </section>
</div>
@endsection


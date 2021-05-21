@extends('layouts.app')

@section('content')
<div class="container">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Contest Add</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Contest Add</li>
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
            <h3 class="card-title">Contest Add</h3>
          </div>
          <div class="card-body">
            <form action="{{ route('add_contest') }}" method="post">
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
                <input type="text" id="description" value="{{ old('description') }}" name="description" class="form-control">
              </div>
              <div class="form-group">
                <label for="totalSpots">Total Spots</label>
                <input type="number" id="totalSpots" value="{{ old('totalSpots') }}" name="totalSpots" class="form-control">
              </div>
              <div class="form-group">
                <label for="entryFees">Entry Fees</label>
                <input type="number" id="entryFees" value="{{ old('entryFees') }}" name="entryFees" class="form-control">
              </div>
              <div class="form-group">
                <label for="pricePool">Price Pool</label>
                <input type="number" readonly id="pricePool" value="{{ old('pricePool') }}" name="pricePool" class="form-control">
              </div>
              <div class="form-group">
                <label for="totalWinners">Total Winners</label>
                <input readonly type="number" id="totalWinners" value="{{ old('totalWinners') }}" name="totalWinners" class="form-control">
              </div>
              
              <div class="form-group">
                <label for="maxSpotPerUser">Max Spot Per User</label>
                <input type="number" id="maxSpotPerUser" value="{{ old('maxSpotPerUser') }}" name="maxSpotPerUser" class="form-control">
              </div>
              <div class="form-group">
                <label for="isMultiSpot">Status</label>
                <select class="form-control custom-select" name="isMultiSpot">
                  <option selected="" disabled="">Select one</option>
                  <option value="false">No</option>
                  <option value="true">Yes</option>
                </select>
              </div>
              <div class="row">
                <div class="col-md-12 col-md-offset-10 pull-right">
                  <input type="button" id="add_row" value="Add Row" class="btn btn-primary float-right">
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="rank_start">Rank start</label>
                    <input type="text" id="rank_start" name="rank_start[]" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="rank_end">Rank End</label>
                    <input type="text" id="rank_end" name="rank_end[]" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="percentage">Percentage</label>
                    <input type="text" id="percentage" name="percentage[]" class="form-control">
                  </div>
                </div>
              </div>
              <div id="price_breakup"></div>
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


<!-- <!DOCTYPE html> -->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="robots" content="noindex,nofollow">
  <title>Sportzax</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'> -->
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
  <link rel='stylesheet' href='https://onesignal.github.io/emoji-picker/lib/css/emoji.css'>
  <link rel="stylesheet" href="dist/css/emoji.css">
  <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="/plugins/jquery/jquery.min.js"></script>
  <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <!-- <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul> -->

    <!-- SEARCH FORM -->
   
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <li class="nav-item">
        <form onsubmit="return confirm('Are yoy sure you want to logout?')" action="{{ route('logout') }}" method="post">
          @csrf
          <!-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
            <i class="fas fa-power-off"></i>
          </a> -->
          <button type="submit"  class="btn float-right" ><i class="fas fa-power-off"></i></button>
        </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link <?php if( Request::segment(1) == 'new_users' || Request::segment(1) == 'unverified_users' ) echo 'active'; ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('new_users') }}" class="nav-link <?php if( Request::segment(1) == 'new_users') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('rejected_users') }}" class="nav-link <?php if( Request::segment(1) == 'rejected_users') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rejected Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('rejected_bank_details') }}" class="nav-link <?php if( Request::segment(1) == 'rejected_bank_details') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rejected Bank Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('unverified_users') }}" class="nav-link <?php if( Request::segment(1) == 'unverified_users') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unverified Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('unverified_bank_details') }}" class="nav-link <?php if( Request::segment(1) == 'unverified_bank_details') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unverified Bank Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user_referral') }}" class="nav-link <?php if( Request::segment(1) == 'user_referral') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Referral</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li> -->
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('list_notifications') }}" class="nav-link <?php if( Request::segment(1) == 'list_notifications') echo 'active'; ?>">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                Notifications
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('upcoming_match') }}" class="nav-link <?php if( Request::segment(1) == 'upcoming_match') echo 'active'; ?>">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Upcoming Matches
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('match_list') }}" class="nav-link <?php if( Request::segment(1) == 'match_list') echo 'active'; ?>">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Matches List
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if( Request::segment(1) == 'list_contest' || Request::segment(1) == 'add_contest') echo 'menu-open'; ?>">
            <a href="#" class="nav-link <?php if( Request::segment(1) == 'list_contest' || Request::segment(1) == 'add_contest') echo 'active'; ?>">
              <i class="nav-icon fas fa-gamepad"></i>
              <p>
                Default Contests
                <i class="right fas fa-angle-left"></i>
                <!-- <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('list_contest') }}" class="nav-link <?php if( Request::segment(1) == 'list_contest') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contest List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('add_contest') }}" class="nav-link <?php if( Request::segment(1) == 'add_contest') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contest Add</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php if( Request::segment(1) == 'list_withdrawal_request') echo 'active'; ?>">
              <i class="nav-icon fas fa-usd"></i>
              <p>
                Withdrawal Request
                 <i class="fas fa-angle-left right"></i>
                <!--
                <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('list_withdrawal_request') }}" class="nav-link <?php if( Request::segment(1) == 'list_withdrawal_request') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="{{ route('add_contest') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contest Add</p>
                </a>
              </li> -->
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php if( Request::segment(1) == 'list_matches') echo 'active'; ?>">
              <i class="nav-icon fas fa-trophy"></i>
              <p>
                Man Of The match
                <!-- <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('list_matches') }}" class="nav-link <?php if( Request::segment(1) == 'list_matches') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Matches List</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
    <div class="content-wrapper">
    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div><br />
    @endif
    @yield('content')
    </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{ date('Y') }} <a href="#">Sportzax</a> </strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <!-- <b>Version</b> 3.0.1 -->
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<div id="myModal" class="modal fade approve_modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form action="{{ route('approve_transaction') }}" method="post">
      @csrf
      <input type="hidden" name="_id" value="" id="withdrawal_id">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modal Header</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="inputName">Transaction ID</label>
              <input type="text" id="inputName" value="{{ old('transaction_id') }}" name="transaction_id" class="form-control" required="">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Approve</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>

  </div>
</div>

<div id="rejectTransaction" class="modal fade reject_modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form action="{{ route('reject_transaction') }}" method="post">
      @csrf
      <input type="hidden" name="_id" value="" id="withdrawal_id_reject">
      <input type="hidden" name="user_id" value="" id="user_id_reject">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Reject Transaction</h4>
          <button type="submit" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="inputName">Reject Reason</label>
              <textarea name="reason" class="form-control" required></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Reject</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>

  </div>
</div>
<!-- ./wrapper -->
  <!-- jQuery UI 1.11.4 -->
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
   $.widget.bridge('uibutton', $.ui.button)
  </script>
<!-- jQuery -->
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
<script src='https://onesignal.github.io/emoji-picker/lib/js/config.js'></script>
<script src='https://onesignal.github.io/emoji-picker/lib/js/util.js'></script>
<script src='https://onesignal.github.io/emoji-picker/lib/js/jquery.emojiarea.js'></script>
<script src='https://onesignal.github.io/emoji-picker/lib/js/emoji-picker.js'></script>
<script  src="/dist/js/emoji.js"></script>
<script type="text/javascript">
  $( "#add_row" ).click(function() {
    $("#price_breakup").append('<div class="row"><div class="col-md-4"><div class="form-group"><label for="rank_start">Rank start</label><input type="text" id="rank_start" name="rank_start[]" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label for="rank_end">Rank End</label><input type="text" id="rank_end" name="rank_end[]" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label for="percentage">Percentage</label><input type="text" id="percentage" name="percentage[]" class="form-control"></div></div></div>');    
  });
  $( "#totalSpots" ).focusout(function() {
    var totalSpots = $( "#totalSpots" ).val();
    var entryFees = $( "#entryFees" ).val();
    var totalWinner = Math.floor(totalSpots*0.7)
    $("#pricePool").val((totalSpots*entryFees)*0.7);
    $("#totalWinners").val(totalWinner);
  });
  $( "#entryFees" ).focusout(function() {
    var totalSpots = $( "#totalSpots" ).val();
    var entryFees = $( "#entryFees" ).val();
    var totalWinner = Math.floor(totalSpots*0.7)
    $("#pricePool").val((totalSpots*entryFees)*0.7);
    $("#totalWinners").val(totalWinner);
  });
  function open_reject_dialog(value)
  { 
    if(value == 'reject')
    {
        $("#document_reject_remark").show();
    }
    else
    {
        $("#document_reject_remark").hide();
    }
  }

  function open_reject_dialog1(value)
  { 
    if(value == 'reject')
    {
        $("#pancard_reject_remark").show();
    }
    else
    {
        $("#pancard_reject_remark").hide();
    }
  }

  function approve_request(id)
  {
    $("#withdrawal_id").val(id);
    $(".approve_modal").modal("show");
  }

  function reject_request(id,user_id)
  {
    $("#user_id_reject").val(user_id);
    $("#withdrawal_id_reject").val(id);
    $(".reject_modal").modal("show");
  }
</script>
</body>
</html>

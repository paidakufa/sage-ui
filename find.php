<?php

session_start();

//Check if user is logged in
if(!isset($_SESSION['token'])){
  header('location:index.php');
  exit;
}

//Search for notes
if(isset($_POST['submit'])){
  $data = [
    'title' => $_POST['title']
  ];

  $curl = curl_init();

  curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost:8010/api/note/search',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => array(
          'Authorization: Bearer ' . $_SESSION['token'],
          'Content-Type: application/json'
      ),
  ));

  $response = curl_exec($curl);

  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

  if($status == 200){
    $notes = json_decode($response, true);
  }

  curl_close($curl);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="DashForge">
    <meta name="twitter:description" content="Responsive Bootstrap 5 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/dashforge">
    <meta property="og:title" content="DashForge">
    <meta property="og:description" content="Responsive Bootstrap 5 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 5 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="./assets/img/favicon.png">

    <title>DashForge Responsive Bootstrap 5 Dashboard Template</title>

    <!-- vendor css -->
    <link href="./lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="./lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="./lib/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link href="./lib/jqvmap/jqvmap.min.css" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="./assets/css/dashforge.css">
    <link rel="stylesheet" href="./assets/css/dashforge.dashboard.css">
  </head>
  <body class="page-profile">

    <header class="navbar navbar-header navbar-header-fixed">
      <a href="" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
      <div class="navbar-brand">
        <a href="./dashboard.php" class="df-logo">dash<span>forge</span></a>
      </div><!-- navbar-brand -->
      <div id="navbarMenu" class="navbar-menu-wrapper">
        <div class="navbar-menu-header">
          <a href="./dashboard.php" class="df-logo">dash<span>forge</span></a>
          <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
        </div><!-- navbar-menu-header -->
        <ul class="nav navbar-menu">
          <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">Main Navigation</li>
          <li class="nav-item active">
            <a href="dashboard.php" class="nav-link"><i data-feather="pie-chart"></i> Dashboard</a>
          </li>
          <li class="nav-item">
            <a href="new-note.php" class="nav-link"><i data-feather="pie-chart"></i> Create New Note</a>
          </li>
          <li class="nav-item">
            <a href="index.php" class="nav-link"><i data-feather="pie-chart"></i> Logout</a>
          </li>
        </ul>
      </div><!-- navbar-menu-wrapper -->
      <div class="navbar-right">
        
      </div><!-- navbar-right -->
      <div class="navbar-search">
        <div class="navbar-search-header">
          <input type="search" class="form-control" placeholder="Type and hit enter to search...">
          <button class="btn"><i data-feather="search"></i></button>
          <a id="navbarSearchClose" href="" class="link-03 mg-l-5 mg-lg-l-10"><i data-feather="x"></i></a>
        </div><!-- navbar-search-header -->
        <div class="navbar-search-body">
          <label class="tx-10 tx-medium tx-uppercase tx-spacing-1 tx-color-03 mg-b-10 d-flex align-items-center">Recent Searches</label>
          <ul class="list-unstyled">
            <li><a href="dashboard-one.html">modern dashboard</a></li>
            <li><a href="app-calendar.html">calendar app</a></li>
            <li><a href="./collections/modal.html">modal examples</a></li>
            <li><a href="./components/el-avatar.html">avatar</a></li>
          </ul>

          <hr class="mg-y-30 bd-0">

          <label class="tx-10 tx-medium tx-uppercase tx-spacing-1 tx-color-03 mg-b-10 d-flex align-items-center">Search Suggestions</label>

          <ul class="list-unstyled">
            <li><a href="dashboard-one.html">cryptocurrency</a></li>
            <li><a href="app-calendar.html">button groups</a></li>
            <li><a href="./collections/modal.html">form elements</a></li>
            <li><a href="./components/el-avatar.html">contact app</a></li>
          </ul>
        </div><!-- navbar-search-body -->
      </div><!-- navbar-search -->
    </header><!-- navbar -->

    <div class="content content-fixed">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Notes</h4>
          </div>
        </div>

        <form action="find" method="POST">
          <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Title">
          </div>
          <button name="submit" class="btn btn-primary" type="submit">Search</button>
        </form>

        <br /><br />

        <div class="row row-xs">
          <?php
          if(sizeof($notes) > 0){
            foreach($notes as $note){
          ?>
          <div class="col-sm-6 col-lg-3">
            <a href="view-note.php?id=<?php echo $note['id']; ?>">
              <div class="card card-body">
                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8"><?php echo $note['title']; ?></h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                </div>
              </div>
            </a>
          </div><!-- col -->
          <?php
            }
          }
          else{
            echo '<h6>No notes found.</h6>';
          }
          ?>
          <br /><br />
          <a href="dashboard.php">View all notes</a>
        </div><!-- row -->
      </div><!-- container -->
    </div><!-- content -->

    

    <script src="./lib/jquery/jquery.min.js"></script>
    <script src="./lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./lib/feather-icons/feather.min.js"></script>
    <script src="./lib/ionicons/ionicons/ionicons.esm.js" type="module"></script>
    <script src="./lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="./lib/jquery.flot/jquery.flot.js"></script>
    <script src="./lib/jquery.flot/jquery.flot.stack.js"></script>
    <script src="./lib/jquery.flot/jquery.flot.resize.js"></script>
    <script src="./lib/chart.js/Chart.bundle.min.js"></script>
    <script src="./lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="./lib/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="./assets/js/dashforge.js"></script>
    <script src="./assets/js/dashforge.sampledata.js"></script>
    <script src="./assets/js/dashboard-one.js"></script>

    <!-- append theme customizer -->
    <script src="./lib/js-cookie/js.cookie.js"></script>
    <script src="./assets/js/dashforge.settings.js"></script>

  </body>
</html>

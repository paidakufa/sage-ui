<?php

session_start();

//Check if user is logged in
if(!isset($_SESSION['token'])){
  header('location:index.php');
  exit;
}

//Delete note
if(isset($_POST['delete'])){

  $curl = curl_init();

  curl_setopt_array($curl, array(
		CURLOPT_URL => 'localhost:8010/api/note/' . $_POST['id'],
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'DELETE',
		CURLOPT_HTTPHEADER => array(
          'Authorization: Bearer ' . $_SESSION['token'],
          'Content-Type: application/json'
      ),
  ));

  $response = curl_exec($curl);

  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

  if($status == 200){
    header('location:dashboard.php');
    exit;
  }

  curl_close($curl);
}

//Update note
if(isset($_POST['update'])){
  header('location:edit-note.php?id=' . $_POST['id']);
  exit;
}


//Load note
if(isset($_GET['id'])){
  $note = null;
  $id = $_GET['id'];

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'localhost:8010/api/note/' . $id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      'Authorization: Bearer ' . $_SESSION['token'],
    ),
  ));

  $response = curl_exec($curl);

  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

  if($status == 200){
    $note = json_decode($response, true);
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
          <li class="nav-item">
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
      
    </header><!-- navbar -->

    <div class="content content-fixed">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item">View Note</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1"><?php echo $note['title']; ?></h4>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <form action="" method="POST">
              <input type="text" name="id" value="<?php echo $note['id']; ?>" hidden />
              <p><?php echo $note['content']; ?></p>
              <button name="update" class="btn btn-primary" type="submit">Update</button>
              <button name="delete" class="btn btn-danger" type="submit">Delete</button>
            </form>
          </div><!-- col -->
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

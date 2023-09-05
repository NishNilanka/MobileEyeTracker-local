<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"  content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/app.css">

    <!-- WSU favicon -->
	<link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}" />
    <!-- <link rel="icon" type="image/png" href="https://www.westernsydney.edu.au/__data/assets/file/0007/372562/WSU_Favicon-01.png?v=0.2.7"/> -->
	

    <title>Eye Tracking Study | Western Sydney University</title>
  </head>
  <body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-sm bg-light navbar-light">
   <a class="navbar-brand" href="/">
    <img src="{{ asset('wsu_logo-removebg-preview.png') }}" alt="tag" width="240px;">
  </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
      </li>
    </ul>
  </div>
</nav>
<div class="container">
<center>
  <div class="jumbotron">
    <img src="{{ asset('wsu_logo-removebg-preview.png') }}" srcset="wsu_logo-removebg-preview.png 900w" sizes="(min-width: 1200px) 50vw,100vw" alt="tag">
  <h1 class="display-4" style="padding-top: 30px;"><b>You have completed a maximum of <b>3</b> recordings.</b></h1>
  <p class="lead"><br>Thank you for participating.</p><br>
</div>
<center>
    <a  class="btn btn-lg btn-primary" href="/thankyou" style="margin-top: 20px;">Finish</a>
    </center>

<!-- Modal for login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Administrator Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <center>
                <form method="post">
                    <label for="user">Username:</label>
                    <input type="text" id="user" name="user"><br><br>
                    <label for="pass">Password:</label>
                    <input type="password" id="pass" name="pass"><br><br>
                </form>
            </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">Cancel</button>
          <a class="btn btn-lg btn-success" href="/filesystem">Login</a>
        </div>
      </div>
    </div>
  </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  </body>
</html>

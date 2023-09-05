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

	<!-- <link rel="icon" type="image/png" href="https://www.westernsydney.edu.au/__data/assets/file/0007/372562/favicon.ico"/>  -->

    <title>Eye Tracking Study | Western Sydney University</title>
  </head>
  <body>
<nav class="navbar navbar-expand-sm bg-light navbar-light">
   <a class="navbar-brand" href="/">
    <img src="{{ asset('wsu_logo-removebg-preview.png') }}" class = "img-responsive" alt="tag" width="240px;">
  </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a href="/login" class="nav-link">Admin Login</a>
      </li>
    </ul>
  </div>
</nav>
<div class="container">
<center>
  <div class="jumbotron">
    <img src="{{ asset('/wsu_logo-removebg-preview.png') }}" srcset="wsu_logo-removebg-preview.png 1100w" sizes="(min-width: 1200px) 50vw,100vw" alt="tag">
  <img src="{{ asset('placeholderwelcomeimage.png')}}" srcset="placeholderwelcomeimage.png 1100w" sizes="(min-width: 1200px) 50vw,100vw"><br><br><br>
  <p class="lead">Welcome to Western Sydney University's eye tracking student research program. For this test, you will be asked some anonymous questions regarding your demographic, and your face will be recorded. This information will not be used outside of an academic context.<br><br> Please touch the begin button to review Terms & Conditions before starting.

</p>
  <hr class="my-4">
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#termsModal"><i class="fa fa-home"></i>
  Begin
</button>
<p></p>
<p></p>
</center>
<!-- Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="termsModalLabel">Consents</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <strong> Project Title: Mobile Device Eye Tracking using Edge Computing to Capture Attention Hotspots on Dynamic Visual Contents</strong>
      <br>
      This study has been approved by the Human Research Ethics Committee at Western Sydney University. The ethics reference number is: H14493
<br>
<br>
        <p><strong>I hereby consent to participate in the above named research project.</strong></p>
        <p><br /><strong>I acknowledge that:</strong></p>
        <ul>
        <li>I have read the participant information sheet (or where appropriate, have had it read to me) and have been given the opportunity to discuss the information and my involvement in the project with the researcher/s</li>
        <li>The procedures required for the project and the time involved have been explained to me, and any questions I have about the project have been answered to my satisfaction.</li>
        </ul>
        <p><strong>I consent to:</strong></p>
        <p style="padding-left: 40px;">Having my face video recorded</p>

        <strong> 
        <ul> 
          <li>I consent for my data and information provided to be used in this project and other related projects for an extended period of time. </li>
          <li> I understand information gained during the study may be published and stored for other research use. The information may potentially reveal my identity.</li>
          <li> I understand that I can withdraw from the study at any time without affecting my relationship with the researcher/s, and any organisations involved, now or in the future.</li></strong>
<br>
If you have any complaints or reservations about the ethical conduct of this research, you may contact the Ethics Committee through Research Engagement, Development and Innovation (REDI) on; <br >Tel -  +61 2 4736 0229 or <br>email- <a href="mailto:humanethics@westernsydney.edu.au">humanethics@westernsydney.edu.au</a>.
<br>
Any issues you raise will be treated in confidence and investigated fully, and you will be informed of the outcome. 
<br>
      </div>
      <div class="modal-footer">
          <form method="post" action="{{url('/demographic')}}">
            @csrf
            <!-- <input type="checkbox" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="consent"> -->
            <input type="submit" class="btn btn-success" value="I agree" value="1" id="flexCheckDefault" name="consent">
            <input type="button" class="btn btn-danger" onClick="document.location.href='http://www.google.com'" value="I disagree">
			 <!-- Add an extra space here -->

      </form>
	  
      </div>
    </div>
  </div>
</div>

<!-- Modal for login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Administrator Login</h5>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>
            </div>

            <div class="form-group row mb-0" style="padding-bottom:15px;">

                    <center>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </center>
                </div>
				<br>
        </form>
        </div>
      </div>
    </div>
  </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> -->
	<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

  </body>
</html>

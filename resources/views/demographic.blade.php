
<!doctype html>
<html lang="en">

<style>

	/* HIDE RADIO */
	[type=radio] { 
	  position: absolute;
	  opacity: 0;
	  width: 0;
	  height: 0;
	}

	/* IMAGE STYLES */
	[type=radio] + img {
	  cursor: pointer;
	  width: 100px;
        height: 100px;
	}

	/* CHECKED STYLES */
	[type=radio]:checked + img {
	  outline: 2px solid #f00;
	  width: 100px;
        height: 100px;
	}


	.error {color: #FF0000;}
</style>


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"  content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/app.css">
	<script src="{{ asset('js/fontawesome.min.js') }}"></script>
    <!-- <script src="https://kit.fontawesome.com/cd3b8c73be.js" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> -->
	<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
	<script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- WSU favicon -->
    <!-- <link rel="icon" type="image/png" href="https://www.westernsydney.edu.au/__data/assets/file/0007/372562/favicon.ico"/> -->
	<link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}" />
    <style>
        .col-centered{
         float: none;
         margin: 0 auto;
}
    </style>
    <title>Eye Tracking Study | Western Sydney University</title>
</head>
<body onload="mobileOrTabletCheck()">
        <!-- Navbar -->
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
   <a class="navbar-brand" href="/">
    <img src="wsu_logo-removebg-preview.png" alt="Logo" style="width:240px;">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                </li>
            </div>
        </nav>


        <div class="container">
            <div class="jumbotron">
                <center>
                    <h1 class="display-4" style="padding-top: 30px;"><b>Demographic Page</b></h1>
                    <p class="lead">We just require a bit of your information before we continue.</p>
                </div>
            </center>
           

            </script>
            <hr size="4px;">
                <div class="container">
					<p><span class="error">* required field</span></p>
                    <form role="form" method="POST" action="/post">
                        @csrf
                        <!-- Age Range Select Menu -->
                        <div class="row">
                                    <div class="col-md-4 col-centered">
                                <div class="form-group">
                                    <label for="ageInput">Age:</label>
									<span class="error">*</span>
                                    <select class="form-select form-select-sm" aria-label="Default select example" id="ageInput" name="ageInput" required onchange="enableButton()">
                                        <option value="">Select</option>
                                        <?php for($i = 18; $i <= 75; $i += 1){
											 echo("<option value='{$i}'>{$i}</option>");
										}?>
                                    </select>
                                </div>
                            </div>
                        </div>
                                <br>
                                <!-- Glasses Select Menu -->
                                <div class="row">
                                    <div class="col-md-4 col-centered">
                                        <div class="form-group">
                                <label for="glassesInput"><p>Are you currently wearing any vision correction?</p></label>
								<span class="error">*</span>
                                <select class="form-select form-select-sm" aria-label="Default select example" id="glassesInput" name="glassesInput" required onchange="enableButton()">
                                    <option value="">Select</option>	
                                    <option>No</option>
                                    <option>Yes, glasses</option>
                                    <option>Yes, contact lenses</option>
                                </select>
                            </div>
                                    </div>
                        </div>
                    <br>
                    <!-- Gender Select Menu -->
                    <div class="row">
                        <div class="col-md-4 col-centered">
                            <label for="genderInput">Gender:</label>
							<span class="error">*</span>
                            <select class="form-select form-select-sm" aria-label="Default select example" id="genderInput" name="genderInput" required onchange="enableButton()">
                            <option value="">Select</option>
                            <option value="0">Male</option>
                                <option value="1">Female</option>
                                <option value="2">Non-binary</option>
                                <option value="3">I'm not represented or prefer not to say</option>
                            </select>
                        </div>
                    </div>
					<br>
				<div class="row">
                    <div class="col-md-4 col-centered">
					<label for="brand">Select your mobile device brand:</label>
					<span class="error">*</span>
					<select class="form-select form-select-sm" aria-label="Default select example" id="brand" name="brand" required onchange="loadDeviceModels(this)">
						<option value="">Select</option>
					</select>
					<br>
					</div>
                </div>
				<div class="row">
                    <div class="col-md-4 col-centered">
					<label for="model">Select your mobile device model:</label>
					<select class="form-select form-select-sm" aria-label="Default select example" id="model" name="model" required onchange="enableButton()">
						<option value="">Select</option>
					</select>
					<br>
				</div>

        <div class="row">
          <div class="col-md-4 col-centered">
					<label for="model">Select your mobile device model:</label>
					<select class="form-select form-select-sm" aria-label="Default select example" id="model" name="model" required onchange="enableButton()">
						<option value="">Select</option>
					</select>
					<br>
				</div>


                <!-- Demographic Submit Button  -->
                        <div class="row">
                            <center>
                                <br>
                                <button id="SubmitBtn" class="btn btn-lg btn-primary" href="/tutorial" style="margin-top: 20px;" >Submit</button>
								<p></p>
								<p></p>
                            </center>
                        </div>
                    </div>
                <!-- forum input -->
                <input type="hidden" id="MoblileOrTablet" name="MoblileOrTablet" value="Value">
                <input type="hidden" id="useragent" name="useragent" value="userAgent">
				<input type="hidden" id="dpr" name="dpr" value="dpr">
            </form>
        </div>
		

		<div class="modal fade" id="OptModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="beginModalLabel">Device Not Supported</h5>
			  </div>
			  <div class="modal-body">
				You need to have a mobile device (smartphone or tablet) with a front-facing camera to perform this study.<br>
			  </div>
			  <div class="modal-footer">
				<button id="home" type="button" class="btn btn-primary">Home</button>
			  </div>
			</div>
		  </div>
		</div>
		
		
	<div class="modal fade" id="recorderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="staticBackdropLabel">Please enable your MediaRecorder API</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<ul>
				<li>Please Go to Settings &#8594; Safari &#8594; Advanced &#8594; Experimental Features</li><br>
				<li>Enable MediaRecorder</li>
		  </div>
		  <div class="modal-footer">
			<button type="button" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#beginModal3" class="btn btn-lg btn-warning"> Ok</button>
		  </div>
		</div>
	  </div>
	</div>
		
		 

    </body>

        <!-- Script to determine device modal / type -->
    <script>
	
	if(typeof MediaRecorder == "undefined"){
		var medaRecorderModal = new bootstrap.Modal(document.getElementById('recorderModal'), {});
		medaRecorderModal.show();	
	}
	
	var mobileOrTablet = 0;
    function mobileOrTabletCheck() {
        console.log('width ',window.innerWidth);
        console.log('height ',window.innerHeight);
    
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) mobileOrTablet = 1;})(navigator.userAgent||navigator.vendor||window.opera);
    console.log(mobileOrTablet);
    document.getElementById("MoblileOrTablet").value = mobileOrTablet;
	document.getElementById("useragent").value = navigator.userAgent;
	document.getElementById("dpr").value = window.devicePixelRatio;
	if(mobileOrTablet == 0)
	{
		var OptModal = new bootstrap.Modal(document.getElementById('OptModal'), {});
		OptModal.show();
	}
	};

window.onload = mobileOrTabletCheck();
let Finish = document.getElementById('home');




Finish.addEventListener('click', (ev)=>{
                window.location.href = "";
            });
			

function loadDeviceModels(selectObject)
{
	var value = selectObject.value;
	var model_select = document.getElementById('model')
	if (value != '')
	{
		var models = Array.from(lines.get(value));
		removeOptions(model_select);
		model.innerHTML += `<option value="Select">Select</option>`;
		models.forEach(op => model.innerHTML += `<option value="${op}">${op}</option>`);
	}
	else
	{
		removeOptions(model_select);
		model.innerHTML += `<option value="Select">Select</option>`;
	}
}

function enableButton()
{

}

function removeOptions(selectElement) {
   var i, L = selectElement.options.length - 1;
   for(i = L; i >= 0; i--) {
      selectElement.remove(i);
   }
}

$(document).ready(function() {
  $.ajax({
    type: "GET",
    url: "mobile_devices.csv",
    dataType: "text",
    success: function(data) {
      processData(data);
    }
  });
});



function setValue(key, value) {
    if (!lines.has(key)) {
        lines.set(key, new Set(value));
        return;
    }
    lines.get(key).add(value);
}

var lines = new Map();
function processData(allText) {
  var allTextLines = allText.split(/\r\n|\n/);
  var headers = allTextLines[0].split(',');
  
  for (var i = 0; i < allTextLines.length; i++) {
    var data = allTextLines[i].split(',');
    if (data.length == headers.length) {
		var key = data[0];
		var value = data[1];
		if (!lines.has(key)) {
			lines.set(key, [value]);
		}else
		{
			temp = lines.get(key);
			temp.push(value);
			lines.set(key, temp);
		}
    }
  }
  var brands = Array.from(lines.keys());
  brands.forEach(op => brand.innerHTML += `<option value="${op}">${op}</option>`);
};




   
</script>

	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>-->
    <!-- <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
	
	<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
	

	
</body>
</html>

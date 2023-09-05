<!doctype html>
<html lang="en">
<?php use Illuminate\Http\Request; ?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <script src="https://kit.fontawesome.com/cd3b8c73be.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/app.css">
    <script src="https://kit.fontawesome.com/cd3b8c73be.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <title>Eye Tracking Admin | Western Sydney University</title>
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
                    <a href="/resetpassword" class="nav-link">Change Password</a>
                </li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register">Register New Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout">Log Out</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <center>
        <div class="jumbotron">
            <h1 class="display-4" style="padding-top:30px;">Participant Recordings</h1>
            <i class="fas fa-camera" style="font-size:50px; padding:10px;"></i>
            <p class="lead">View all participant videos here.</p>
            <hr class="my-4">
            <center>
                <!-- Filter Results Button -->
                <button href="#" class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal"><span class="fas fa-filter"></span> Filter results</button>
                <!-- Download Database Button -->
                <a href="/generate-csv" class="btn btn-lg btn-primary" value="Download .CSV">Download Demographics DB</a>
            </center>
            <br> <br>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Date Added</th>
                        <th scope="col">Recording ID</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Glasses</th>
                        <th scope="col">Age Range:</th>
                        <tbody>
                            <tr>
                                <th scope="row"><div id='dateadded'></div></th>
                                <th scope="row"><div id='sid'></div></th>
                                <th scope="row"><div id='gender'></div></th>
                                <th scope="row"><div id='glasses'></div></th>
                                <th scope="row"><div id='age'></div></th>

                            </tr>
                        </thead>
                    </table>
                    <br>
                </div>
            </center>
            <!-- Select / Deselect Buttons -->
            <button style="float: right; margin-top: 20px;" class="btn btn-lg btn-primary" onClick="toggle(true)" >Select all</button>
            <button style="float: right; margin-top: 20px; margin-right: 20px;" class="btn btn-lg btn-primary" onClick="toggle(false)" >Deselect all</button>
            <!-- This form is the basis of downloading videos from the filesystem, the inputs are the checkbox instances of filenames. -->
            <form class="files" method="POST" >
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                @csrf
                <?php
                //sql statement for filesystem, grab ressults from db into obj array
                $filesysSql = 'SELECT * FROM demographics INNER JOIN filesystem ON demographics.sid = filesystem.sid';

                //cycle through $_GET variables, appending each to the sql statement if set
                foreach($_GET as $key => $value){
                    if(!(empty($_GET[$key]))) {
                        if($key == "fileDownloaded"){
                            $filesysSql = $filesysSql." AND filesystem.".$key." = '".$value."'";
                        } else {
                            $filesysSql = $filesysSql.' AND demographics.'.$key.' = "'.$value.'"';
                        }
                    }
                }

                //make SQL query, return to $filesysResult variable
                $filesysResult = DB::select($filesysSql);
                echo('<table class="table table-striped table-hover">');
                    echo('<thead><tr><th scope="col">File Name:</th><th scope="col">File Size:</th><th scope="col">Time Created:</th></tr> </thead>');
                    //iterate through the returned SQL result array, creating selectable filesystem checkbox instances for each.
                    for($i = 0; $i < count($filesysResult); $i++){
                        $sid = $filesysResult[$i]->sid;
                        $filename = $filesysResult[$i]->filename;
                        $filesize = $filesysResult[$i]->filesize;
                        $dateadded = $filesysResult[$i]->timeCreated;
                        echo('<tr>');
                            // echo('<th scope="col"><input type="checkbox" id="'.$sid.'" name="filenames[]" value="'.$filename.'" class="files"/></th>');
                            // echo('<th scope="col"><label for="'.$sid.'">'.$filename.'</label><br></th>');
                            echo('<tbody><tr><td scope="row"><input class="form-check-input" type="checkbox" id='.$sid.' name="filenames[]"  value="'.$filename.'" class="files"/><label for="'.$sid.'">'.$filename.'</label></td><td>'.$filesize.'</td><td>'.$dateadded.'</td>
                            </tr>');

                        } ?>
                        <input type="submit" class="btn btn-lg btn-primary" value="Download .ZIP" formaction={{ route('create-zip')}} style="margin-top: 20px; margin-right: 20px;"/>
                        <button type="button" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#ConfModal"  class="btn btn-lg btn-primary" value="Delete selected" style="margin-top: 20px;"> Delete Selected </button>
                    </table>

                <div class="modal fade" id="ConfModal" tabindex="-1" aria-labelledby="beginModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="beginModalLabel"><b>Are you sure?</b></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    Are you sure you want to delete these entries from the Database and Storage?<br> <br>
                                    This cannot be undone.
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-bs-dismiss="modal" style="margin-top: 20px;" class="btn btn-lg btn-seccondary"> Cancel</button>
                                <input type="submit" class="btn btn-lg btn-primary" value="Delete" formaction={{ route('delete')}} style="margin-top: 20px;"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
                <script>
                    function toggle(polarity){
                        checkboxes = document.getElementsByName('filenames[]');
                        for (var y=0; y<checkboxes.length; y++){
                            checkboxes[y].checked = polarity;
                        }
                    }
                </script>


                    <script>
                        function toggle(polarity){
                            checkboxes = document.getElementsByName('filenames[]');
                            for (var y=0; y<checkboxes.length; y++){
                                checkboxes[y].checked = polarity;
                            }
                        }
                    </script>

                </div>
                <!-- Submit button to the form, submitting to route which downloads all files into a .zip -->
                <script>
                    //cast SQL result to JS array variable through AJAX.
                    var filesysArray = @json($filesysResult);
                    //change the file info divs based on file selected.
                    $('.files :input').change(function(e){
                        //TODO
                        //IF(only one checkbox is selected:)
                        //grep out responses from demographics and filesys arrays that match the <sid> of the clicked checkbox

                            //
                            var selectedCheckboxFilename = $(this).val();
                            var selectedCheckboxSid = selectedCheckboxFilename.substr(0, 16);

                            var selectedFilesys = $.grep(filesysArray, function(n, i) {
                                return n.filename == selectedCheckboxFilename;
                            });

                            //check JS $filesysArray or $demoArray for <sid>, then fill textboxes accordingly
                                $('#filename').text(selectedFilesys[0].filename)
                                $('#filesize').text(selectedFilesys[0].filesize)
                                $('#filelocation').text(selectedFilesys[0].fileLocation)
                                $('#dateadded').text(selectedFilesys[0].timeCreated)
                                $('#sid').text(selectedFilesys[0].sid)
                                $('#age').text(selectedFilesys[0].age)
                                $('#glasses').text(selectedFilesys[0].glasses)
                                $('#gender').text(selectedFilesys[0].gender)
                                $('#mobile').text(selectedFilesys[0].deviceMobile)
                            });
                        </script>

                    </div>
                    <!-- Submit button to the form, submitting to route which downloads all files into a .zip -->
                    <script>
                        //cast SQL result to JS array variable through AJAX.
                        var filesysArray = @json($filesysResult);
                        //change the file info divs based on file selected.
                        $('.files :input').change(function(e){
                            //TODO
                            //IF(only one checkbox is selected:)
                            //grep out responses from demographics and filesys arrays that match the <sid> of the clicked checkbox

                                //
                                var selectedCheckboxFilename = $(this).val();
                                var selectedCheckboxSid = selectedCheckboxFilename.substr(0, 16);

                                var selectedFilesys = $.grep(filesysArray, function(n, i) {
                                    return n.filename == selectedCheckboxFilename;
                                });

                                //check JS $filesysArray or $demoArray for <sid>, then fill textboxes accordingly
                                    $('#filename').text(selectedFilesys[0].filename)
                                    $('#filesize').text(selectedFilesys[0].filesize)
                                    $('#filelocation').text(selectedFilesys[0].fileLocation)
                                    $('#dateadded').text(selectedFilesys[0].timeCreated)
                                    $('#sid').text(selectedFilesys[0].sid)
                                    $('#age').text(selectedFilesys[0].age)
                                    $('#glasses').text(selectedFilesys[0].glasses)
                                    $('#gender').text(selectedFilesys[0].gender)
                                    $('#mobile').text(selectedFilesys[0].deviceMobile)
                                });
                            </script>

                            <!-- modal for filtering options -->
                            <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="filterModalLabel">Filter recordings</h5>
                                        </div>

                                        <!-- form responsible for filtering - value of inputs matches SQL server fields exactly -->
                                        <div class="container">
                                            <form method="GET" action="/filesystem">
                                                <div class="form-group">
                                                    <label for="sid">Session ID:</label>
                                                    <input type="text" id="sid" name="sid" placeholder="--">
                                                </div><br>
                                                <!-- Age Range Select Menu -->
                                                <div class="form-group">
                                                    <label for="age">Age:</label>
                                                    <select class="form-select form-select-sm" aria-label="Default select example" id="age" name="age">
                                                        <option value="" selected>--</option>
                                                        <?php for($i = 18; $i <= 75; $i += 1){
															 echo("<option value='{$i}'>{$i}</option>");
														}?>
                                                    </select>
                                                </div><br>
                                                <!-- Glasses Select Menu -->
                                                <div class="form-group">
                                                    <label for="glasses">Vision correction:</label>
                                                    <select class="form-select form-select-sm" aria-label="Default select example" id="glasses" name="glasses">
                                                        <option value="" selected>--</option>
                                                        <option>Yes, glasses</option>
                                                        <option>Yes, contact lenses</option>
                                                        <option>No</option>
                                                    </select>
                                                </div><br>
                                                <!-- Gender Select Menu -->
                                                <div class="form-group">
                                                    <label for="gender">Gender:</label>
                                                    <select class="form-select form-select-sm" aria-label="Default select example" id="gender" name="gender">
                                                        <option value="" selected>--</option>
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                        <option>Non-binary</option>
                                                        <option>I'm not represented or prefer not to say</option>
                                                    </select>
                                                </div><br>
                                                <!-- Device Select Menu -->
                                                <div class="form-group">
                                                    <label for="deviceMobile">Device type:</label>
                                                    <select class="form-select form-select-sm" aria-label="Default select example"" id="deviceMobile" name="deviceMobile">
                                                        <option value="" selected>--</option>
                                                        <option value="0">Non-mobile device</option>
                                                        <option value="1">Mobile device</option>
                                                    </select>
                                                </div><br>
                                                <!-- Download Status Select Menu -->
                                                <div class="form-group">
                                                    <label for=fileDownloaded>Downloaded status:</label>
                                                    <select class="form-select form-select-sm" aria-label="Default select example" id="fileDownloaded" name="fileDownloaded">
                                                        <option value="" selected>--</option>
                                                        <option value="0">Not downloaded yet</option>
                                                        <option value="1">Already downloaded</option>
                                                    </select>
                                                </div><br>
                                                <input type="submit" style="margin: 20px" value="Submit" class="btn btn-lg btn-primary">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </body>
                    </html>

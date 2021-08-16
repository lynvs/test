<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>GoBuild Test</title>
</head>
<body>
    <div class="container">
        <div class="col-md-4 col-sm-12 offset-md-4">
            <div id="form-container" class="text-center">
                <h1 class="mb-5">Log In</h1>

                <!-- Login Form -->
                <form id="login-form">
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email Address" required autofocus>
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" aria-required="">

                    <div class="btn-group mt-5 mb-2 col-md-12">
                        <button id="login" class="btn btn-success col-md-6">Log In</button>
                        <button id="register" class="btn btn-secondary col-md-6" data-toggle="modal" data-target="#registerModal">Register</button>
                    </div>
                    
                    <a id="reset-password" data-toggle="modal" data-target="#resetModal">Reset Password</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div id="registerModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <!-- Modal Header -->
                <div class="modal-header text-center">
                    <h4 class="modal-title">Register</h4>

                    <button class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="register-form">
                        <input type="text" id="inputRegisterName" name="inputRegisterName" class="form-control mb-4" placeholder="Name" required autofocus>
                        <input type="text" id="inputRegisterSurname" name="inputRegisterSurname" class="form-control mb-4" placeholder="Surname" required >
                        
                        <div class="btn-group btn-group-toggle mb-4 col-md-12" data-toggle="buttons">
                            <label class="btn btn-secondary col-md-4 active">
                            <input type="radio" name="inputRegisterGender" value="male" checked>Male
                            </label>

                            <label class="btn btn-secondary col-md-4">
                            <input type="radio" name="inputRegisterGender" value="female">Female
                            </label>

                            <label class="btn btn-secondary col-md-4">
                            <input type="radio" name="inputRegisterGender" value="n/a">N/A
                            </label>
                        </div>

                        <input type="email" id="inputRegisterEmail" name="inputRegisterEmail" class="form-control mb-4" placeholder="Email" required >
                        <input type="tel" id="inputRegisterMobile" name ="inputRegisterMobile" class="form-control mb-4" placeholder="Mobile Number" required >
                        <input type="password" id="inputRegisterPassword" name="inputRegisterPassword" class="form-control mb-4" placeholder="Password" required >
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="col-md-12 btn-group">
                        <div class="col-md-4">
                            <button id="register-user" class="btn btn-success col-md-12" type="submit">Register</button>
                        </div>
                        <div class="col-md-4 offset-md-4">
                            <button class="btn btn-danger col-md-12" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reset Password Modal -->
    <div id="resetModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <!-- Modal Header -->
                <div class="modal-header text-center">
                    <h4 class="modal-title">Reset Password</h4>

                    <button class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="reset-form" method="POST">
                        <input type="email" id="resetEmail" class="form-control mb-4" placeholder="Email" required >
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="col-md-12 btn-group">
                        <div class="col-md-4">
                            <button id="reset" class="btn btn-success col-md-12 resetPassword" type="submit">Reset</button>
                        </div>
                        <div class="col-md-4 offset-md-4">
                            <button class="btn btn-danger col-md-12" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="ajaxloader" style="display: none; position: fixed; left: 25%; top: 25%">
        <div class="col-md-12">
            <img src="/gobuildtest/views/images/loader.gif">
        </div>
    </div>

    <!-- JS Includes -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/gobuildtest/views/js/script.js"></script>
</body>
</html>
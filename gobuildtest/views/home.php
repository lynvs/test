<?php
require_once '../app/Sessions.php';
require_once '../app/User.php';
require_once '../app/Holidays.php';

$session = new Sessions;
$user = new User;
$userObject = $user->getUser('user_id', $_SESSION['userId']);

$holidays = new Holidays;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

    <title>GoBuild Test</title>
</head>

<body>
    <div class="container">
        <div class="col-md-12">
            <div class="col-md-11 float-left mt-3 mb-5">
                <h3>Your Details</h3>
            </div>
            <div class="col-md-1 float-right mt-3 mb-5">
                <a id="logout" class="">Logout</a>
            </div>
            <br /><br />
        </div>
        <div class="container">
            <div class="col-md-12 col-sm-12" id="user-data">
                <form id="update-form">
                    <table id="userTable" class="table table-striped table-bordered table-sm">
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Password</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th id='userName'><input type="text" id="updateName" name="updateName" value="<?php echo $userObject->name; ?>" required/></th>
                            <td><input type="text" id="updateSurname" name="updateSurname" value="<?php echo $userObject->surname; ?>" required /></td>
                            <td><select id="updateGender" name="updateGender">
                                <option value=<?php echo $userObject->gender; ?>><?php echo $userObject->gender; ?></option>
                                <option value="male">male</option>
                                <option value="n/a">n/a</option>
                            </select></td>
                            <td><input type="email" id="updateEmail" name="updateEmail" value="<?php echo $userObject->email; ?>" required /></td>
                            <td><input type="text" id="updateMobile" name="updateMobile" value="<?php echo $userObject->mobile; ?>" required /></td>
                            <td><input type="password" id="updatePassword" name="updatePassword" value="xxxxx" required /></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-md-2 float-right mt-3">
                        <button id="update" class="btn btn-success col-md-12">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="col-md-12">
            <form class="get-equinox">
                <div class="col-md-2">
                    <label for="year"> Please input year
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="year" name="year" />
                </div>
                <div class="col-md-4 float right">
                    <button id="fetch-holiday" class="btn btn-success col-md-12">Fetch Holidays</button>
                </div>
            </form>
        </div>
        <div id='holdayResults' class="col-md-12">

        </div>
    </div>
    <div id="ajaxloader" style="display: none; position: fixed; left: 25%; top: 25%">
        <div class="col-md-12">
            <img src="/gobuildtest/views/images/loader.gif">
        </div>
    </div>
    
   <!-- JS Includes -->
    <script src="./js/script.js"></script>
</body>
</html>
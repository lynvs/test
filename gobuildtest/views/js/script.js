/** 
 * Complete the login action 
 * Complete AJAX Call to validate loging credentials
*/
$('#login').on('click', function(event) {
    event.preventDefault();
    ajaxLoaderShow()

    $.ajax({
        url: "/gobuildtest/app/helper.php",
        type: "json",
        data: {
            password: $('#inputPassword').val(),
            email: $('#inputEmail').val(),
            function_name: 'login'
        },
        method: "POST",
        success: function(data) {    
            if (data == 1) {
                ajaxLoaderHide();
                /** Navigate to home page if login successful */
                window.location.href = "../views/home.php";
            } else {
                ajaxLoaderHide();
                alert('Incorrect login details. Please try again.');
            }
        },
        error: function(error) {
            ajaxLoaderHide();
            alert('Incorrect login details. Please try again.');
        }
    });
});

/**
 * Logout function
 * Complete AJAX call to complete logout functionality
 */
$('#logout').on('click', function(event) {
    event.preventDefault();
    ajaxLoaderShow()

    $.ajax({
        url: "/gobuildtest/app/helper.php",
        type: "json",
        data: {
            function_name: 'logout'
        },
        method: "POST",
        success: function(data) {    
            if (data == 1) {
                ajaxLoaderHide();
                window.location.href = "../views/login.php";
            } else {
                ajaxLoaderHide();
                alert('An error occured.');
            }
        },
        error: function(error) {
            ajaxLoaderHide();
            alert('An error occured.');
        }
    });
});

$('#register').on('click', function(event) {
    /** Prevent default to stop button from attempting to validate login form */
    event.preventDefault();

    /** Show Register Modal */
    $('#registerModal').show();
});

/**
 * Registration form functionality
 * Complete validation
 * If validation successfull complete ajax call to register new user
 */
$('#registerModal').on('click', '#register-user', function(event) {
    event.preventDefault();
    ajaxLoaderShow();

    resultMessage = '';

    validName = validateName($('#inputRegisterName').val());
    if (validName.result === false) {
        resultMessage += validName.message + "\r\n";
    }

    validSurname = validateSurname($('#inputRegisterSurname').val());
    if (validSurname.result === false) {
        resultMessage += validSurname.message + "\r\n";
    }

    validSurname = validateSurname($('#inputRegisterSurname').val());
    if (validSurname.result === false) {
        resultMessage += validSurname.message + "\r\n";
    }

    validGender = validateGender('inputRegisterGender');
    if (validGender.result === false) {
        resultMessage += validGender.message + "\r\n";
    }

    validEmail = validateEmail($('#inputRegisterEmail').val());
    if (validEmail.result === false) {
        resultMessage += validEmail.message + "\r\n";
    }

    validMobile = validateMobile($('#inputRegisterMobile').val());
    if (validMobile.result === false) {
        resultMessage += validMobile.message + "\r\n";
    }

    validPassword = validatePassword($('#inputRegisterPassword').val())
    if (validPassword.result === false) {
        resultMessage += validPassword.message;
    }

    if (resultMessage !== '') {
        alert(resultMessage);

        return false;
    }

    $.ajax({
        url: "/gobuildtest/app/helper.php",
        dataType: "json",
        data: {
            postForm: $('#register-form').serialize(),
            function_name: 'registerUser'
        },
        method: "POST",
        success: function(data) {
            if (data === 1) {
                ajaxLoaderHide();
                alert('You have been successfully registered. Please log in.');
                $('#registerModal').hide();
                $('.modal-backdrop').hide();
            } else if (data === 2) {
                ajaxLoaderHide();
                alert('A user with this email address already exists.');
            }
        },
        error: function(error) {
            ajaxLoaderHide();
            alert('Registration failed. Please try again.');
        }
    });
});

/**
 * Update User
 * Complete validation on fields completed
 * Complete AJAX call to update the user
 */
$('#update').on('click', function(event) {
    event.preventDefault();
    ajaxLoaderShow();

    resultMessage = '';

    validName = validateName($('#updateName').val());
    if (validName.result === false) {
        resultMessage += validName.message + "\r\n";
    }

    validSurname = validateSurname($('#updateSurname').val());
    if (validSurname.result === false) {
        resultMessage += validSurname.message + "\r\n";
    }

    validEmail = validateEmail($('#updateEmail').val());
    if (validEmail.result === false) {
        resultMessage += validEmail.message + "\r\n";
    }

    validMobile = validateMobile($('#updateMobile').val());
    if (validMobile.result === false) {
        resultMessage += validMobile.message + "\r\n";
    }

    /** Only validate password if user inserted a value different to the form 'xxxxx' */
    if ($('#updatePassword').val() !== 'xxxxx') {
        validPassword = validateMobile($('#updatePassword').val());

        if (validMobile.result === false) {
            resultMessage += validMobile.message + "\r\n";
        }    
    }

    if (resultMessage !== '') {
        alert(resultMessage);

        return false;
    }

    $.ajax({
        url: "/gobuildtest/app/helper.php",
        dataType: "json",
        data: {
            postForm: $('#update-form').serialize(),
            function_name: 'updateUser'
        },
        method: "POST",
        success: function(data) {
            if (data === 1) {
                ajaxLoaderHide();
                window.location.href = "../views/home.php";

                alert('You have been successfully updated your details.');
                /** TODO:: add field values */
            } else if (data === 2) {
                ajaxLoaderHide();
                alert('A user with this email address already exists.');
            }
        },
        error: function(error) {
            ajaxLoaderHide();
            alert('Registration failed. Please try again.');
        }
    });
});

/** Add mouse pointer over links */
$('#reset-password').css('cursor', 'pointer');
$('#logout').css('cursor', 'pointer');
$('#logout').css('z-index', '500');

/** On clicking reset password */
$('#reset-password').on('click', function(event) {
    /** Prevent default to stop button from attempting to validate login form */
    event.preventDefault();

    /** Show Register Modal */
    $('#resetModal').show();
});

/** 
 * On clicking the reset button
 * validate that the email address has been completed and complete an AJAX call to validate email 
 * */
 $('#resetModal').on('click', '#reset', function(event) {
    var email = $('#resetEmail').val();
    ajaxLoaderShow();

    emailValidation = validateEmail(email);
    if (emailValidation.result === false) {
        alert(emailValidation.message);

        return false;
    }
    
    $.ajax({
        url: "/gobuildtest/app/helper.php",
        dataType: "json",
        data: {
            email: email,
            function_name: 'validateEmail'
        },
        method: "POST",
        success: function(data) {
            if (data === 1) {
                ajaxLoaderHide();
                $('#resetModal').find('.modal-dialog').find('.modal-content').find('.modal-body').html('<div class="passwordRules"><p>Password must contain the following: <br /><ul><li>An uppercase letter</li><li>A lowercase letter</li><li>A number</li><li>Atleast 8 charachters</li></ul></p></div>');
                $('#resetModal').find('.modal-dialog').find('.modal-content').find('.modal-body').append('<input type="password" id="resetPassword" class="form-control" placeholder="New Password" aria-required="">');
                $('#resetModal').find('.modal-dialog').find('.modal-content').find('.modal-body').append('<input type="hidden" id="resetEmail" class="form-control" value="' + email + '" aria-required="">');
                $('#resetModal').find('.modal-dialog').find('.modal-content').find('.modal-footer').find('#reset').attr('id', 'resetContinue');
                $('#resetModal').show();
            } else {
                ajaxLoaderHide();
                alert('Email not found, please try again');
            }
        },
        error: function(error) {
            ajaxLoaderHide();
            alert('Email not found, please try again');
        }
    });
});

/**
 * Validate that password field has been completed
 * Complete AJAX Call to update password to new password
 */
$('#resetModal').on('click', '#resetContinue', function(event) {
    passwordValidation = validatePassword($('#resetPassword').val());
    
    ajaxLoaderShow();

    if (passwordValidation.result === false) {       
        alert(passwordValidation.message);

        return false;
    }
    
    $.ajax({
        url: "/gobuildtest/app/helper.php",
        dataType: "json",
        data: {
            password: $('#resetPassword').val(),
            email: $('#resetEmail').val(),
            function_name: 'resetPassword'
        },
        method: "POST",
        success: function(data) {
            if (data === 1) {
                ajaxLoaderHide();
                alert("Password has successfully been reset. Please login.");
                $('#resetModal').hide();
                $('.modal-backdrop').hide();
            } else {
                ajaxLoaderHide();
                alert('Password has not been set. Please try again.');
            }
        },
        error: function(error) {
            ajaxLoaderHide();
            alert('Password has not been set. Please try again.');
        }
    });
});

/** Function for email validation */
function validateEmail(email)
{
    var resultStatus = false;
    var resultMessage = '';

    /** 
     * Validate email field is completed 
     * if field is empty, stop form submission
    */
     if ($.trim(email) == '') {
        resultMessage = 'Please complete email field.';
    }

    /** Validate that the input completed is an email address */
    var pattern = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!pattern.test(email)) {
        resultMessage = 'Please enter a valid email address.';
    }

    if (resultMessage === '') {
        resultStatus = true;
    }

    return {result: resultStatus, message: resultMessage};
}

/** Function for password validation */
function validatePassword(password)
{
    var resultStatus = false;
    var resultMessage = '';

    /** 
         * Validate password field is completed 
         * if empty, stop form submission
        */
    if ($.trim(password) == '') {
        resultMessage = 'Please complete password field.';
    }

    /** 
     * Validate that the password contains atleast: 
     * one uppercase letter, 
     * one lowercase letter, 
     * one number
     * is atleast 8 charachters long
     * */
    var pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;

    if (!pattern.test(password)) {
        resultMessage = 'Please enter a valid password.';
    }

    if (resultMessage === '') {
        resultStatus = true;
    }

    return {result: resultStatus, message: resultMessage};
}

/** Function to validate name field */
function validateName(name)
{
    var resultStatus = false;
    var resultMessage = '';

    /** 
     * Validate name field is completed 
     * if empty, stop form submission
    */
    if ($.trim(name) == '') {
        resultMessage = 'Please complete name field.';
    }

    if (resultMessage === '') {
        resultStatus = true;
    }

    return {result: resultStatus, message: resultMessage};
}

/** Function to validate surname field */
function validateSurname(surname)
{
    var resultStatus = false;
    var resultMessage = '';

    /** 
     * Validate surname field is completed 
     * if empty, stop form submission
    */
    if ($.trim(surname) == '') {
        resultMessage = 'Please complete surname field.';
    }

    if (resultMessage === '') {
        resultStatus = true;
    }

    return {result: resultStatus, message: resultMessage};
}

/** Function to validate that a gender has been selected */
function validateGender(gender)
{
    var resultStatus = false;
    var resultMessage = '';

    /** 
     * Validate gender option is selected
     * if empty, stop form submission
    */
    if ($('input[name="' + gender + '"]:checked').length === 0) {
        resultMessage = 'Please select a gender.';
    }
    
    if (resultMessage === '') {
        resultStatus = true;
    }

    return {result: resultStatus, message: resultMessage};
}

/** Function to validate the mobile number is completed and valid */
function validateMobile(mobile)
{
    var resultStatus = false;
    var resultMessage = '';

    /** 
         * Validate mobile field is completed 
         * if empty, stop form submission
        */
    if ($.trim(mobile) == '') {
        resultMessage = 'Please complete mobile number field.';
    }

    /** validate mobile number is valid */
    var pattern = /([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/;

    if (!pattern.test(mobile)) {
        resultMessage = 'Please enter a valid mobile number.';
    }

    if (resultMessage === '') {
        resultStatus = true;
    }

    return {result: resultStatus, message: resultMessage};
}

/** Set datatable requirements */
$(document).ready(function () {
    $('#userTable').DataTable();
    $('.dataTables_length').addClass('bs-select');
});

/** 
 * Fetch holiday functionality
 * Validate year inserted
 * if validation successful, complete ajax call to fetch holiday data
 */
$('#fetch-holiday').on('click', function(event) {
    event.preventDefault();

    if ($('#year').val().length !== 4 || $('#year').val() < 2000 || $('#year').val() > 2030) {
        alert('Please input a valid year between 2000 and 2030');

        return false;
    }

    ajaxLoaderShow();

    $.ajax({
        url: "/gobuildtest/app/helper.php",
        dataType: "json",
        data: {
            year: $('#year').val(),
            function_name: 'fetchHolidays'
        },
        method: "POST",
        success: function(data) {
            if (data.code === 1) {
                $('#holdayResults').html(data.html);
                ajaxLoaderHide();
            } else {
                alert('Holiday data could not be retrieved. Please try again.');
            }
        },
        error: function(error) {
            alert('Holiday data could not be retrieved. Please try again.');
        }
    });
});

/**
 * Function to show a loader while processing is happening
 */
function ajaxLoaderShow() {
    $('#ajaxloader').show();
    $('.modal-backdrop').show();

    $('html').bind('keypress', function (e) {
        if (e.keyCode == 13) {
            return false;
        }
    });
}

/**
 * Function to hide loader when processing is complete
 */
function ajaxLoaderHide() {
    $('#ajaxloader').hide();    
    $('.modal-backdrop').hide();

    $('html').bind('keypress', function (e) {
        if (e.keyCode == 13) {
            return true;
        }
    });
}
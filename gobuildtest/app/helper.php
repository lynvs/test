<?php
include_once 'Authentication.php';
include_once 'User.php';
include_once 'Sessions.php';
include_once 'Holidays.php';

/** Helper script to handle AJAX requests and processing */

/** Set POST parameter function name to variable to allow for processing in switch case */
$functionName = filter_input(INPUT_POST, 'function_name');

if ($functionName !== null) {
    switch ($functionName) {
        case 'login':
            $return = [];
            $result = 0;
            $password = filter_input(INPUT_POST, 'password');
            $email = filter_input(INPUT_POST, 'email');

            /** Validate that the user credentials */
            $userExists = $authentication->validateUser($email, $password);

            /** If user email is found return successfull */
            if ((bool) $userExists === true) {
                $user = new User;
                $userObject = $user->getUser('email', $email);

                $session = new Sessions;
                $session->setSession($userObject);

                $result = 1;
            } 
            
            echo json_encode($return['code'] = $result);
        break;
        case 'logout':
            $session = new Sessions;

            $session->destroySession();

            echo json_encode($return['code'] = 1);
        break;
        case 'registerUser':
            $return = [];
            $result = 0;

            $post = [];
            parse_str($_POST['postForm'], $post);

            /** validate that this email has not been registered before */
            $emailExists = $authentication->validateEmail($post['inputRegisterEmail']);

            /** If user email is found return successfull */
            if ((bool) $emailExists === true) {
                $result = 2;
            }

            if ($result === 0) {
                /** Update the password in the database */
                $user = new User;
    
                $parameters['field'] = [
                    'name' => $post['inputRegisterName'],
                    'surname' => $post['inputRegisterSurname'],
                    'gender' => $post['inputRegisterGender'],
                    'email' => $post['inputRegisterEmail'],
                    'mobile' => $post['inputRegisterMobile'],
                    'password' => password_hash($post['inputRegisterPassword'], PASSWORD_DEFAULT)
                ];
    
                /** Create the new user */
                $createUser = $user->createUser($parameters);
    
                /** if update is successful then retun successful */
                if ((bool) $createUser === true) {
                    $result = 1;
                }
            }            

            echo json_encode($return['code'] = $result);
        break;
        case 'updateUser':
            $session = new Sessions;
            $return = [];
            $result = 0;

            $post = [];
            parse_str($_POST['postForm'], $post);

            /** Compare existing user data with new data - only update relevant fields */
            $user = new User;
            $userObject = $user->getUser('user_id', $_SESSION['userId']);

            if ((string) $userObject->name !== (string) trim($post['updateName'])) {
                $parameters['field']['name'] = trim($post['updateName']);
            }

            if ((string) $userObject->surname !== (string) trim($post['updateSurname'])) {
                $parameters['field']['surname'] = trim($post['updateSurname']);
            }

            if ((string) $userObject->gender !== (string) $post['updateGender']) {
                $parameters['field']['gender'] = $post['updateGender'];
            }

            if ((string) $userObject->email !== (string) trim($post['updateEmail'])) {
                $parameters['field']['email'] = trim($post['updateEmail']);
            }

            if ((string) $userObject->mobile !== (string) trim($post['updateMobile'])) {
                $parameters['field']['mobile'] = trim($post['updateMobile']);
            }

            if ((string) $post['updatePassword'] !== 'xxxxx' && (string) $post['updatePassword'] !== '') {
                $parameters['field']['password'] = trim($post['updatePassword']);
            }

            $updateUser = $user->updateUser($parameters);

            /** if update is successful then retun successful */
            if ((bool) $updateUser === true) {
                $result = 1;
            }

            echo json_encode($return['code'] = $result);
        break;
        /** validate email for reset Password */
        case 'validateEmail':
            $return = [];
            $result = 0;
            $email = filter_input(INPUT_POST, 'email');

            /** Validate that the user email exists */
            $emailExists = $authentication->validateEmail(filter_input(INPUT_POST, 'email'));

            /** If user email is found return successfull */
            if ((bool) $emailExists === true) {
                $result = 1;
            }

            echo json_encode($return['code'] = $result);
        break;
        /** Complete reset password functionality */
        case 'resetPassword':
            $return = [];
            $result = 0;

            /** Update the password in the database */
            $user = new User;
            $parameters['email'] = filter_input(INPUT_POST, 'email');
            $parameters['field'] = ['password' => password_hash(filter_input(INPUT_POST, 'password'), PASSWORD_DEFAULT)];

            $updatePassword = $user->updateUser($parameters);

            /** if update is successful then retun successful */
            if ((bool) $updatePassword === true) {
                $result = 1;
            }

            echo json_encode($return['code'] = $result);
        break;
        case 'fetchHolidays':
            $return = [];
            $result = 0;
            $html = '';

            $holidays = new Holidays;
            $startYear = filter_input(INPUT_POST, 'year');
            $endYear = $startYear + 10;

            /** Create array of years */
            $years = range($startYear, $endYear);

            /** Get holiday details */
            $equinoxResults = $holidays->getApiData($years);

            /** If details are returined build HTML string */
            if (count($equinoxResults) > 0) {
                $html = buildHtmlResults($equinoxResults);

                $result = 1;
            } else {
                $html = '<div>No Results Found</div>';
            }

            $return['code'] = $result;
            $return['html'] = $html;
            
            echo json_encode($return);
        break;
    }
}

/**
 * Function to build a table of results to insert into html
 *
 * @param array $equinoxResults
 * @return string
 */
function buildHtmlResults($equinoxResults)
{
    $html = '';

    $html .= '<table id="resultsTable" class="table table-striped table-bordered table-sm">
                <thead>
                    <tr>
                    <th scope="col">Holiday</th>
                    <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($equinoxResults as $results) {
        $html .= '<tr>
                    <td>' . $results['title'] . '</td>
                    <td>' . $results['date'] . '</td>
                </tr>';
    }

    $html .= '</tbody>
            </table>';

    return $html;
}
<?php

// Routes
$app->get('/', function($request, $response, $args) {
    // Log message
    $this->logger->info("braintree '/' index");

    // Render index view
    return $this->renderer->render($response, 'form.html', $args);
});
$app->post('/application', function($request, $response, $args) {
    //Log message
    $this->logger->info("braintree '/' application");

    $rawData = $_POST;
    if (isset($rawData)) {
        // Retrieve form field values remove special characters, validate and sanitize them
        $fname = htmlspecialchars(trim($rawData['first-name']));
        $lname = htmlspecialchars(trim($rawData['last-name']));
        $address = htmlspecialchars(trim($rawData['address']));
        $ssn = htmlspecialchars(trim($rawData['ssn']));
        $email = htmlspecialchars(trim($rawData['email']));
        $confirmEmail = htmlspecialchars(trim($rawData['email-confirmation']));
        $submitted_at = date(DATE_RFC2822);
        $dataValid = true;

        // Sanitize and validate data
        $sanitized_fname = filter_var($fname, FILTER_SANITIZE_STRING);
        $sanitized_lname = filter_var($lname, FILTER_SANITIZE_STRING);
        $sanitized_address = filter_var($address, FILTER_SANITIZE_STRING);
        $sanitized_ssn = filter_var($ssn, FILTER_SANITIZE_STRING);
        $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
            $dataValid = false;
        }
        $sanitized_confEmail = filter_var($confirmEmail, FILTER_SANITIZE_EMAIL);
        if (!filter_var($sanitized_confEmail, FILTER_VALIDATE_EMAIL)) {
            $dataValid = false;
        }
        if (strcmp($sanitized_email, $sanitized_confEmail) != 0) {
            $dataValid = false;
        }

        if (empty($sanitized_fname) || empty($sanitized_lname) || empty($sanitized_address) || empty($sanitized_ssn) || empty($sanitized_email) || empty($sanitized_confEmail)) {
            $dataValid = false;
        }

        // Prepare data to be sent in response body
        $data = array('First Name' => $sanitized_fname, 'Last Name' => $sanitized_lname, 'Address' => $sanitized_address, 'SSN' => $sanitized_ssn, 'Email' => $sanitized_email, 'Confirmation Email' => $sanitized_confEmail, 'Submitted At' => $submitted_at);

        // If any data is not valid then change the status code to 400 otherwise set to 201 and then send response
        if ($dataValid == false) {
            $newResponse = $response->withJson($data, 400)->withHeader('Content-type', 'application/json');
            return $newResponse;
        }else {
            $newResponse = $response->withJson($data, 201)->withHeader('Content-type', 'application/json');
            return $newResponse;
        }
    }
});
Web application with real-time client-side Javascript validation
---

This web project has a form which gives real-time client-side Javascript validation as the user enters information. 
Then when the form is submitted, a mock status code is given based on whether or not the data passed to the 
"server" is valid or not. This project uses the Slim Framework as well as Bootstrap.

This web project has two parts:

1. Build a client side application that:

  - Validates the form in `templates/form.html`:
    - All fields are required
    - `email` and `email-confirmation` must match
    - `address` must not contain `P.O. Box` `PO Box` or any variation thereof
    - `ssn` must:
      - have a length of 9 digits
      - _not_ consist of the same digit (e.g. `111 11 1111` is INVALID)
      - _not_ equal one of these blacklisted numbers: `123456789` `987654321`
 - Displays any validation errors to users in real-time
 - Makes a client-side POST request to `/application` with the following in the request body:
    - the data from the form
    - a `submitted-at` field that is set to the date and time of the submission (you can use `new Date()`)
 - Does not allow for multiple form submissions while a request is processing
 - Alters its presentation based on the user's viewport

2. Create a simple back-end that serves up your front-end code and:
  - receives POST requests at `/application`
    - responds with a `201` if the validation criteria mentioned above are met
    - responds with a `400` if the validation criteria are not met


# How to run this application

You can then run this application with PHP's built-in webserver:

1. Using the command line (or terminal) go into the application's folder
    - $ cd [folder name]; 
2. Run the following command to get the webserver running:
    - php -S 0.0.0.0:8080 -t public public/index.php
3. Open up a Chrome browser window and go to http://0.0.0.0:8080 to view the form
    - Go to the Network tab on the Chrome Browser's Developer tools to view the status codes.
4. To quick the webserver go into the command line and press `Ctrl-C` 




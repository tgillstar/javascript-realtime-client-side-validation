//Check if address has PO Box pattern
function checkAddress(input) {
    var error = document.querySelector('.error-address');
    var pattern = /\b(?:p\.?\s*o\.?|post\s+office)(\s+)?(?:box|[0-9]*)?\b/i;
    if (pattern.test(input.value)) {
        error.innerHTML = 'Invalid address - No PO Box addresses accepted';
        input.setCustomValidity('Enter a valid address');
    } else {
        // input is fine -- reset the error message
        error.innerHTML = ""; // Reset the content of the message
        error.className = "error-address"; // Reset the visual state of the message
        input.setCustomValidity('');
    }
}
//Check that SSN meets basic constraints
function checkSSN(input) {
    var pattern = new RegExp("\d{9}");
    //var x = document.getElementById("ssn");
    var res = pattern.test(input.value);
    if(!res){
        input.value = input.value
           .match(/\d*/g).join('')
           .match(/(\d{0,3})(\d{0,2})(\d{0,4})/).slice(1).join('-')
           .replace(/-/g, '');
    }
    checkSSNBlacklist(input);
    checkSSNDuplicates(input);
}
//Check that the digits are not duplicate numbers
function checkSSNDuplicates(input) {
    var pattern = /^(\d)\1+$/;
    if (pattern.test(input.value)) {
        input.setCustomValidity('Not a valid SSN');
    } else {
        // input is fine -- reset the error message
        input.setCustomValidity('');
    }
}
//Check that the ssn not on the blacklist
function checkSSNBlacklist(input) {
    var error = document.querySelector('.error-ssn');
    var pattern1 = /^123456789$/;
    var pattern2 = /^987654321$/;
    if ((pattern1.test(input.value)) || (pattern2.test(input.value))) {
        error.innerHTML = 'Invalid SSN - This number is blacklisted';
        input.setCustomValidity('Enter a vaild SSN');
    } else {
        // input is fine -- reset the error message
        error.innerHTML = ""; // Reset the content of the message
        error.className = "error-ssn"; // Reset the visual state of the message
        input.setCustomValidity('');
    }
}
//Confirm that email fields match
function confirmEmail(input) {
    var email = document.getElementById("email").value;
    if(email != input.value) {
        input.setCustomValidity('Email Not Matching!');
    }else {
        // input is fine -- reset the error message
        input.setCustomValidity('');
    }
}
function processForm() {
    var fname = document.getElementById("first-name").value;
    var lname = document.getElementById("last-name").value;
    var address = document.getElementById("address").value;
    var ssn = document.getElementById("ssn").value;
    var email = document.getElementById("email").value;
    var confirmEmail = document.getElementById("email-confirmation").value;

// Returns successful data submission message when the entered information is stored in database.
    //var dataString = 'name1=' + name + '&email1=' + email + '&password1=' + password + '&contact1=' + contact;
    if (fname == '' || lname == '' || address == '' || ssn == '' || email == '' || confirmEmail == '') {
        alert("Please Fill All Fields");
    } else {
// AJAX code to submit form.
        $.ajax({
         type: "POST",
         url: "/application",
         data: dataString,
         cache: false,
         success: function(html) {s
         alert(html);
         }
         });
    }
    return false;
}


<?php
function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function generateRandomCode($length = 10) {
    // Characters to include in the random code
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Get the total number of possible characters
    $charactersLength = strlen($characters);

    // Initialize the random code variable
    $randomCode = '';

    // Loop through and add random characters to the code
    for ($i = 0; $i < $length; $i++) {
        // Select a random character and append it to the code
        $randomCode .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomCode;
}
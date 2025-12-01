<?php
// ----------------------------
// CONFIGURATION
// ----------------------------
$to = "csk16310@gmail.com"; // ✅ CHANGE THIS to your real email
$subject = "New Order Form Submission";

// ----------------------------
// HELPER FUNCTION
// ----------------------------
function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// ----------------------------
// VALIDATION
// ----------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    $name = clean_input($_POST["name"] ?? '');
    $email = clean_input($_POST["email"] ?? '');
    $url = clean_input($_POST["url"] ?? '');
    $designer_name = clean_input($_POST["designer_name"] ?? '');
    $designer_url = clean_input($_POST["designer_url"] ?? '');
    $country = clean_input($_POST["country"] ?? '');
    $keywords = clean_input($_POST["keywords"] ?? '');
    $description = clean_input($_POST["description"] ?? '');

    // Required fields
    if (empty($name) || empty($email) || empty($url) || empty($designer_name) || empty($designer_url) || empty($country) || empty($keywords) || empty($description)) {
        $errors[] = "All fields are required.";
    }

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // URL validation
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        $errors[] = "Invalid Website URL.";
    }
    if (!filter_var($designer_url, FILTER_VALIDATE_URL)) {
        $errors[] = "Invalid Designer URL.";
    }

    // If validation fails, show error message
    if (!empty($errors)) {
        echo "<h3>Form Error(s):</h3><ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul><p><a href='javascript:history.back()'>Go Back</a></p>";
        exit;
    }

    // ----------------------------
    // BUILD EMAIL CONTENT
    // ----------------------------
    $message = "
    <h2>New Order Form Submission</h2>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Website URL:</strong> $url</p>
    <p><strong>Designer Name:</strong> $designer_name</p>
    <p><strong>Designer URL:</strong> $designer_url</p>
    <p><strong>Country:</strong> $country</p>
    <p><strong>Keywords:</strong> $keywords</p>
    <p><strong>Description:</strong> $description</p>
    ";

    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: <$email>" . "\r\n";

    // ----------------------------
    // SEND EMAIL
    // ----------------------------
    if (mail($to, $subject, $message, $headers)) {
        // Redirect on success
        header("Location: packages.html");
        exit;
    } else {
        echo "<h3>Sorry, your message could not be sent. Please try again later.</h3>";
    }
} else {
    echo "Invalid request method.";
}
?>

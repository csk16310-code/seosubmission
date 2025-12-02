<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request method.");
}

// Get POST values safely
$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$url = trim($_POST["url"]);
$designer_name = trim($_POST["designer_name"]);
$designer_url = trim($_POST["designer_url"]);
$country = trim($_POST["country"]);
$keywords = trim($_POST["keywords"]);
$description = trim($_POST["description"]);

// Basic validation
if (empty($name) || empty($email) || empty($url)) {
    die("All fields are required.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

// Email content
$to = "info@seosubmission.io";
$subject = "New Submission Received";

$body = "
Name: $name
Email: $email
Website URL: $url
Designer Name: $designer_name
Designer URL: $designer_url
Country: $country
Keywords: $keywords
Description:$description";

// Better headers for DreamHost
// $headers  = "From: info@seosubmission.co\r\n";
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";

// Send email
if (mail($to, $subject, $body, $headers)) {
    header("Location: packages.html");
    exit();
} else {
    echo "Mail sending failed.";
}
?>

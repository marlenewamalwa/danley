<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

$name    = htmlspecialchars(trim($_POST['name']    ?? ''));
$email   = htmlspecialchars(trim($_POST['email']   ?? ''));
$phone   = htmlspecialchars(trim($_POST['phone']   ?? ''));
$subject = htmlspecialchars(trim($_POST['subject'] ?? 'General Enquiry'));
$message = htmlspecialchars(trim($_POST['message'] ?? ''));

if (!$name || !$email) {
    http_response_code(400);
    exit;
}

$to           = 'info@danleylogistics.com';
$subject_line = "New Enquiry: $subject — from $name";
$body         = "Name:    $name\nEmail:   $email\nPhone:   $phone\nEnquiry: $subject\n\n$message";
$headers      = "From: Danley Website <noreply@danleylogistics.com>\r\n"
              . "Reply-To: $name <$email>\r\n"
              . "Content-Type: text/plain; charset=UTF-8";

mail($to, $subject_line, $body, $headers);
echo 'ok';
?>
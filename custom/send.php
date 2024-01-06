<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Verify Google reCAPTCHA
    $captcha = $_POST['g-recaptcha'];
    $secretKey = '6LfPs0cpAAAAALZTV80UuCrJ-3Nr766cf0q5RicR'; // Replace with your reCAPTCHA secret key
    // $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
    $response = file_get_contents("https://recaptchaenterprise.googleapis.com/v1/projects/art-1704509330616/assessments?key=API_KEY");
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        echo "Please complete the CAPTCHA.";
    } else {
        // Email details
        $to = '8artenquiries@gmail.com'; // Replace with your Gmail address
        $subject = '8art Enquiry Form - New Enquiry';
        $headers = "From: $email\r\nReply-To: $email";
        
        // Send email
        if (mail($to, $subject, $message, $headers)) {
            echo "Message sent successfully!";
        } else {
            echo "Failed to send the message.";
        }
    }
}
?>

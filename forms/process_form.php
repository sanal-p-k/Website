<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $services = isset($_POST['service']) ? implode(", ", $_POST['service']) : "No service selected";
    $message = htmlspecialchars(trim($_POST['message']));

    // Email settings
    $to = "sanalpkwork@gmail.com";  // 🔥 Replace with your email
    $subject = "New Service Request from $name";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Email content
    $email_content = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            h2 { color: #007bff; }
            p { margin: 10px 0; }
            strong { color: #000; }
        </style>
    </head>
    <body>
        <h2>Service Request Details</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Phone:</strong> $phone</p>
        <p><strong>Services Needed:</strong> $services</p>
        <p><strong>Message:</strong><br>$message</p>
    </body>
    </html>
    ";

    // Send the email
    if (mail($to, $subject, $email_content, $headers)) {
        echo "<script>alert('Your request has been sent successfully!'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Failed to send the request. Please try again later.'); window.location.href='index.html';</script>";
    }
} else {
    // Redirect if accessed directly
    header("Location: index.html");
    exit;
}
?>

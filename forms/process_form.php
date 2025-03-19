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
        // Display Thank You message and auto-redirect
        echo "
        <html>
        <head>
            <meta http-equiv='refresh' content='5;url=index.html'> <!-- Auto redirect after 5 seconds -->
            <style>
                body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
                h1 { color: #28a745; }
                p { color: #555; }
                a { text-decoration: none; color: #007bff; }
                a:hover { text-decoration: underline; }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    background: #f4f4f4;
                    padding: 30px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px #ccc;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>Thank You! 🎉</h1>
                <p>Your service request has been submitted successfully.</p>
                <p>You will be redirected to the home page shortly...</p>
                <p>If you are not redirected, <a href='index.html'>click here</a>.</p>
            </div>
        </body>
        </html>
        ";
    } else {
        echo "
        <script>
            alert('Failed to send the request. Please try again later.');
            window.location.href = 'index.html';
        </script>";
    }
} else {
    // Redirect if accessed directly
    header("Location: index.html");
    exit;
}
?>

<?php
// Init message
$msg = '';
$msgClass = '';
// Check for submit
if ( filter_has_var( INPUT_POST, 'submit' ) ) {
    // Get form data
    $name = htmlspecialchars( $_POST['name'] );
    $email = htmlspecialchars( $_POST['email'] );
    $message = htmlspecialchars( $_POST['message'] );
    if ( ! empty( $name ) && ! empty( $email ) && ! empty( $message ) ) {
        // Check email
        if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) === false  ) {
            // Failed invalid email
            $msg = 'Please use a valid email';
            $msgClass = 'alert-danger';
        } else {
            // Message details
            $to_email = 'v.kamuz@gmail.com';
            $subject = 'Contact Request From ' . $name;
            $body = '<h2>Contact Request</h2>';
            $body .= '<p><strong>Name:</strong> ' . $name . '</p>';
            $body .= '<p><strong>Email:</strong> ' . $email . '</p>';
            $body .= '<p><strong>Message:</strong> ' . $message . ' </p>';
            // Headers
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
            $headers .= "From: " . $name . "<" . $email . ">" . "\r\n";
            // Send email and display message
            if ( mail( $to_email, $subject, $body, $headers ) ) {
                $msg = "Your email has been sent";
                $msgClass = "alert-success";
            } else {
                $msg = 'Your email was not sent';
                $msgClass = 'alert-danger';
            }
        }
    } else {
        // Failed
        $msg = 'Please fill in all fields';
        $msgClass = 'alert-danger';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP based simple contact form</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My Website</a>
        </div>
    </nav>
    <div class="container pt-md-1 pb-md-4 mt-3">
      <div class="row">
        <div class="col-xl-12">
          <h1 class="bd-title mt-0">Contact Form</h1>
          <p class="bd-lead">Quickly get a project started with any of our examples ranging from using parts of the framework to custom components and layouts.</p>
      </div>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <?php if ( $msg != '' ) : ?>
                <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo isset( $name ) ? $name : false; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" class="form-control" id="email" name="email" value="<?php echo isset( $email ) ? $email : false; ?>">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Your Message</label>
                <textarea class="form-control" id="message" rows="3" name="message"><?php echo isset( $message ) ? $message : false; ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
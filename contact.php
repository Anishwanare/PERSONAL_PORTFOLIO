<?php
  // Make sure the correct path to the library is used
  $receiving_email_address = 'anishwanare@gmail.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  // Make sure POST data exists
  if (isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
    $contact->to = $receiving_email_address;
    $contact->from_name = $_POST['name'];
    $contact->from_email = $_POST['email'];
    $contact->subject = $_POST['subject'];

    // Optional SMTP configuration
    $contact->smtp = array(
      'host' => 'smtp.gmail.com',
      'username' => 'your-email@gmail.com',
      'password' => 'your-email-password',
      'port' => '587'
    );

    // Add message data
    $contact->add_message( $_POST['name'], 'From');
    $contact->add_message( $_POST['email'], 'Email');
    $contact->add_message( $_POST['message'], 'Message', 10);

    // Send email
    echo $contact->send();
  } else {
    echo 'Error: Please fill all the fields.';
  }
?>

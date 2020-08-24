<?php

// Enqueue bootstrap styles

wp_enqueue_style('bootstrap');
wp_enqueue_style('bootstrap.min');
wp_enqueue_style('bootstrap-grid');
wp_enqueue_style('bootstrap-grid.min');
wp_enqueue_style('bootstrap-reboot');
wp_enqueue_style('bootstrap-reboot.min');


/**
 * Template Name: application
 * The template for displaying all pages
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UltraPress
 */

// if(isset($_POST['submitted'])) {
// 	print_r($_POST);
// 	if(trim($_POST['contactName']) === '') {
// 		$nameError = 'Please enter your name.';
// 		$hasError = true;
// 	} else {
// 		$name = trim($_POST['contactName']);
// 	}

// 	if(trim($_POST['email']) === '')  {
// 		$emailError = 'Please enter your email address.';
// 		$hasError = true;
// 	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
// 		$emailError = 'You entered an invalid email address.';
// 		$hasError = true;
// 	} else {
// 		$email = trim($_POST['email']);
// 	}

// 	if(trim($_POST['comments']) === '') {
// 		$commentError = 'Please enter a message.';
// 		$hasError = true;
// 	} else {
// 		if(function_exists('stripslashes')) {
// 			$comments = stripslashes(trim($_POST['comments']));
// 		} else {
// 			$comments = trim($_POST['comments']);
// 		}
// 	}

// 	if(!isset($hasError)) {
// 		$emailTo = get_option('tz_email');
// 		if (!isset($emailTo) || ($emailTo == '') ){
// 			$emailTo = get_option('admin_email');
// 		}
// 		$subject = '[PHP Snippets] From '.$name;
// 		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
// 		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

// 		wp_mail($emailTo, $subject, $body, $headers);
// 		$emailSent = true;
// 	}

// } ?>
<?php get_header(); ?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Job Application</title>
  </head>
  <body>
  <div class="container">
      <h2>Application Form</h2>
        </br>
      <!-- <a href="http://localhost/wordpress/wp-content/uploads/resumes/a.png" target="_blank" download>WordPress Download PDF</a> -->
      <form action="http://localhost/wordpress/wp-admin/admin-post.php?action=job_application" method="POST" enctype="multipart/form-data">
        <div class="row w-50">
            <div class="col w-25">
                <div class="form-group">
                    <label for="exampleInputPassword1">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" required>
                </div>
            </div>
            <div class="col w-25">
                <div class="form-group">
                    <label for="exampleInputPassword1">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" required>
                </div>
            </div>
        </div>
          <div class="row w-50">
              <div class="col">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
              </div>
          </div>
          <div class="row w-75">
              <div class="col">
                <div class="form-group">
                    <label for="exampleInputPassword1">Contact Details</label>
                    <input type="text" class="form-control" id="contact-info" name="contact-info" required>
                </div>
              </div>
          </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Resume</label>
            <input type="file" class="form-control" id="resume" name="resume" accept="application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required>
        </div>
      <input type="hidden" name="job" value="<?php echo $_GET['job'];?>">
      <input type="hidden" name="action" value="job_application">
      <button type="submit" class="search-submit btn-lg" name="submit" id="submit" value="submit">Submit</button>
      </form>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
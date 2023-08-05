<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="keywords" content="Infilearn,free,e-learning,learning,platform,free learning">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="robots" content="index" />

    <meta name="googlebot" content="index">
    <meta name="googlebot-news" content="snippet">
    <!-- Generated -->
    <!-- Primary Meta Tags -->
    <title>Contact | InfiLearn - India's free E-learning platform</title>
    <meta name="title" content="InfiLearn - India's free E-learning platform">
    <meta name="description" content="Infilearn provides a free learning platform for all students. A free E-Learning Platform for students">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://infilearn.000webhostapp.com/">
    <meta property="og:title" content="InfiLearn - India's free E-learning platform">
    <meta property="og:description" content="Infilearn provides a free learning platform for all students. A free E-Learning Platform for students">
    <meta property="og:image" content="https://infilearn.000webhostapp.com/content/icons/new.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://infilearn.000webhostapp.com/">
    <meta property="twitter:title" content="InfiLearn - India's free E-learning platform">
    <meta property="twitter:description" content="Infilearn provides a free learning platform for all students. A free E-Learning Platform for students">
    <meta property="twitter:image" content="https://infilearn.000webhostapp.com/content/icons/new.png">


    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/errors.css">
    <link rel="icon" href="content/logo/LinkLogo.png" type="image/png" sizes="16x16">



    <!--Header-->
</head>

<body>
    <?php include('header.php'); ?>


    <!-- Section Contact us -->
    <section class="contact-us-section-contact-page">
        <div class="contact-us-section-div-contact-page">
            <h2>Lets Contact</h2>
        </div>
    </section>

    <!-- Section Contact us Form -->

    <section class="contact-us-form-send-mesg-section">
        <div class="contact-us-form-send-mesg-section-div">
            <div class="contact-us-form-send-mesg-form">
                <div class="contact-us-form-send-mesg-form-send-msg-div">
                    <div class="contact-us-form-send-msg-form-title">
                        <h3>Send us a message</h3>
                    </div>
                    <form action="contactus.php" method="post">
                        <div class="contact-us-form-send-msg-form-all-inputs">
                            <div class="contact-us-form-send-msg-form-input">
                                <input type="text" name="username" id="username" placeholder="Name" required>
                            </div>
                            <div class="contact-us-form-send-msg-form-input">
                                <input type="email" name="email" id="email" placeholder="Email" required>
                            </div>
                            <div class="contact-us-form-send-msg-form-input">
                                <input type="text" name="subject" id="subject" placeholder="Subject" required>
                            </div>
                            <div id="mesg-send-contact-form" class="contact-us-form-send-msg-form-input">
                                <textarea name="message" id="message" cols="30" rows="10" placeholder="Message" required ></textarea>
                            </div>
                        </div>
                        <div class="contact-us-form-send-msg-form-input-submit-btn">
                            <input type="submit" name="contct_form_send_btn" value="Send Message">
                        </div>
                    </form>
                </div>
                <div class="contact-us-form-send-mesg-form-contact-us-info">
                    <div class="contact-us-form-contact-us-info-title">
                        <h3>Contact Us</h3>
                        <hr class="contact-us-form-info-hr">
                    </div>
                    <div class="contact-us-form-contact-us-info-title-desc">
                        <p>Whether a help,doubt,ask a question,or anything else feel free to contact us</p>
                    </div>
                    <div class="contact-us-form-contact-us-info-all-links">

                        <ul class="contact-us-links-contact-form">
                            <li>
                                <div id="form-info-link-icon-1" class="form-info-link-icon">
                                    <img src="content/contact_us/location_on_black_48dp.svg" alt="Infilearn Location"
                                        height="30px" width="30px"><span><b>Address:</b> Pune, Maharashtra, India</span>
                                </div>
                            </li>

                            <li>
                                <div id="form-info-link-icon-2" class="form-info-link-icon">
                                    <img src="content/contact_us/email_black_24dp.svg" alt="Infilearn Location"
                                        height="30px" width="30px"><span><b>Email:</b> infilearnn@gmail.com</span></div>
                            </li>
                            <li>
                                <div id="form-info-link-icon-3" class="form-info-link-icon">
                                    <img src="content/contact_us/website.svg" alt="Infilearn Location" height="30px"
                                        width="30px"><span><b>Website:</b> Comming Soon...</span></div>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include('footer.php') ?>


    <!-- Modal -->

    <?php include('loginmodal.php') ?>
    <script src="js/script.js"></script>

</body>

</html>

<?php

if(isset($_POST['contct_form_send_btn'])){
    if(isset($_POST['username'])){
        if(isset($_POST['email'])){
            if(isset($_POST['subject'])){
                if(isset($_POST['message'])){

                    $name = $_POST['username'];
                    $email = $_POST['email'];
                    $subject = $_POST['subject'];
                    $user_mesg = $_POST['message'];

                    require('PHPMailerAutoload.php');
 
                    $message = '<div class="email-body" style="width: 98%;height: fit-content;text-align: center;">
                    <div class="email-box" style="width: 100%;height: fit-content;border: 3px solid #fe4a55;border-radius: 8px;">
                        <div class="email-box-title" style="height: 120px;width: 100%; background-color: #fe4a55;text-align: center;display:flex;justify-content: center;align-items: center;">
                            <h1 style="margin: auto;color: #fff;font-family: sans-serif;font-size: 5vh;text-align: center;">Infilearn User Message</h1>
                        </div>
                        <div class="email-box-info" style="padding:50px 0;text-align: center;">
                            <table style="margin: auto;font-family:sans-serif;border-collapse: collapse;width: 70%;border-radius: 7px;border: 2px solid #666;">
                                <tr>
                                  <th style="border: 1px solid #adadad;text-align: left;padding: 12px;">Name</th>
                                  <th style="border: 1px solid #adadad;text-align: left;padding: 12px;">Email</th>
                                  <th style="border: 1px solid #adadad;text-align: left;padding: 12px;">Subject</th>
                                  <th style="border: 1px solid #adadad;text-align: left;padding: 12px;">Message</th>
                                </tr>
                                <tr>
                                  <td style="border: 1px solid #adadad;text-align: left;padding: 12px;">'.$name.'</td>
                                  <td style="border: 1px solid #adadad;text-align: left;padding: 12px;">'.$email.'</td>
                                  <td style="border: 1px solid #adadad;text-align: left;padding: 12px;">'.$subject.'</td>
                                  <td style="border: 1px solid #adadad;text-align: left;padding: 12px;">'.$user_mesg.'</td>
                                </tr>
                              </table>
                        </div>
                    </div>
                </div>';


                    $mail = new PHPMailer;
                    $mail->IsSMTP();        //Sets Mailer to send message using SMTP
                    $mail->Host = 'smtp.gmail.com';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
                    $mail->Port = 587;
                    $mail->SMTPDebug = 0;        //Sets the default SMTP server port
                    $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
                    $mail->Username = 'help.infilearn@gmail.com';     //Sets SMTP username
                    $mail->Password = 'StudLonde';     //Sets SMTP password
                    $mail->SMTPSecure = 'tls';       //Sets connection prefix. Options are "", "ssl" or "tls"
                    $mail->From = 'help.infilearn@gmail.com';     //Sets the From email address for the message
                    $mail->FromName = 'Infilearn';    //Sets the From name of the message
                    $mail->AddAddress('infilearnn@gmail.com', 'infilearn');  //Adds a "To" address
                    $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
                    $mail->IsHTML(true);       //Sets message type to HTML
                    // $mail->AddAttachment($path);     //Adds an attachment from a path on the filesystem
                    $mail->Subject = 'Infilearn - User want to contact with us';    //Sets the Subject of the message
                    $mail->Body = $message;       //An HTML or plain text message body
                    if($mail->Send()){        //Send an Email. Return true on success or false on error
                        echo '
                            <div class="client-error-mesg">
                                <p>Thank you for contacting us! :)</p>
                            </div>';
                        echo '<script>window.history.replaceState( null, null, window.location.href );</script>';
                    }
                    else{
                        echo '
                            <div class="client-error-mesg">
                                <p>Error in contacting us, Please Try Again Later :(</p>
                            </div>';
                        echo '<script>window.history.replaceState( null, null, window.location.href );</script>';
                    }
                }
            }
        }
    }
    
}
?>
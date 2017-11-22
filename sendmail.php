<?php 
    require('vendor/mail/PHPMailerAutoload.php');
    require_once("include/DB.php");
    require_once("include/Session.php");
    require_once("include/Function.php");



    if(isset($_POST['Submit'])) {
        $email = $_POST['emailaddress'];
        $content = $_POST['gopy'];
        if (empty($email) || empty($content)) {
            $_SESSION["ErrorMessage"] = "Sao mày đéo điền gì hết vậy";
            Redirect_to("index.php");
        } 
        else {
            global $Connection;
            mysqli_set_charset($Connection, 'utf8');
            $Query = "INSERT INTO feedback(email, content) VALUES('$email', '$content')";
            $Execute = mysqli_query($Connection, $Query);
            if($Execute) {
                $emailAddress = $_POST['emailaddress'];
                $content = $_POST['gopy'];
                $mail = new PHPMailer;
                
                //$mail->isSMTP();            
                //Set SMTP host name         
                $mail->CharSet = 'UTF-8';
                                    
                $mail->Host = "smtp.gmail.com";
                //Set this to true if SMTP host requires authentication to send email
                $mail->SMTPAuth = true;                          
                //Provide username and password     
                $mail->Username = "trannhulucs2303@gmail.com";                 
                $mail->Password = "jwxiksinsogpmzcm";                           
                //If SMTP requires TLS encryption then set it
                $mail->SMTPSecure = "tls";                           
                //Set TCP port to connect to 
                $mail->Port = 587;                                   
            
                $mail->From = "trannhulucs2303@gmail.com";
                $mail->FromName = "Quản trị Web AoAnhs2303.tk";
            
                $mail->addAddress($emailAddress, "AoAnhs2303");
                $mail->addAddress("trannhulucs2303@gmail.com", $emailAddress);
            
                $mail->isHTML(true);
            
                $mail->Subject = 'Góp ý cho trang web aoanhs2303.tk';
                $mail->Body = $content;
                // $mail->AltBody = "This is the plain text version of the email content";
            
                if(!$mail->send()) {
                    $_SESSION["ErrorMessage"] = "Mailer Error: " . $mail->ErrorInfo;
                    Redirect_to("index.php");
                } else {
                    Redirect_to("successEmail.html");
                }
            } else {
                $_SESSION["ErrorMessage"] = "Lỗi con mẹ nó rồi";
                Redirect_to("index.php");
            }
        }
    }










?>
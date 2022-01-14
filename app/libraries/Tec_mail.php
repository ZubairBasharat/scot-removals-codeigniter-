<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
*  ==============================================================================
*  Author   : Ali Bin Younas
*  Email    : alibinyounas@adroitlight.com
*  Web      : https://adroitlight.com
*  ==============================================================================
*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Tec_mail{

    public function __construct() {

    }

    public function __get($var) {
        return get_instance()->$var;
    }

    public function send_mail($to, $subject, $body, $from = NULL, $from_name = NULL, $attachment = NULL, $cc = NULL, $bcc = NULL) {
        $mail = new PHPMailer;
        // $mail->SMTPDebug = 4;
        $mail->CharSet = 'UTF-8';
        try {
            if ($this->Settings->protocol == 'mail') {
                $mail->isMail();
            } elseif ($this->Settings->protocol == 'sendmail') {
                $mail->isSendmail();
            } elseif ($this->Settings->protocol == 'smtp') {
                $this->load->library('email');
                $config = Array(
                    'smtp_user' => $this->Settings->smtp_user,
                    'smtp_pass' => $this->Settings->smtp_pass,
                    'mailtype' => 'html',
                );
                
                // $mail->isSMTP();
				// $mail->SMTPAuth = true;
				// $mail->SMTPSecure = !empty($this->Settings->smtp_crypto) ? $this->Settings->smtp_crypto : false;
                // $mail->Host = $this->Settings->smtp_host;
				// $mail->Port = $this->Settings->smtp_port;
                // $mail->Username = $this->Settings->smtp_user;
                // $mail->Password = $this->Settings->smtp_pass;
                // $mail->SMTPDebug = 2;
            } else {
                $mail->isMail();
            }

            if ($from && $from_name) {   
                $mail->setFrom($from, $from_name);
                $mail->addReplyTo($from, $from_name);
            } elseif ($from) {
                $mail->setFrom($from, $this->Settings->site_name);
                $mail->addReplyTo($from, $this->Settings->site_name);
            } else {
                // $mail->setFrom($this->Settings->default_email, $this->Settings->site_name);
                // $mail->addReplyTo($this->Settings->default_email, $this->Settings->site_name);
                $email_subject = $subject;
                $this->email->initialize($config);
                $this->email->from($this->Settings->smtp_user, "Scot-Removals");
                $this->email->to($to);
                $this->email->subject($email_subject);
                $message = $body;
                $this->email->message($message);
                if($this->email->send()){
                    return true;
                }
            }

            if ($this->Settings->protocol == 'smtp') {
                $mail->addAddress($to);
                if ($cc) { $mail->addCC($cc); }
                if ($bcc) { $mail->addBCC($bcc); }
                $mail->Subject = $subject;
                $mail->isHTML(true);
                $mail->Body = $body;
                if ($attachment) {
                    if (is_array($attachment)) {
                        foreach ($attachment as $attach) {
                            $mail->addAttachment($attach);
                        }
                    } else {
                        $mail->addAttachment($attachment);
                    }
                }

                if (!$mail->send()) {
                    echo $mail->ErrorInfo;
                    throw new Exception($mail->ErrorInfo);
                    return FALSE;
                }
                return TRUE;
            }
        } catch (Exception $e) {
            throw new \Exception($e->errorMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}

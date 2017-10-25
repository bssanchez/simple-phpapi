<?php
/*
  |--------------------------------------------------------------------------
  | Mailer APP
  |--------------------------------------------------------------------------
  |
  | Clase encargada del envío de correos
  |
 */

namespace System;

if (!defined('API')):
    die('Nothing to do here ._.');
endif;

use \PHPMailer;

/**
 * Clase para enviar correos electrónicos haciendo uso de la librería PHPMailer
 *
 * @author Grafikamos <info@grafikamos.com>
 */
class Mail
{
    private $mailer       = null;
    private $mail_options = null;

    /**
     * Enviar correo
     *
     * @param mixed $to ('email@domain.dom'|'email@domain.dom|Name To')||[{email: '', name: ''}]
     * @param string $subject
     * @param string $message
     * @param array $attachments [{name: '', path: ''}]||['path/to/file1','path/to/file2']
     */
    public function Send($to, $subject, $message, $attachments = array())
    {
        $this->ConfigMailer();
        $this->mailer->Subject = utf8_decode($subject);

        if (is_array($to)) {
            foreach ($to as $mail_data) {
                $this->mailer->addAddress($mail_data['email'],
                    utf8_decode($mail_data['name']));
            }
        } else {
            $mail_data = explode('|', $to);
            $this->mailer->addAddress($mail_data[1], utf8_decode($mail_data[0]));
        }

        $this->mailer->Body    = utf8_decode($message);
        $this->mailer->msgHTML(utf8_decode($message));
        $this->mailer->AltBody = '';

        foreach ($attachments as $file_path) {
            if (is_array($file_path) && isset($file_path['path']{5}) && file_exists($file_path['path'])) {
                $this->mailer->addAttachment($file_path['path'],
                    utf8_decode($file_path['name']));
            } else if (is_string($file_path) && file_exists($file_path)) {
                $this->mailer->addAttachment($file_path);
            }
        }

        return $this->mailer->send();
    }

    /**
     * Configurar el mailer según el tipo de conexión configurado
     */
    private function ConfigMailer()
    {
        $this->mail_options = Config::get('mailer');
        $this->mailer       = new PHPMailer();

        switch ($this->mail_options['mail_type']) {
            case 'smtp':
                $this->SetSMTPConfig();
                break;
            case 'sendmail':
                $this->mailer->isSendmail();
                break;
            case 'mail':
            default:
                break;
        }

        $this->mailer->isHTML(true);
        $this->mailer->setFrom($this->mail_options['mail_from_email'],
            $this->mail_options['mail_from_name']);
    }

    /**
     * Asignar parametro de conexión si el tipo de conexión es SMTP
     */
    private function SetSMTPConfig()
    {
        $this->mailer->isSMTP();
        $this->mailer->SMTPDebug  = $this->mail_options['smtp_debug'];
        $this->mailer->Host       = $this->mail_options['smtp_server'];
        $this->mailer->Port       = $this->mail_options['smtp_port'];
        $this->mailer->SMTPSecure = $this->mail_options['smtp_secure'];
        $this->mailer->SMTPAuth   = $this->mail_options['smtp_auth'];
        $this->mailer->Username   = $this->mail_options['smtp_user'];
        $this->mailer->Password   = $this->mail_options['smtp_password'];
    }
}
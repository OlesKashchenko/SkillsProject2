<?php

class MailTemplate
{

    protected $info = array();


    public function __construct($ident)
    {
        if (!View::exists('emails.templates.' . $ident  . '_body')) {
            $template = DB::table('email_templates')->where('ident', $ident)->first();

            if (!$template) {
                throw new RuntimeException('Template not found');
            }

            if (!file_exists(app_path() . '/views/emails/templates/')) {
                mkdir(app_path() . '/views/emails/templates/', 0777, true);
            }

            file_put_contents(
                app_path() . '/views/emails/templates/' . $ident  . '_subject.blade.php',
                $template['subject']
            );
            file_put_contents(
                app_path() . '/views/emails/templates/' . $ident  . '_body.blade.php',
                $template['body']
            );

            $this->info['subject'] = $template['subject'];
        } else {
            $this->info['subject'] = View::make('emails.templates.' . $ident . '_subject')->render();
        }

        $this->info['ident'] = $ident;
    } // end __construct

    public static function ident($ident)
    {
        $mail = new MailTemplate($ident);

        return $mail;
    } // end scopeIdent

    public function send($to, $additionalData = array())
    {
        $info = $this->info;
        $info['info'] = $additionalData;

        return Mail::queue(
            'emails.templates.' . $this->info['ident'] . '_body',
            $info,
            function($message) use ($info, $to) {
                $message->from('info@wwhere.com.ua', 'WWHERE.COM.UA')
                    ->subject($info['subject'])
                    ->to($to);
            }
        );
    } // end send
}
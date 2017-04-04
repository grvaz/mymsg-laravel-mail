<?php
namespace ItPoet\MymsgLaravelMail;

use Illuminate\Mail\Transport\Transport;
use Swift_Mime_Message;

class MymsgTransport extends Transport
{
    public function send(Swift_Mime_Message $message, &$failedRecipients = null)
    {
        $send = new \ItPoet\Mymsg\MymsgApi;
        $send->apiKey = config('mymsgmail.api_key');
        $send->protocol = 'https';
        $send->subject = $message->getSubject();
        $send->message = $message->getBody();
        $from = $message->getFrom();
        if (!empty($from)) {
            $send->fromAddress = $fromEmail = array_keys($from)[0];
            if (!empty($from[$fromEmail])) {
                $send->fromTitle = $from[$fromEmail];
            }
        }
        foreach ($message->getTo() as $address => $name) {
            $send->email1 = $address;
            $send->sendTo();
        }
    }
}
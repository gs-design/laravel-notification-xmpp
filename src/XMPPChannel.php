<?php

namespace GsDesign\XMPP;

use Illuminate\Notifications\Notification;
use GsDesign\XMPP\Exceptions\CouldNotSendNotification;

class XMPPChannel
{
    /**
     * @var XMPP
     */
    protected $xmpp;

    /**
     * Channel constructor.
     * @param XMPP $xmpp
     */
    public function __construct(XMPP $xmpp)
    {
        $this->xmpp = $xmpp;
    }

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toXMPP($notifiable);

        if (is_string($message)) {
            $message = XMPPMessage::create($message);
        }

        if ($message->toNotGiven()) {
            if (!$to = $notifiable->routeNotificationFor('xmpp')) {
                throw CouldNotSendNotification::userIdNotProvided();
            }

            $message->to($to);
        }

        if(!empty($message->payload['text'])) {
            $params = $message->toArray();
            $this->xmpp->sendMessage($params);
        }
    }
}
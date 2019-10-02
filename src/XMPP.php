<?php

namespace GsDesign\XMPP;

use GsDesign\XMPP\Exceptions\CouldNotSendNotification;
use BirknerAlex\XMPPHP\XMPP as Jabber;
use BirknerAlex\XMPPHP\Exception as ClientException;

class XMPP
{
    protected $xmpp;

    /**
     * XMPP constructor.
     * @param $host
     * @param $port
     * @param $user
     * @param $pass
     * @param $resource
     */
    public function __construct($host, $port, $user, $pass, $resource)
    {
        try {
            $this->xmpp = new Jabber($host, $port, $user, $pass, $resource);
            $this->xmpp->connect();
            $this->xmpp->processUntil('session_start', 10);
            $this->xmpp->presence();
        } catch (ClientException $exception) {
            throw CouldNotSendNotification::couldNotConnectToXMPP($exception);
        } catch (\Exception $exception) {
            throw CouldNotSendNotification::couldNotCommunicateWithXMPP($exception);
        }
    }

    /**
     *
     */
    public function __destruct()
    {
        try {
            $this->xmpp->disconnect();
        } catch (ClientExeption $exception) {
            throw CouldNotSendNotification::couldNotDisconnectFromXMPP($exception);
        } catch (\Exception $exception) {
            throw CouldNotSendNotification::couldNotCommunicateWithXMPP($exception);
        }
    }

    /**
     * @param $message
     */
    public function sendMessage($message)
    {
        try {
            foreach ($message['user_id'] as $key => $item) {
                $this->xmpp->message($item, $message['text']);
            }
        } catch (ClientException $exception) {
            throw CouldNotSendNotification::sendWithAnError($exception);
        } catch (\Exception $exception) {
            throw CouldNotSendNotification::couldNotCommunicateWithXMPP($exception);
        }
    }
}
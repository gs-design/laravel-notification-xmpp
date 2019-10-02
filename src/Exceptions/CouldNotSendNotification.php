<?php

namespace GsDesign\XMPP\Exceptions;

class CouldNotSendNotification extends \Exception
{
    /**
     * @param $message
     * @return static
     */
    public static function couldNotCommunicateWithXMPP($message)
    {
        return new static("The communication with XMPP failed. `{$message}`");
    }

    /**
     * @param $message
     * @return static
     */
    public static function couldNotConnectToXMPP($message)
    {
        return new static( "The connect to XMPP failed. `{$message}`" );
    }

    /**
     * @param $message
     * @return static
     */
    public static function couldNotDisconnectFromXMPP($message)
    {
        return new static( "The disconnect from XMPP failed. `{$message}`" );
    }

    /**
     * @param string $exception
     * @return static
     */
    public static function sendWithAnError($message)
    {
        return new static("XMPP send with an error. `{$message}`");
    }

    /**
     * Thrown when there is no user id provided.
     *
     * @return static
     */
    public static function userIdNotProvided()
    {
        return new static('XMPP notification user ID was not provided. Please refer usage docs.');
    }
}
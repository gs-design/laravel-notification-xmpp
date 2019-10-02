<?php


namespace GsDesign\XMPP;


class XMPPMessage
{
    /**
     * @var array Params payload
     */
    public $payload = [];

    /**
     * Message constructor.
     * @param string $content
     */
    public function __construct($content = '')
    {
        $this->content($content);
    }

    /**
     * @param string $content
     * @return static
     */
    public static function create($content = '')
    {
        return new static($content);
    }

    /**
     * Notification message
     *
     * @param $content
     * @return $this
     */
    public function content($content)
    {
        $this->payload['text'] = $content;

        return $this;
    }

    /**
     * @param $userId
     * @return $this
     */
    public function to($userId)
    {
        $this->payload['user_id'] = (array) $userId;

        return $this;
    }

    /**
     * @return bool
     */
    public function toNotGiven()
    {
        return empty($this->payload['user_id']) || !(boolean) reset($this->payload['user_id']);
    }

    /**
     * Additional options to send message
     *
     * @param array $options
     * @return $this
     */
    public function options(array $options)
    {
        $this->payload = array_replace($this->payload, $options);

        return $this;
    }

    /**
     * Returns payload params
     *
     * @return array
     */
    public function toArray()
    {
        return $this->payload;
    }
}
<?php

namespace MotaMonteiro\Helpers;


class ErrorHelper
{
    const STATUS_CODE = 'status_code';
    const ERROR = 'error';
    const MESSAGES = 'messages';

    /**
     * @var string
     */
    protected $statusCode;
    /**
     * @var array
     */
    protected $messages;

    public function __construct()
    {
        $this->statusCode = '200';
        $this->messages = [];
    }

    /**
     * @return string
     */
    public function getStatusCode(): string
    {
        return $this->statusCode;
    }

    /**
     * @param string $statusCode
     * @return ErrorHelper
     */
    public function setStatusCode(string $statusCode): ErrorHelper
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @param string $text
     * @return ErrorHelper
     */
    public function addMessage(string $text): ErrorHelper
    {
        $this->messages[] = $text;
        return $this;
    }

    /**
     * @return bool
     */
    public function existsErrorHelper(): bool
    {
        return (!empty($this->messages));

    }

    /**
     * @return array
     */
    public function getArrayErrorHelper(): array
    {
        return [self::STATUS_CODE => $this->statusCode, self::ERROR => true, self::MESSAGES => $this->messages];
    }

}
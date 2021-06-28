<?php

namespace Core\Command;

final class CommandResponse
{
    private int $statusCode;
    private string $message;

    /**
     * CommandResponse constructor.
     * @param int $statusCode
     * @param string $message
     */
    public function __construct(int $statusCode, string $message)
    {
        $this->statusCode = $statusCode;
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        $response = [
            'status' => $this->statusCode,
            'message' => $this->message
        ];

        return json_encode($response);
    }
}

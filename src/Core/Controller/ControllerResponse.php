<?php

namespace Core\Controller;

final class ControllerResponse
{
    private int $statusCode;
    private string $message;
    private ?array $params;

    /**
     * ControllerResponse constructor.
     * @param int $statusCode
     * @param string $message
     * @param array|null $params
     */
    public function __construct(int $statusCode, string $message, array $params = null)
    {
        $this->statusCode = $statusCode;
        $this->message = $message;
        $this->params = $params;
    }

    /**
     * @return array|null
     */
    public function getParams(): ?array
    {
        return $this->params;
    }

    public function toJson()
    {
        return json_encode([
            'status' => $this->getStatusCode(),
            'message' => $this->getMessage()
        ]);
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
}

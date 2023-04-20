<?php

namespace App\Http\Results;

use App\Constants\ErrorCodes;
use App\Helpers\GlobalHelper;

class OperationResult
{
    public function __construct(private bool $status = false, private string $message = '', private ?array $errors = [], private ?int $errorCode = null, private ?array $data = [], private ?int $httpStatusCode = 200)
    {}

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    public function getMessage(): string
    {
        return (!empty($this->message)) ? $this->message : GlobalHelper::errorMessage(ErrorCodes::GENERAL_VALIDATION_ERROR);
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }

    public function setErrors(?array $errors): void
    {
        $this->errors = $errors;
    }

    public function getErrorCode(): ?int
    {
        return (!empty($this->errorCode)) ? $this->errorCode : ErrorCodes::GENERAL_VALIDATION_ERROR;
    }

    public function setErrorCode(?int $errorCode): void
    {
        $this->errorCode = $errorCode;
    }

    public function getData(): array|object|string
    {
        return $this->data;
    }

    public function setData($data): void
    {
        $this->data = $data;
    }

    public function getHttpStatusCode(): ?int
    {
        return $this->httpStatusCode;
    }

    public function setHttpStatusCode(?int $httpStatusCode): void
    {
        $this->httpStatusCode = $httpStatusCode;
    }

    public function toArray(): array
    {
        return [
            'status' => $this->isStatus(),
            'message' => $this->message,
            'errors' => $this->errors,
            'errorCode' => $this->errorCode,
            'data' => $this->data
        ];
    }
}

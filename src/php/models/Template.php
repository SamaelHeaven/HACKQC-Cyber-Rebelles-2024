<?php

final class Template
{
    private string $filePath;
    private array $data;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        $this->data = [];
    }

    public function setVariable(string $key, mixed $value): void
    {
        $this->data[$key] = $value;
    }

    public function render(): string|null
    {
        if (!file_exists($this->filePath)) {
            return null;
        }
        extract($this->data);
        ob_start();
        require_once $this->filePath;
        return ob_get_clean();
    }
}
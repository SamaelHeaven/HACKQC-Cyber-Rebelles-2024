<?php

final class Template
{
    private string $_file_path;
    private array $_data;

    public function __construct(string $file_path)
    {
        $this->_file_path = $file_path;
        $this->_data = [];
    }

    public function set_variable(string $key, mixed $value): void
    {
        $this->_data[$key] = $value;
    }

    public function render(): string|null
    {
        if (!file_exists($this->_file_path)) {
            return null;
        }
        extract($this->_data);
        ob_start();
        require_once $this->_file_path;
        return ob_get_clean();
    }
}
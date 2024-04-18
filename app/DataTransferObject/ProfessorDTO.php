<?php

namespace App\DataTransferObject;

class ProfessorDTO
{
    public $name;
    public $email;
    public $password;

    public function __construct(array $data)
    {
        $this->name = $this->formatName($data['name']);
        $this->email = $data['email'] ?? null;
        $this->password = '123';
    }

    private function formatName(string $name): string
    {
        return substr($name, 0, 6) !== 'Prof. ' ? 'Prof. '.$name : $name;
    }
}



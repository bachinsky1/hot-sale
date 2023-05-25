<?php

declare(strict_types=1);

namespace App\Models;

use Exception;

class User extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll(): array
    {
        return $this->db;
    }

    public function getOne(int $id): array|null
    {
        if (!!intval($id) === false)
            throw new Exception("Id is required");

        return array_reduce($this->db, function ($found, $obj) use ($id) {
            return $obj['Id'] == $id ? $obj : $found;
        }, null);
    }

    public function store(array $data): bool|int
    {

        if ($this->validate($data) === false)
            return false;


        $this->log->info("User data validated.", $data);

        $this->db[] = [
            "Id" => $this->getMaxId($this->db) + 1,
            "Name" => $data['Name'],
            "Lastname" => $data['Lastname'],
            "Email" => $data['Email'],
        ];

        $newDb = json_encode($this->db, JSON_INVALID_UTF8_IGNORE | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $result = file_put_contents($this->file, $newDb);

        if (!!$result) {
            $this->log->info("New user stored to array.", $data);
        } else {
            $this->log->error("Something went wrong. Cannot store user", $data);
        }

        return $result;
    }

    public function update(array $data): bool
    {
        throw new Exception("Not implemented");
    }

    public function delete(array $data): bool
    {
        throw new Exception("Not implemented");
    }

    private function validate(array $data): bool
    {
        $validated = true;

        if (empty($data)) {
            $this->log->error("Validation error. User data is empty");
            $validated = false;
        }
            
        if (!array_key_exists('Name', $data) || empty($data['Name'])) {
            $this->log->error("Validation error. 'Name' parameter");
            $validated = false;
        }

        if (!array_key_exists('Lastname', $data) || empty($data['Lastname'])) {
            $this->log->error("Validation error. 'Lastname' parameter");
            $validated = false;
        }

        if (!array_key_exists('Email', $data) || empty($data['Email'])) {
            $this->log->error("Validation. 'Email' parameter");
            $validated = false;
        }

        if (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
            $this->log->error("Validation. Email is not valid");
            $validated = false;
        }

        if (!$this->isUniqEmail($data['Email'])) {
            $this->log->error("Validation. Email is not uniq");
            $validated = false;
        }

        if (empty($data['Password'] || empty($data['ConfirmPassword']))) {
            $this->log->error("Validation. Password or ConfirmPassword is empty");
            $validated = false;
        }

        if ($data['Password'] !== $data['ConfirmPassword']) {
            $this->log->error("Validation. Password != ConfirmPassword");
            $validated = false;
        }

        if (strlen($data['Password']) < 8) {
            $this->log->error("Validation. Password lenght < 8");
            $validated = false;
        }

        return $validated;
    }

    private function getMaxId($array): int|null
    {
        $currentMax = null;

        foreach ($array as $arr) {
            foreach ($arr as $key => $value) {
                if ($key == 'Id' && ($value >= $currentMax)) {
                    $currentMax = $value;
                }
            }
        }

        return (int) $currentMax;
    }

    private function isUniqEmail($email): bool
    {
        return !array_search($email, array_column($this->db, 'Email'));
    }
}
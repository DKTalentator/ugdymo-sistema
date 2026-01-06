<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class UserModel
{
    public function __construct(
        private PDO $db
    ) {}

    public function findByEmail(string $email): ?array
    {
        $sql = "SELECT id, email, password_hash, full_name, is_active
                FROM users
                WHERE email = :email
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch();

        return $user !== false ? $user : null;
    }
    
        public function findById(int $id): ?array
    {
        $sql = "SELECT id, email, password_hash, full_name, is_active, created_at
                FROM users
                WHERE id = :id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch();

        return $user !== false ? $user : null;
    }

}

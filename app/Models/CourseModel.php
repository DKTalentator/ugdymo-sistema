<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class CourseModel
{
    public function __construct(
        private PDO $db
    ) {}

    /**
     * Grąžina visus aktyvius kursus.
     */
    public function getActiveCourses(): array
    {
        $sql = "SELECT id, title, description, created_at
                FROM courses
                WHERE is_active = 1
                ORDER BY created_at DESC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll() ?: [];
    }
    
    /**
     * Grąžina kursą pagal ID arba null, jei nerastas.
     */
    public function getCourseById(int $id): ?array
    {
        $sql = "SELECT id, title, description, created_at
                FROM courses
                WHERE id = :id AND is_active = 1
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $course = $stmt->fetch(PDO::FETCH_ASSOC);

        return $course !== false ? $course : null;
    }

    
}

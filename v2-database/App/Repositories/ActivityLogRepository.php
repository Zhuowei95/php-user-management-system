<?php
namespace App\Repositories;

use App\Config\Database;
use PDO;

class ActivityLogRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function create(string $message, ?int $userId = null): bool
    {
        $sql = 'INSERT INTO activity_logs (user_id, message) VALUES (:user_id, :message)';
        $statement = $this->connection->prepare($sql);

        return $statement->execute([
            ':user_id' => $userId,
            ':message' => $message,
        ]);
    }

    public function latest(int $limit = 20): array
    {
        $statement = $this->connection->prepare(
            'SELECT activity_logs.id, activity_logs.message, activity_logs.created_at, users.name
             FROM activity_logs
             LEFT JOIN users ON users.id = activity_logs.user_id
             ORDER BY activity_logs.id DESC
             LIMIT :limit'
        );
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}

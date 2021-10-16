<?php


namespace App\Item\Infrastructure;

use App\Item\Domain\Exceptions\ItemRepositoryError;
use App\Item\Domain\IItemsRepository;
use App\Item\Domain\Item;
use PDO;
use PDOException;

class ItemsRepositoryMysql implements IItemsRepository
{
    private static $instance;
    private PDO $connect;

    public function __construct()
    {
        try {
            $this->connect = new PDO(
                "mysql:host={$_ENV['HOST_MYSQL']};port={$_ENV['HOST_PORT']};dbname={$_ENV['MYSQL_DATABASE']};charset=UTF8",
                $_ENV['MYSQL_USER'],
                $_ENV['MYSQL_PASSWORD']
            );

        } catch (PDOException $exception) {
            $className = get_class($this);
            throw new ItemRepositoryError('Error in ' . $className . ' ' . $exception->getMessage(), 500);
        }
    }

    public static function getInstance(): ItemsRepositoryMysql
    {
        if (self::$instance === null) {
            self::$instance = new ItemsRepositoryMysql();
        }
        return self::$instance;
    }

    public function removeItem(string $itemId): void
    {
        $query = 'DELETE FROM `item` WHERE id=?';

        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $itemId);

        if (!$stmt->execute()) {
            throw new ItemRepositoryError('Item could not be deleted', 500);
        }
    }

    public function createTable(): void
    {
        $command = 'CREATE TABLE if not exists `item` (
  `id` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
';
        $stmt = $this->connect->prepare($command);

        if (!$stmt->execute()) {
            throw new \Exception('Could not create table item', 500);
        }
    }

    public function createItem(Item $item): void
    {
        $id = $item->getId();
        $link = $item->getLink();
        $title = $item->getTitle();

        $fields = 'INSERT INTO `item` (id,link,title)';
        $values = 'VALUES (?,?,?)';
        $query = $fields . $values;
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $link);
        $stmt->bindParam(3, $title);

        if (!$stmt->execute()) {
            throw new ItemRepositoryError('Item could not be inserted', 500);
        }
    }

    public function findItems(int $count, int $offset): array
    {
        $items = [];
        $query = 'select * from item limit :limit offset :offset';

        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':limit', $count, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            throw new ItemRepositoryError('Statment execute fail', 500);
        }
        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($response)) {
            throw new ItemRepositoryError('Items not found', 404);
        }
        $counter = count($response);
        for ($i = 0; $i < $counter; $i++) {
            $item = new Item
            (
                $response[$i]['id'],
                $response[$i]['link'],
                $response[$i]['title']
            );
            $items[] = $item;
        }

        return $items;
    }
}
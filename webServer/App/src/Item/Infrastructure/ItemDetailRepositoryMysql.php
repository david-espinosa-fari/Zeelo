<?php


namespace App\Item\Infrastructure;

use App\Item\Domain\Exceptions\ItemRepositoryError;
use App\Item\Domain\IItemsDetailsRepository;
use App\Item\Domain\IItemsRepository;
use App\Item\Domain\Item;
use App\Item\Domain\ItemDetails;
use PDO;
use PDOException;

class ItemDetailRepositoryMysql implements IItemsDetailsRepository
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

    public static function getInstance(): ItemDetailRepositoryMysql
    {
        if (self::$instance === null) {
            self::$instance = new ItemDetailRepositoryMysql();
        }
        return self::$instance;
    }
    public function createTable(): void
    {
        $itemsDetailsTable = 'CREATE TABLE if not exists `itemDetails` (
  `id` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
';
        $stmt = $this->connect->prepare($itemsDetailsTable);

        if (!$stmt->execute()) {
            throw new \Exception('Could not create table itemDetails', 500);
        }
    }

    public function retrieveItemDetails(string $itemId): ItemDetails
    {
        $query = 'select * from itemDetails where id=:id';

        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id', $itemId);
        $response = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($response)) {
            throw new ItemRepositoryError('ItemsDetails not found', 404);
        }
        return new ItemDetails(
            $response['id'],
            $response['image'],
            $response['author'],
            $response['price'],
        );
    }

}
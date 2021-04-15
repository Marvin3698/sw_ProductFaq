<?php declare(strict_types=1);

namespace ProductFaq\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1618320690productfaq extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1618320688;
    }

    public function update(Connection $connection): void
    {
        // implement update
        $sql = <<<SQL
CREATE TABLE IF NOT EXISTS `product_faq` (
    `id` BINARY(16) NOT NULL,
    `product_id` VARCHAR(255) COLLATE utf8mb4_unicode_ci,
    `question` VARCHAR(255) COLLATE utf8mb4_unicode_ci,
    `answer` VARCHAR(255) COLLATE utf8mb4_unicode_ci,

    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3),
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;
SQL;
        $connection->executeStatement($sql);
    }
    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}

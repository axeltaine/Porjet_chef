<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191001084923 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE data CHANGE visitor visitor INT DEFAULT NULL, CHANGE page page INT DEFAULT NULL, CHANGE keyword1 keyword1 VARCHAR(255) DEFAULT NULL, CHANGE keyword2 keyword2 VARCHAR(255) DEFAULT NULL, CHANGE keyword3 keyword3 VARCHAR(255) DEFAULT NULL, CHANGE keyword4 keyword4 VARCHAR(255) DEFAULT NULL, CHANGE advice advice LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE data CHANGE visitor visitor INT NOT NULL, CHANGE page page INT NOT NULL, CHANGE keyword1 keyword1 VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE keyword2 keyword2 VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE keyword3 keyword3 VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE keyword4 keyword4 VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE advice advice LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190902112914 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat ADD projet_id INT NOT NULL');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_659DF2AAC18272 ON chat (projet_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AAC18272');
        $this->addSql('DROP INDEX IDX_659DF2AAC18272 ON chat');
        $this->addSql('ALTER TABLE chat DROP projet_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190930112937 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE data ADD dataprojet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE data ADD CONSTRAINT FK_ADF3F363E4DF0ECE FOREIGN KEY (dataprojet_id) REFERENCES projet (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ADF3F363E4DF0ECE ON data (dataprojet_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE data DROP FOREIGN KEY FK_ADF3F363E4DF0ECE');
        $this->addSql('DROP INDEX UNIQ_ADF3F363E4DF0ECE ON data');
        $this->addSql('ALTER TABLE data DROP dataprojet_id');
    }
}

<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170520114919 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE coach ADD image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A64793C105691');
        $this->addSql('DROP INDEX UNIQ_957A64793C105691 ON fos_user');
        $this->addSql('ALTER TABLE fos_user DROP coach_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE coach DROP image');
        $this->addSql('ALTER TABLE fos_user ADD coach_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A64793C105691 FOREIGN KEY (coach_id) REFERENCES coach (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A64793C105691 ON fos_user (coach_id)');
    }
}

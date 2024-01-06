<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240106200512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT fk_d34a04addb805178');
        $this->addSql('DROP INDEX idx_d34a04addb805178');
        $this->addSql('ALTER TABLE product DROP quote_id');
        $this->addSql('ALTER TABLE product DROP quantity');
        $this->addSql('ALTER TABLE product ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE quote ALTER search_vector TYPE TSVECTOR');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE quote ALTER search_vector TYPE TEXT');
        $this->addSql('ALTER TABLE product ADD quote_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ALTER search_vector TYPE TEXT');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT fk_d34a04addb805178 FOREIGN KEY (quote_id) REFERENCES quote (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_d34a04addb805178 ON product (quote_id)');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TEXT');
    }
}

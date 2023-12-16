<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231216110527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE quantity_id_seq CASCADE');
        $this->addSql('ALTER TABLE quantity DROP CONSTRAINT fk_9ff31636db805178');
        $this->addSql('DROP TABLE quantity');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE quote ADD entreprise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF4A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6B71CBF4A4AEAFEA ON quote (entreprise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE quantity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE quantity (id INT NOT NULL, quote_id INT NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_9ff31636db805178 ON quantity (quote_id)');
        $this->addSql('ALTER TABLE quantity ADD CONSTRAINT fk_9ff31636db805178 FOREIGN KEY (quote_id) REFERENCES quote (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TEXT');
        $this->addSql('ALTER TABLE quote DROP CONSTRAINT FK_6B71CBF4A4AEAFEA');
        $this->addSql('DROP INDEX IDX_6B71CBF4A4AEAFEA');
        $this->addSql('ALTER TABLE quote DROP entreprise_id');
    }
}

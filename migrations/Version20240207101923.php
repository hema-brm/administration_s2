<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240207101923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill ADD customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE bill ADD entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE bill DROP name_client');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E39395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E3A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7A2119E39395C3F3 ON bill (customer_id)');
        $this->addSql('CREATE INDEX IDX_7A2119E3A4AEAFEA ON bill (entreprise_id)');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE product ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE quote ALTER search_vector TYPE TSVECTOR');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product ALTER search_vector TYPE TEXT');
        $this->addSql('ALTER TABLE bill DROP CONSTRAINT FK_7A2119E39395C3F3');
        $this->addSql('ALTER TABLE bill DROP CONSTRAINT FK_7A2119E3A4AEAFEA');
        $this->addSql('DROP INDEX IDX_7A2119E39395C3F3');
        $this->addSql('DROP INDEX IDX_7A2119E3A4AEAFEA');
        $this->addSql('ALTER TABLE bill ADD name_client VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE bill DROP customer_id');
        $this->addSql('ALTER TABLE bill DROP entreprise_id');
        $this->addSql('ALTER TABLE quote ALTER search_vector TYPE TEXT');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TEXT');
    }
}

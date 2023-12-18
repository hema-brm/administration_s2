<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218222716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer ADD company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09979B1AD6 FOREIGN KEY (company_id) REFERENCES entreprise (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_81398E09979B1AD6 ON customer (company_id)');
        $this->addSql('ALTER TABLE entreprise RENAME COLUMN nom TO name');
        $this->addSql('ALTER TABLE entreprise RENAME COLUMN numero_siret TO siret_number');
        $this->addSql('ALTER TABLE entreprise RENAME COLUMN adresse TO adress');
        $this->addSql('ALTER TABLE product ALTER search_vector TYPE TSVECTOR');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE customer DROP CONSTRAINT FK_81398E09979B1AD6');
        $this->addSql('DROP INDEX IDX_81398E09979B1AD6');
        $this->addSql('ALTER TABLE customer DROP company_id');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TEXT');
        $this->addSql('ALTER TABLE product ALTER search_vector TYPE TEXT');
        $this->addSql('ALTER TABLE entreprise RENAME COLUMN name TO nom');
        $this->addSql('ALTER TABLE entreprise RENAME COLUMN siret_number TO numero_siret');
        $this->addSql('ALTER TABLE entreprise RENAME COLUMN adress TO adresse');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240207110515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill ADD creation_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE product ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE quote ALTER search_vector TYPE TSVECTOR');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product ALTER search_vector TYPE TEXT');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TEXT');
        $this->addSql('ALTER TABLE bill DROP creation_date');
        $this->addSql('ALTER TABLE quote ALTER search_vector TYPE TEXT');
    }
}

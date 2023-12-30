<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231230145242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE product ADD search_vector TSVECTOR DEFAULT \'\'');
        $this->addSql('ALTER TABLE quote ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE product ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE product DROP quantity');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TEXT');
        $this->addSql('ALTER TABLE product DROP search_vector');
        $this->addSql('ALTER TABLE quote ALTER search_vector TYPE TEXT');
        $this->addSql('DROP TRIGGER product_search_vector_update ON product;');
        $this->addSql('ALTER TABLE product ADD quantity INT DEFAULT NULL');
    }
}

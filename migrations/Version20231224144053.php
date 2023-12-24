<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231224144053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE product_quote_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE product_quote (id INT NOT NULL, quote_id INT NOT NULL, product_id INT NOT NULL, quantity VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CA2DB0A8DB805178 ON product_quote (quote_id)');
        $this->addSql('CREATE INDEX IDX_CA2DB0A84584665A ON product_quote (product_id)');
        $this->addSql('ALTER TABLE product_quote ADD CONSTRAINT FK_CA2DB0A8DB805178 FOREIGN KEY (quote_id) REFERENCES quote (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_quote ADD CONSTRAINT FK_CA2DB0A84584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE product ADD quote_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product DROP search_vector');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADDB805178 FOREIGN KEY (quote_id) REFERENCES quote (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D34A04ADDB805178 ON product (quote_id)');
        $this->addSql('ALTER TABLE quote ADD company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quote ADD search_vector TSVECTOR DEFAULT \'\'');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF4979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6B71CBF4979B1AD6 ON quote (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE product_quote_id_seq CASCADE');
        $this->addSql('ALTER TABLE product_quote DROP CONSTRAINT FK_CA2DB0A8DB805178');
        $this->addSql('ALTER TABLE product_quote DROP CONSTRAINT FK_CA2DB0A84584665A');
        $this->addSql('DROP TABLE product_quote');
        $this->addSql('ALTER TABLE quote DROP CONSTRAINT FK_6B71CBF4979B1AD6');
        $this->addSql('DROP INDEX IDX_6B71CBF4979B1AD6');
        $this->addSql('ALTER TABLE quote DROP company_id');
        $this->addSql('ALTER TABLE quote DROP search_vector');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADDB805178');
        $this->addSql('DROP INDEX IDX_D34A04ADDB805178');
        $this->addSql('ALTER TABLE product ADD search_vector TEXT DEFAULT \'\'');
        $this->addSql('ALTER TABLE product DROP quote_id');
        $this->addSql('ALTER TABLE product DROP quantity');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TEXT');
    }
}

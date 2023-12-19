<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231219100741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE sub_category_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE product_quote_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE quote_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE product_quote (id INT NOT NULL, quote_id INT NOT NULL, product_id INT NOT NULL, quantity VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CA2DB0A8DB805178 ON product_quote (quote_id)');
        $this->addSql('CREATE INDEX IDX_CA2DB0A84584665A ON product_quote (product_id)');
        $this->addSql('CREATE TABLE quote (id INT NOT NULL, customer_id INT NOT NULL, entreprise_id INT DEFAULT NULL, search_vector TSVECTOR DEFAULT \'\', status VARCHAR(255) NOT NULL, quote_number VARCHAR(255) NOT NULL, quote_issuance_date DATE NOT NULL, expiry_date DATE DEFAULT NULL, total_price DOUBLE PRECISION NOT NULL, discount DOUBLE PRECISION DEFAULT NULL, tva DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6B71CBF49395C3F3 ON quote (customer_id)');
        $this->addSql('CREATE INDEX IDX_6B71CBF4A4AEAFEA ON quote (entreprise_id)');
        $this->addSql('ALTER TABLE product_quote ADD CONSTRAINT FK_CA2DB0A8DB805178 FOREIGN KEY (quote_id) REFERENCES quote (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_quote ADD CONSTRAINT FK_CA2DB0A84584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF49395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF4A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sub_category_product DROP CONSTRAINT fk_bf59c2faf7bfe87c');
        $this->addSql('ALTER TABLE sub_category_product DROP CONSTRAINT fk_bf59c2fa4584665a');
        $this->addSql('ALTER TABLE sub_category DROP CONSTRAINT fk_bce3f79812469de2');
        $this->addSql('DROP TABLE sub_category_product');
        $this->addSql('DROP TABLE sub_category');
        $this->addSql('ALTER TABLE customer ADD company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD search_vector TSVECTOR DEFAULT \'\'');
        $this->addSql('ALTER TABLE customer ALTER phone TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09979B1AD6 FOREIGN KEY (company_id) REFERENCES entreprise (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09E7927C74 ON customer (email)');
        $this->addSql('CREATE INDEX IDX_81398E09979B1AD6 ON customer (company_id)');
        $this->addSql('ALTER TABLE entreprise ADD siret_number VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise DROP numero_siret');
        $this->addSql('ALTER TABLE entreprise RENAME COLUMN nom TO name');
        $this->addSql('ALTER TABLE entreprise RENAME COLUMN adresse TO adress');
        $this->addSql('ALTER TABLE product ADD quote_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADDB805178 FOREIGN KEY (quote_id) REFERENCES quote (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D34A04ADDB805178 ON product (quote_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADDB805178');
        $this->addSql('DROP SEQUENCE product_quote_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE quote_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE sub_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE sub_category_product (sub_category_id INT NOT NULL, product_id INT NOT NULL, PRIMARY KEY(sub_category_id, product_id))');
        $this->addSql('CREATE INDEX idx_bf59c2fa4584665a ON sub_category_product (product_id)');
        $this->addSql('CREATE INDEX idx_bf59c2faf7bfe87c ON sub_category_product (sub_category_id)');
        $this->addSql('CREATE TABLE sub_category (id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_bce3f79812469de2 ON sub_category (category_id)');
        $this->addSql('ALTER TABLE sub_category_product ADD CONSTRAINT fk_bf59c2faf7bfe87c FOREIGN KEY (sub_category_id) REFERENCES sub_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sub_category_product ADD CONSTRAINT fk_bf59c2fa4584665a FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT fk_bce3f79812469de2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_quote DROP CONSTRAINT FK_CA2DB0A8DB805178');
        $this->addSql('ALTER TABLE product_quote DROP CONSTRAINT FK_CA2DB0A84584665A');
        $this->addSql('ALTER TABLE quote DROP CONSTRAINT FK_6B71CBF49395C3F3');
        $this->addSql('ALTER TABLE quote DROP CONSTRAINT FK_6B71CBF4A4AEAFEA');
        $this->addSql('DROP TABLE product_quote');
        $this->addSql('DROP TABLE quote');
        $this->addSql('ALTER TABLE entreprise ADD numero_siret VARCHAR(14) DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise DROP siret_number');
        $this->addSql('ALTER TABLE entreprise RENAME COLUMN name TO nom');
        $this->addSql('ALTER TABLE entreprise RENAME COLUMN adress TO adresse');
        $this->addSql('DROP INDEX IDX_D34A04ADDB805178');
        $this->addSql('ALTER TABLE product DROP quote_id');
        $this->addSql('ALTER TABLE product DROP quantity');
        $this->addSql('ALTER TABLE customer DROP CONSTRAINT FK_81398E09979B1AD6');
        $this->addSql('DROP INDEX UNIQ_81398E09E7927C74');
        $this->addSql('DROP INDEX IDX_81398E09979B1AD6');
        $this->addSql('ALTER TABLE customer DROP company_id');
        $this->addSql('ALTER TABLE customer DROP search_vector');
        $this->addSql('ALTER TABLE customer ALTER phone TYPE VARCHAR(15)');
    }
}

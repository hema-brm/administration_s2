<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231223161201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT fk_8d93d649a4aeafea');
        $this->addSql('DROP SEQUENCE entreprise_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_quote_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sub_category_id_seq CASCADE');
        $this->addSql('ALTER TABLE sub_category DROP CONSTRAINT fk_bce3f79812469de2');
        $this->addSql('ALTER TABLE sub_category_product DROP CONSTRAINT fk_bf59c2faf7bfe87c');
        $this->addSql('ALTER TABLE sub_category_product DROP CONSTRAINT fk_bf59c2fa4584665a');
        $this->addSql('ALTER TABLE product_quote DROP CONSTRAINT fk_ca2db0a8db805178');
        $this->addSql('ALTER TABLE product_quote DROP CONSTRAINT fk_ca2db0a84584665a');
        $this->addSql('DROP TABLE sub_category');
        $this->addSql('DROP TABLE sub_category_product');
        $this->addSql('DROP TABLE product_quote');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE product ALTER search_vector TYPE TSVECTOR');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE entreprise_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_quote_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sub_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE sub_category (id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_bce3f79812469de2 ON sub_category (category_id)');
        $this->addSql('CREATE TABLE sub_category_product (sub_category_id INT NOT NULL, product_id INT NOT NULL, PRIMARY KEY(sub_category_id, product_id))');
        $this->addSql('CREATE INDEX idx_bf59c2fa4584665a ON sub_category_product (product_id)');
        $this->addSql('CREATE INDEX idx_bf59c2faf7bfe87c ON sub_category_product (sub_category_id)');
        $this->addSql('CREATE TABLE product_quote (id INT NOT NULL, quote_id INT NOT NULL, product_id INT NOT NULL, quantity VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_ca2db0a84584665a ON product_quote (product_id)');
        $this->addSql('CREATE INDEX idx_ca2db0a8db805178 ON product_quote (quote_id)');
        $this->addSql('CREATE TABLE entreprise (id INT NOT NULL, nom VARCHAR(255) DEFAULT NULL, numero_siret VARCHAR(20) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT fk_bce3f79812469de2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sub_category_product ADD CONSTRAINT fk_bf59c2faf7bfe87c FOREIGN KEY (sub_category_id) REFERENCES sub_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sub_category_product ADD CONSTRAINT fk_bf59c2fa4584665a FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_quote ADD CONSTRAINT fk_ca2db0a8db805178 FOREIGN KEY (quote_id) REFERENCES quote (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_quote ADD CONSTRAINT fk_ca2db0a84584665a FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ALTER search_vector TYPE TEXT');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT fk_8d93d649a4aeafea FOREIGN KEY (company_id) REFERENCES entreprise (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TEXT');
    }
}

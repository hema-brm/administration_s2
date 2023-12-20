<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231217142340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE sub_category_id_seq CASCADE');
        $this->addSql('ALTER TABLE sub_category_product DROP CONSTRAINT fk_bf59c2faf7bfe87c');
        $this->addSql('ALTER TABLE sub_category_product DROP CONSTRAINT fk_bf59c2fa4584665a');
        $this->addSql('ALTER TABLE sub_category DROP CONSTRAINT fk_bce3f79812469de2');
        $this->addSql('DROP TABLE sub_category_product');
        $this->addSql('DROP TABLE sub_category');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE company ALTER numero_siret TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE product ADD search_vector TSVECTOR DEFAULT \'\'');
        $this->addSql('ALTER TABLE product ALTER search_vector TYPE TSVECTOR');
        
        $sql1 = <<<SQL
            CREATE OR REPLACE FUNCTION update_search_vector() RETURNS TRIGGER AS $$
            DECLARE
                category_name TEXT;
            BEGIN
                SELECT c.name INTO category_name FROM category c WHERE c.id = NEW.category_id;

                NEW.search_vector = to_tsvector('pg_catalog.english', 
                                    NEW.reference || ' ' || NEW.name || ' ' || 
                                    COALESCE(category_name, '') || ' ' || 
                                    NEW.description || ' ' || NEW.price);

                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        SQL;

        $sql2 = <<<SQL
            CREATE TRIGGER product_search_vector_update BEFORE INSERT OR UPDATE
            ON product FOR EACH ROW EXECUTE FUNCTION update_search_vector();
        SQL;

        $sql3 = <<<SQL
            CREATE OR REPLACE FUNCTION get_category_name(category_id INT) RETURNS TEXT AS $$
            DECLARE
                category_name TEXT;
            BEGIN
                SELECT c.name INTO category_name FROM category c WHERE c.id = category_id;
                RETURN category_name;
            END;
            $$ LANGUAGE plpgsql;
        SQL;

        $this->addSql($sql1);
        $this->addSql($sql2);
        $this->addSql($sql3);

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE sub_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE sub_category_product (sub_category_id INT NOT NULL, product_id INT NOT NULL, PRIMARY KEY(sub_category_id, product_id))');
        $this->addSql('CREATE INDEX idx_bf59c2fa4584665a ON sub_category_product (product_id)');
        $this->addSql('CREATE INDEX idx_bf59c2faf7bfe87c ON sub_category_product (sub_category_id)');
        $this->addSql('CREATE TABLE sub_category (id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_bce3f79812469de2 ON sub_category (category_id)');
        $this->addSql('ALTER TABLE sub_category_product ADD CONSTRAINT fk_bf59c2faf7bfe87c FOREIGN KEY (sub_category_id) REFERENCES sub_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sub_category_product ADD CONSTRAINT fk_bf59c2fa4584665a FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT fk_bce3f79812469de2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TEXT');
        $this->addSql('ALTER TABLE company ALTER numero_siret TYPE VARCHAR(14)');
        $this->addSql('ALTER TABLE product DROP search_vector');
        $this->addSql('DROP TRIGGER product_search_vector_update ON product;');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231124090821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sub_category_product (sub_category_id INT NOT NULL, product_id INT NOT NULL, PRIMARY KEY(sub_category_id, product_id))');
        $this->addSql('CREATE INDEX IDX_BF59C2FAF7BFE87C ON sub_category_product (sub_category_id)');
        $this->addSql('CREATE INDEX IDX_BF59C2FA4584665A ON sub_category_product (product_id)');
        $this->addSql('ALTER TABLE sub_category_product ADD CONSTRAINT FK_BF59C2FAF7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sub_category_product ADD CONSTRAINT FK_BF59C2FA4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sub_category DROP CONSTRAINT fk_bce3f7989777d11e');
        $this->addSql('DROP INDEX idx_bce3f7989777d11e');
        $this->addSql('ALTER TABLE sub_category RENAME COLUMN category_id_id TO category_id');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F79812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BCE3F79812469DE2 ON sub_category (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sub_category_product DROP CONSTRAINT FK_BF59C2FAF7BFE87C');
        $this->addSql('ALTER TABLE sub_category_product DROP CONSTRAINT FK_BF59C2FA4584665A');
        $this->addSql('DROP TABLE sub_category_product');
        $this->addSql('ALTER TABLE sub_category DROP CONSTRAINT FK_BCE3F79812469DE2');
        $this->addSql('DROP INDEX IDX_BCE3F79812469DE2');
        $this->addSql('ALTER TABLE sub_category RENAME COLUMN category_id TO category_id_id');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT fk_bce3f7989777d11e FOREIGN KEY (category_id_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_bce3f7989777d11e ON sub_category (category_id_id)');
    }
}

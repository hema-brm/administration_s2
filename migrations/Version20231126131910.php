<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231126131910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE payement_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE payment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE payment (id INT NOT NULL, bill_id INT NOT NULL, status VARCHAR(255) NOT NULL, moyen VARCHAR(255) NOT NULL, date_paiement TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_echeance TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6D28840D1A8C12F5 ON payment (bill_id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D1A8C12F5 FOREIGN KEY (bill_id) REFERENCES bill (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payement DROP CONSTRAINT fk_b20a78851a8c12f5');
        $this->addSql('DROP TABLE payement');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE payment_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE payement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE payement (id INT NOT NULL, bill_id INT NOT NULL, status VARCHAR(255) NOT NULL, moyen VARCHAR(255) NOT NULL, date_paiement TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_echeance TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_b20a78851a8c12f5 ON payement (bill_id)');
        $this->addSql('ALTER TABLE payement ADD CONSTRAINT fk_b20a78851a8c12f5 FOREIGN KEY (bill_id) REFERENCES bill (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment DROP CONSTRAINT FK_6D28840D1A8C12F5');
        $this->addSql('DROP TABLE payment');
    }
}

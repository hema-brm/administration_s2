<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123150944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE bill_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE payement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bill (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE payement (id INT NOT NULL, bill_id INT NOT NULL, status VARCHAR(255) NOT NULL, moyen VARCHAR(255) NOT NULL, date_paiement TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_echeance TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B20A78851A8C12F5 ON payement (bill_id)');
        $this->addSql('ALTER TABLE payement ADD CONSTRAINT FK_B20A78851A8C12F5 FOREIGN KEY (bill_id) REFERENCES bill (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE bill_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE payement_id_seq CASCADE');
        $this->addSql('ALTER TABLE payement DROP CONSTRAINT FK_B20A78851A8C12F5');
        $this->addSql('DROP TABLE bill');
        $this->addSql('DROP TABLE payement');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123075826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE entreprise_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE entreprise (id INT NOT NULL, nom VARCHAR(255) NOT NULL, numero_siret INT NOT NULL, adresse VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE "user" ADD entreprise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ALTER first_name SET DEFAULT \'Unknown\'');
        $this->addSql('ALTER TABLE "user" ALTER last_name SET DEFAULT \'Unknown\'');
        $this->addSql('ALTER TABLE "user" ALTER phone_number SET DEFAULT \'Unknown\'');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8D93D649A4AEAFEA ON "user" (entreprise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649A4AEAFEA');
        $this->addSql('DROP SEQUENCE entreprise_id_seq CASCADE');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP INDEX IDX_8D93D649A4AEAFEA');
        $this->addSql('ALTER TABLE "user" DROP entreprise_id');
        $this->addSql('ALTER TABLE "user" ALTER first_name DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" ALTER last_name DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" ALTER phone_number DROP DEFAULT');
    }
}

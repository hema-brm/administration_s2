<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221191316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE reset_password_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE reset_password_request (id INT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('COMMENT ON COLUMN reset_password_request.requested_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reset_password_request.expires_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE category ALTER name TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE company RENAME COLUMN adress TO address');
        $this->addSql('ALTER TABLE customer ALTER company_id SET NOT NULL');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE product ADD quote_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ALTER name TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE product ALTER reference TYPE VARCHAR(70)');
        $this->addSql('ALTER TABLE product ALTER description TYPE TEXT');
        $this->addSql('ALTER TABLE product ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADDB805178 FOREIGN KEY (quote_id) REFERENCES quote (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D34A04ADDB805178 ON product (quote_id)');
        $this->addSql('ALTER TABLE quote ALTER search_vector TYPE TSVECTOR');
        $this->addSql('ALTER TABLE "user" ADD picture VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ALTER company_id SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER first_name DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" ALTER first_name SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER first_name TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE "user" ALTER last_name DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" ALTER last_name SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER last_name TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE "user" ALTER phone_number DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" ALTER phone_number TYPE VARCHAR(20)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE reset_password_request_id_seq CASCADE');
        $this->addSql('ALTER TABLE reset_password_request DROP CONSTRAINT FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('ALTER TABLE company RENAME COLUMN address TO adress');
        $this->addSql('ALTER TABLE customer ALTER company_id DROP NOT NULL');
        $this->addSql('ALTER TABLE customer ALTER search_vector TYPE TEXT');
        $this->addSql('ALTER TABLE category ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADDB805178');
        $this->addSql('DROP INDEX IDX_D34A04ADDB805178');
        $this->addSql('ALTER TABLE product DROP quote_id');
        $this->addSql('ALTER TABLE product ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE product ALTER reference TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE product ALTER description TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE product ALTER search_vector TYPE TEXT');
        $this->addSql('ALTER TABLE quote ALTER search_vector TYPE TEXT');
        $this->addSql('ALTER TABLE "user" DROP picture');
        $this->addSql('ALTER TABLE "user" DROP created_at');
        $this->addSql('ALTER TABLE "user" DROP updated_at');
        $this->addSql('ALTER TABLE "user" ALTER company_id DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER first_name SET DEFAULT \'Unknown\'');
        $this->addSql('ALTER TABLE "user" ALTER first_name DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER first_name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER last_name SET DEFAULT \'Unknown\'');
        $this->addSql('ALTER TABLE "user" ALTER last_name DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER last_name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER phone_number SET DEFAULT \'Unknown\'');
        $this->addSql('ALTER TABLE "user" ALTER phone_number TYPE VARCHAR(255)');
    }
}

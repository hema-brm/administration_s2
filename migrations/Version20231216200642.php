<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231216200642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise ALTER numero_siret TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE product ADD search_vector TSVECTOR DEFAULT \'\'');
        $sql = <<<SQL
            CREATE TRIGGER product_search_vector_update BEFORE INSERT OR UPDATE
                ON product FOR EACH ROW EXECUTE PROCEDURE
                tsvector_update_trigger(
                    search_vector, 
                    'pg_catalog.english', 
                    reference, 
                    name,
                    category_id,
                    description,
                    price
                );
            SQL;

        $this->addSql($sql);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE entreprise ALTER numero_siret TYPE VARCHAR(14)');
        $this->addSql('ALTER TABLE product DROP search_vector');
        $this->addSql('DROP TRIGGER product_search_vector_update ON product;');
    }
}

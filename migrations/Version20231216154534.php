<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231216154534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $sql = <<<SQL
            CREATE TRIGGER quote_search_vector_update BEFORE INSERT OR UPDATE
                ON quote FOR EACH ROW EXECUTE PROCEDURE
                tsvector_update_trigger(
                    search_vector, 
                    'pg_catalog.english', 
                    quote_number
                );
            SQL;

        $this->addSql($sql);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TRIGGER quote_search_vector_update ON quote;');
    }
}

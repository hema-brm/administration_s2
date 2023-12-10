<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206224432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $sql = <<<SQL
            CREATE TRIGGER customer_search_vector_update BEFORE INSERT OR UPDATE
                ON customer FOR EACH ROW EXECUTE PROCEDURE
                tsvector_update_trigger(
                    search_vector, 
                    'pg_catalog.english', 
                    email, 
                    lastname,
                    firstname,
                    address,
                    phone
                );
            SQL;

        $this->addSql($sql);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TRIGGER customer_search_vector_update ON customer;');
    }
}

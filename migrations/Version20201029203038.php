<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201029203038 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE school_entry_date ADD academic_year_id INT NOT NULL');
        $this->addSql('ALTER TABLE school_entry_date ADD CONSTRAINT FK_BB1DCF9BC54F3401 FOREIGN KEY (academic_year_id) REFERENCES academic_year (id)');
        $this->addSql('CREATE INDEX IDX_BB1DCF9BC54F3401 ON school_entry_date (academic_year_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE school_entry_date DROP FOREIGN KEY FK_BB1DCF9BC54F3401');
        $this->addSql('DROP INDEX IDX_BB1DCF9BC54F3401 ON school_entry_date');
        $this->addSql('ALTER TABLE school_entry_date DROP academic_year_id');
    }
}

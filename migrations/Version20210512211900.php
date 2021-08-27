<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210512211900 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adept_cycle DROP FOREIGN KEY FK_B2E61F13492C8BE');
        $this->addSql('DROP INDEX IDX_B2E61F13492C8BE ON adept_cycle');
        $this->addSql('ALTER TABLE adept_cycle DROP nearest_location_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adept_cycle ADD nearest_location_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adept_cycle ADD CONSTRAINT FK_B2E61F13492C8BE FOREIGN KEY (nearest_location_id) REFERENCES adept_place_location (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B2E61F13492C8BE ON adept_cycle (nearest_location_id)');
    }
}

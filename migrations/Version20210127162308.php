<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210127162308 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE base_page ADD menu_item_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE base_page ADD CONSTRAINT FK_826978D09AB44FE0 FOREIGN KEY (menu_item_id) REFERENCES nav_menu (id)');
        $this->addSql('CREATE INDEX IDX_826978D09AB44FE0 ON base_page (menu_item_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE base_page DROP FOREIGN KEY FK_826978D09AB44FE0');
        $this->addSql('DROP INDEX IDX_826978D09AB44FE0 ON base_page');
        $this->addSql('ALTER TABLE base_page DROP menu_item_id');
    }
}

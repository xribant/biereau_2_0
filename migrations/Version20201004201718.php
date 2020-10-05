<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201004201718 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pre_registration (id INT AUTO_INCREMENT NOT NULL, parent_first_name VARCHAR(100) NOT NULL, parent_last_name VARCHAR(100) NOT NULL, phone VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, child_first_name VARCHAR(100) NOT NULL, child_last_name VARCHAR(100) NOT NULL, child_birth_date DATE NOT NULL, child_entry_date DATE NOT NULL, child_section VARCHAR(255) NOT NULL, registration_session DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE contact_registration');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contact_registration (id INT AUTO_INCREMENT NOT NULL, parent_first_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, parent_last_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, parent_phone VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, parent_email VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, child_first_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, child_last_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, child_birth_date DATE NOT NULL, child_entry_date DATE NOT NULL, child_section VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, info_session DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE pre_registration');
    }
}

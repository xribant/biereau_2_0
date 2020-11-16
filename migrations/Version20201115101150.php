<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201115101150 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, site_page_id INT NOT NULL, title VARCHAR(255) NOT NULL, sub_title VARCHAR(255) DEFAULT NULL, text LONGTEXT NOT NULL, image_file VARCHAR(255) DEFAULT NULL, INDEX IDX_23A0E66F7E2812F (site_page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nav_menu (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, route VARCHAR(255) DEFAULT NULL, external_link TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site_page (id INT AUTO_INCREMENT NOT NULL, parent_nav_menu_id INT DEFAULT NULL, parent_sub_menu_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, banner_image_file VARCHAR(255) NOT NULL, INDEX IDX_2F900BD962281CB5 (parent_nav_menu_id), INDEX IDX_2F900BD9D823A796 (parent_sub_menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_menu (id INT AUTO_INCREMENT NOT NULL, parent_menu_id INT NOT NULL, name VARCHAR(255) NOT NULL, route VARCHAR(255) DEFAULT NULL, external_link TINYINT(1) NOT NULL, INDEX IDX_5A93A552BE9F9D54 (parent_menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66F7E2812F FOREIGN KEY (site_page_id) REFERENCES site_page (id)');
        $this->addSql('ALTER TABLE site_page ADD CONSTRAINT FK_2F900BD962281CB5 FOREIGN KEY (parent_nav_menu_id) REFERENCES nav_menu (id)');
        $this->addSql('ALTER TABLE site_page ADD CONSTRAINT FK_2F900BD9D823A796 FOREIGN KEY (parent_sub_menu_id) REFERENCES sub_menu (id)');
        $this->addSql('ALTER TABLE sub_menu ADD CONSTRAINT FK_5A93A552BE9F9D54 FOREIGN KEY (parent_menu_id) REFERENCES nav_menu (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE site_page DROP FOREIGN KEY FK_2F900BD962281CB5');
        $this->addSql('ALTER TABLE sub_menu DROP FOREIGN KEY FK_5A93A552BE9F9D54');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66F7E2812F');
        $this->addSql('ALTER TABLE site_page DROP FOREIGN KEY FK_2F900BD9D823A796');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE nav_menu');
        $this->addSql('DROP TABLE site_page');
        $this->addSql('DROP TABLE sub_menu');
    }
}

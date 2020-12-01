<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201129132938 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE prof (id INT AUTO_INCREMENT NOT NULL, member_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_5BBA70BB7597D3FE (member_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prof_school_section (prof_id INT NOT NULL, school_section_id INT NOT NULL, INDEX IDX_53B0135ABC1F7FE (prof_id), INDEX IDX_53B01356D826388 (school_section_id), PRIMARY KEY(prof_id, school_section_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prof ADD CONSTRAINT FK_5BBA70BB7597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE prof_school_section ADD CONSTRAINT FK_53B0135ABC1F7FE FOREIGN KEY (prof_id) REFERENCES prof (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prof_school_section ADD CONSTRAINT FK_53B01356D826388 FOREIGN KEY (school_section_id) REFERENCES school_section (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE prof_school_section DROP FOREIGN KEY FK_53B0135ABC1F7FE');
        $this->addSql('DROP TABLE prof');
        $this->addSql('DROP TABLE prof_school_section');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002120206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE [user] ADD first_name NVARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE [user] ADD last_name NVARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE [user] ADD adress NVARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE [user] ADD post_code NVARCHAR(255)');
        $this->addSql('ALTER TABLE [user] ADD city NVARCHAR(255)');
        $this->addSql('ALTER TABLE [user] ADD phone NVARCHAR(255)');
        $this->addSql('ALTER TABLE [user] ADD driving_licence NVARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

        $this->addSql('ALTER TABLE [user] DROP COLUMN first_name');
        $this->addSql('ALTER TABLE [user] DROP COLUMN last_name');
        $this->addSql('ALTER TABLE [user] DROP COLUMN adress');
        $this->addSql('ALTER TABLE [user] DROP COLUMN post_code');
        $this->addSql('ALTER TABLE [user] DROP COLUMN city');
        $this->addSql('ALTER TABLE [user] DROP COLUMN phone');
        $this->addSql('ALTER TABLE [user] DROP COLUMN driving_licence');
    }
}

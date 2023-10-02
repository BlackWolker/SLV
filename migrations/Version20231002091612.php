<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002091612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT IDENTITY NOT NULL, name NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE model (id INT IDENTITY NOT NULL, brand_id INT NOT NULL, name NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_D79572D944F5D008 ON model (brand_id)');
        $this->addSql('CREATE TABLE [option] (id INT IDENTITY NOT NULL, name NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE option_vehicul (option_id INT NOT NULL, vehicul_id INT NOT NULL, PRIMARY KEY (option_id, vehicul_id))');
        $this->addSql('CREATE INDEX IDX_E1A8E24FA7C41D6F ON option_vehicul (option_id)');
        $this->addSql('CREATE INDEX IDX_E1A8E24F44ABADA8 ON option_vehicul (vehicul_id)');
        $this->addSql('CREATE TABLE reservation (id INT IDENTITY NOT NULL, state_id INT NOT NULL, vehicul_id INT NOT NULL, customer_id INT NOT NULL, reference NVARCHAR(255) NOT NULL, date_start DATE NOT NULL, date_end DATE NOT NULL, number_rental_day INT, total_cost INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_42C849555D83CC1 ON reservation (state_id)');
        $this->addSql('CREATE INDEX IDX_42C8495544ABADA8 ON reservation (vehicul_id)');
        $this->addSql('CREATE INDEX IDX_42C849559395C3F3 ON reservation (customer_id)');
        $this->addSql('CREATE TABLE resrvation (id INT IDENTITY NOT NULL, customer INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE state (id INT IDENTITY NOT NULL, status NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE type (id INT IDENTITY NOT NULL, name NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE [user] (id INT IDENTITY NOT NULL, email NVARCHAR(180) NOT NULL, roles VARCHAR(MAX) NOT NULL, password NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON [user] (email) WHERE email IS NOT NULL');
        $this->addSql('EXEC sp_addextendedproperty N\'MS_Description\', N\'(DC2Type:json)\', N\'SCHEMA\', \'dbo\', N\'TABLE\', \'user\', N\'COLUMN\', roles');
        $this->addSql('CREATE TABLE vehicul (id INT IDENTITY NOT NULL, type_id INT NOT NULL, model_id INT NOT NULL, capacity INT NOT NULL, price INT NOT NULL, number_plate NVARCHAR(255), year_of_car INT NOT NULL, number_kilometers INT NOT NULL, picture_path NVARCHAR(255), PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_F95CF53AC54C8C93 ON vehicul (type_id)');
        $this->addSql('CREATE INDEX IDX_F95CF53A7975B7E7 ON vehicul (model_id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE option_vehicul ADD CONSTRAINT FK_E1A8E24FA7C41D6F FOREIGN KEY (option_id) REFERENCES [option] (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE option_vehicul ADD CONSTRAINT FK_E1A8E24F44ABADA8 FOREIGN KEY (vehicul_id) REFERENCES vehicul (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849555D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495544ABADA8 FOREIGN KEY (vehicul_id) REFERENCES vehicul (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559395C3F3 FOREIGN KEY (customer_id) REFERENCES [user] (id)');
        $this->addSql('ALTER TABLE vehicul ADD CONSTRAINT FK_F95CF53AC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE vehicul ADD CONSTRAINT FK_F95CF53A7975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

        $this->addSql('ALTER TABLE model DROP CONSTRAINT FK_D79572D944F5D008');
        $this->addSql('ALTER TABLE option_vehicul DROP CONSTRAINT FK_E1A8E24FA7C41D6F');
        $this->addSql('ALTER TABLE option_vehicul DROP CONSTRAINT FK_E1A8E24F44ABADA8');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C849555D83CC1');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C8495544ABADA8');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C849559395C3F3');
        $this->addSql('ALTER TABLE vehicul DROP CONSTRAINT FK_F95CF53AC54C8C93');
        $this->addSql('ALTER TABLE vehicul DROP CONSTRAINT FK_F95CF53A7975B7E7');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE [option]');
        $this->addSql('DROP TABLE option_vehicul');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE resrvation');
        $this->addSql('DROP TABLE state');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE [user]');
        $this->addSql('DROP TABLE vehicul');
    }
}

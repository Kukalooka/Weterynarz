<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220526175308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, owner_id_id INT NOT NULL, vet_id_id INT NOT NULL, name VARCHAR(32) NOT NULL, species VARCHAR(32) NOT NULL, age INT DEFAULT NULL, INDEX IDX_6AAB231F8FDDAB70 (owner_id_id), INDEX IDX_6AAB231FA122277E (vet_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE owner (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, lastname VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vet (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, lastname VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visits (id INT AUTO_INCREMENT NOT NULL, vet_id_id INT NOT NULL, animal_id_id INT NOT NULL, date DATE NOT NULL, INDEX IDX_444839EAA122277E (vet_id_id), INDEX IDX_444839EA5EB747A3 (animal_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F8FDDAB70 FOREIGN KEY (owner_id_id) REFERENCES owner (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FA122277E FOREIGN KEY (vet_id_id) REFERENCES vet (id)');
        $this->addSql('ALTER TABLE visits ADD CONSTRAINT FK_444839EAA122277E FOREIGN KEY (vet_id_id) REFERENCES vet (id)');
        $this->addSql('ALTER TABLE visits ADD CONSTRAINT FK_444839EA5EB747A3 FOREIGN KEY (animal_id_id) REFERENCES animal (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visits DROP FOREIGN KEY FK_444839EA5EB747A3');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F8FDDAB70');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FA122277E');
        $this->addSql('ALTER TABLE visits DROP FOREIGN KEY FK_444839EAA122277E');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE owner');
        $this->addSql('DROP TABLE vet');
        $this->addSql('DROP TABLE visits');
    }
}

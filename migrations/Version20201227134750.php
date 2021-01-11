<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201227134750 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, country VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, age INT NOT NULL, height INT NOT NULL, bodytype VARCHAR(255) NOT NULL, ethnicity VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, employment VARCHAR(255) NOT NULL, sexuality VARCHAR(255) NOT NULL, prefer VARCHAR(255) NOT NULL, purpose VARCHAR(255) NOT NULL, balance NUMERIC(7, 2) NOT NULL, status VARCHAR(255) NOT NULL, vip VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, image_size INT NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8157AA0FE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE user');
    }
}

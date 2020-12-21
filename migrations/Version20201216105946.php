<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201216105946 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD country VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD gender VARCHAR(255) NOT NULL, ADD age INT NOT NULL, ADD height INT NOT NULL, ADD bodytype VARCHAR(255) NOT NULL, ADD ethnicity VARCHAR(255) NOT NULL, ADD phone VARCHAR(255) NOT NULL, ADD employment VARCHAR(255) NOT NULL, ADD sexuality VARCHAR(255) NOT NULL, ADD prefer VARCHAR(255) NOT NULL, ADD purpose VARCHAR(255) NOT NULL, ADD balance NUMERIC(7, 2) NOT NULL, ADD status VARCHAR(255) NOT NULL, ADD vip VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP country, DROP city, DROP gender, DROP age, DROP height, DROP bodytype, DROP ethnicity, DROP phone, DROP employment, DROP sexuality, DROP prefer, DROP purpose, DROP balance, DROP status, DROP vip');
    }
}

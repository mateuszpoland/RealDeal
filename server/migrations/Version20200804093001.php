<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200804093001 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE advertising (id INT NOT NULL, offer_id INT DEFAULT NULL, unique_identifier VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_50219E786BD2BEA0 (unique_identifier), INDEX IDX_50219E7853C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offers (id INT NOT NULL, client_id INT DEFAULT NULL, identifier VARCHAR(255) NOT NULL, name VARCHAR(280) NOT NULL, total_price DOUBLE PRECISION DEFAULT NULL, footage DOUBLE PRECISION DEFAULT NULL, number_of_rooms INT DEFAULT NULL, flat_number INT NOT NULL, state VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_DA460427772E836A (identifier), INDEX IDX_DA46042719EB6921 (client_id), INDEX name_idx (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE advertising ADD CONSTRAINT FK_50219E7853C674EE FOREIGN KEY (offer_id) REFERENCES offers (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA46042719EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA46042719EB6921');
        $this->addSql('ALTER TABLE advertising DROP FOREIGN KEY FK_50219E7853C674EE');
        $this->addSql('DROP TABLE advertising');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE offers');
    }
}

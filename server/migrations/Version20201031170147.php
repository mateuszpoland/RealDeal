<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201031170147 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE advertising (id INT NOT NULL, offer_id INT DEFAULT NULL, unique_identifier VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_50219E786BD2BEA0 (unique_identifier), INDEX IDX_50219E7853C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, second_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, stage VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_search_offer (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, filters_serialized LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', property_offering_type_offering_type VARCHAR(200) NOT NULL, property_type_property_type VARCHAR(255) NOT NULL, INDEX IDX_ACE9E6D619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offers (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, identifier VARCHAR(255) NOT NULL, name VARCHAR(280) NOT NULL, footage DOUBLE PRECISION DEFAULT NULL, district VARCHAR(255) DEFAULT NULL, flat_number INT DEFAULT NULL, available_from DATETIME NOT NULL, state VARCHAR(255) NOT NULL, property_type_property_type VARCHAR(255) NOT NULL, offering_type_offering_type VARCHAR(200) NOT NULL, property_market_type_property_market_type VARCHAR(255) NOT NULL, property_legal_status_property_legal_status VARCHAR(255) NOT NULL, property_contract_type_property_contract_type VARCHAR(255) NOT NULL, total_price_amount DOUBLE PRECISION NOT NULL, total_price_currency VARCHAR(255) NOT NULL, number_of_rooms_rooms_number INT NOT NULL, UNIQUE INDEX UNIQ_DA460427772E836A (identifier), INDEX IDX_DA4604277E3C61F9 (owner_id), INDEX name_idx (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prospective_clients (offer_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_607C4AB853C674EE (offer_id), INDEX IDX_607C4AB819EB6921 (client_id), PRIMARY KEY(offer_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property_match (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, offer_id INT DEFAULT NULL, match_percent DOUBLE PRECISION NOT NULL, INDEX IDX_BC48040819EB6921 (client_id), INDEX IDX_BC48040853C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE advertising ADD CONSTRAINT FK_50219E7853C674EE FOREIGN KEY (offer_id) REFERENCES offers (id)');
        $this->addSql('ALTER TABLE client_search_offer ADD CONSTRAINT FK_ACE9E6D619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA4604277E3C61F9 FOREIGN KEY (owner_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE prospective_clients ADD CONSTRAINT FK_607C4AB853C674EE FOREIGN KEY (offer_id) REFERENCES offers (id)');
        $this->addSql('ALTER TABLE prospective_clients ADD CONSTRAINT FK_607C4AB819EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE property_match ADD CONSTRAINT FK_BC48040819EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE property_match ADD CONSTRAINT FK_BC48040853C674EE FOREIGN KEY (offer_id) REFERENCES offers (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_search_offer DROP FOREIGN KEY FK_ACE9E6D619EB6921');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA4604277E3C61F9');
        $this->addSql('ALTER TABLE prospective_clients DROP FOREIGN KEY FK_607C4AB819EB6921');
        $this->addSql('ALTER TABLE property_match DROP FOREIGN KEY FK_BC48040819EB6921');
        $this->addSql('ALTER TABLE advertising DROP FOREIGN KEY FK_50219E7853C674EE');
        $this->addSql('ALTER TABLE prospective_clients DROP FOREIGN KEY FK_607C4AB853C674EE');
        $this->addSql('ALTER TABLE property_match DROP FOREIGN KEY FK_BC48040853C674EE');
        $this->addSql('DROP TABLE advertising');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_search_offer');
        $this->addSql('DROP TABLE offers');
        $this->addSql('DROP TABLE prospective_clients');
        $this->addSql('DROP TABLE property_match');
    }
}

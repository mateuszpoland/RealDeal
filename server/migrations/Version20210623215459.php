<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623215459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE advertising (id INT NOT NULL, offer_id INT DEFAULT NULL, unique_identifier VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_50219E786BD2BEA0 (unique_identifier), INDEX IDX_50219E7853C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, second_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, stage VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_search_offer (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, filters_serialized LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', property_offering_type_offering_type VARCHAR(200) NOT NULL, property_type_property_type VARCHAR(255) NOT NULL, INDEX IDX_ACE9E6D619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer_photos (id INT AUTO_INCREMENT NOT NULL, offer_id INT DEFAULT NULL, file_path VARCHAR(255) NOT NULL, original_file_name VARCHAR(255) NOT NULL, saved_file_name VARCHAR(255) NOT NULL, photo_role VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D123977882A8E361 (file_path), INDEX IDX_D123977853C674EE (offer_id), INDEX name_idx (file_path), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offers (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, owner_id INT DEFAULT NULL, identifier VARCHAR(255) NOT NULL, name VARCHAR(280) NOT NULL, footage DOUBLE PRECISION DEFAULT NULL, district VARCHAR(255) DEFAULT NULL, flat_number INT DEFAULT NULL, available_from DATETIME NOT NULL, state VARCHAR(255) NOT NULL, property_type VARCHAR(255) NOT NULL, offering_type VARCHAR(200) NOT NULL, property_market_type VARCHAR(255) NOT NULL, property_legal_status VARCHAR(255) NOT NULL, property_contract_type VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, currency VARCHAR(255) NOT NULL, rooms_number INT NOT NULL, UNIQUE INDEX UNIQ_DA460427772E836A (identifier), UNIQUE INDEX UNIQ_DA460427A76ED395 (user_id), INDEX IDX_DA4604277E3C61F9 (owner_id), INDEX name_idx (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prospective_clients (offer_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_607C4AB853C674EE (offer_id), INDEX IDX_607C4AB819EB6921 (client_id), PRIMARY KEY(offer_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property_match (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, offer_id INT NOT NULL, match_percent DOUBLE PRECISION NOT NULL, INDEX IDX_BC48040819EB6921 (client_id), INDEX IDX_BC48040853C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, username VARCHAR(25) NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), UNIQUE INDEX UNIQ_1483A5E935C246D5 (password), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE advertising ADD CONSTRAINT FK_50219E7853C674EE FOREIGN KEY (offer_id) REFERENCES offers (id)');
        $this->addSql('ALTER TABLE client_search_offer ADD CONSTRAINT FK_ACE9E6D619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE offer_photos ADD CONSTRAINT FK_D123977853C674EE FOREIGN KEY (offer_id) REFERENCES offers (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA4604277E3C61F9 FOREIGN KEY (owner_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE prospective_clients ADD CONSTRAINT FK_607C4AB853C674EE FOREIGN KEY (offer_id) REFERENCES offers (id)');
        $this->addSql('ALTER TABLE prospective_clients ADD CONSTRAINT FK_607C4AB819EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE property_match ADD CONSTRAINT FK_BC48040819EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE property_match ADD CONSTRAINT FK_BC48040853C674EE FOREIGN KEY (offer_id) REFERENCES offers (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_search_offer DROP FOREIGN KEY FK_ACE9E6D619EB6921');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA4604277E3C61F9');
        $this->addSql('ALTER TABLE prospective_clients DROP FOREIGN KEY FK_607C4AB819EB6921');
        $this->addSql('ALTER TABLE property_match DROP FOREIGN KEY FK_BC48040819EB6921');
        $this->addSql('ALTER TABLE advertising DROP FOREIGN KEY FK_50219E7853C674EE');
        $this->addSql('ALTER TABLE offer_photos DROP FOREIGN KEY FK_D123977853C674EE');
        $this->addSql('ALTER TABLE prospective_clients DROP FOREIGN KEY FK_607C4AB853C674EE');
        $this->addSql('ALTER TABLE property_match DROP FOREIGN KEY FK_BC48040853C674EE');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA460427A76ED395');
        $this->addSql('DROP TABLE advertising');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_search_offer');
        $this->addSql('DROP TABLE offer_photos');
        $this->addSql('DROP TABLE offers');
        $this->addSql('DROP TABLE prospective_clients');
        $this->addSql('DROP TABLE property_match');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE users');
    }
}

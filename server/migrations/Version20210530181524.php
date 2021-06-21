<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210530181524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property_match CHANGE client_id client_id INT NOT NULL, CHANGE offer_id offer_id INT NOT NULL');
        $this->addSql('ALTER TABLE users ADD password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E935C246D5 ON users (password)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property_match CHANGE client_id client_id INT DEFAULT NULL, CHANGE offer_id offer_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_1483A5E935C246D5 ON users');
        $this->addSql('ALTER TABLE users DROP password');
    }
}

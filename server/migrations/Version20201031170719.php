<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201031170719 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offers CHANGE total_price_amount amount DOUBLE PRECISION NOT NULL, CHANGE total_price_currency currency VARCHAR(255) NOT NULL, CHANGE number_of_rooms_rooms_number rooms_number INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offers CHANGE amount total_price_amount DOUBLE PRECISION NOT NULL, CHANGE currency total_price_currency VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE rooms_number number_of_rooms_rooms_number INT NOT NULL');
    }
}

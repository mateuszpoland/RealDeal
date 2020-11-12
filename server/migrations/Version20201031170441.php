<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201031170441 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offers ADD property_type VARCHAR(255) NOT NULL, ADD property_market_type VARCHAR(255) NOT NULL, ADD property_legal_status VARCHAR(255) NOT NULL, ADD property_contract_type VARCHAR(255) NOT NULL, DROP property_type_property_type, DROP property_market_type_property_market_type, DROP property_legal_status_property_legal_status, DROP property_contract_type_property_contract_type, CHANGE offering_type_offering_type offering_type VARCHAR(200) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offers ADD property_type_property_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD property_market_type_property_market_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD property_legal_status_property_legal_status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD property_contract_type_property_contract_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP property_type, DROP property_market_type, DROP property_legal_status, DROP property_contract_type, CHANGE offering_type offering_type_offering_type VARCHAR(200) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

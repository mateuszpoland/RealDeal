<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208202618 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer_photos ADD file_path VARCHAR(255) NOT NULL, ADD original_file_name VARCHAR(255) NOT NULL, ADD saved_file_name VARCHAR(255) NOT NULL, ADD photo_status ENUM(\'MAIN_PHOTO\', \'SIDE_PHOTO\')');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D123977882A8E361 ON offer_photos (file_path)');
        $this->addSql('CREATE INDEX name_idx ON offer_photos (file_path)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_D123977882A8E361 ON offer_photos');
        $this->addSql('DROP INDEX name_idx ON offer_photos');
        $this->addSql('ALTER TABLE offer_photos DROP file_path, DROP original_file_name, DROP saved_file_name, DROP photo_status');
    }
}

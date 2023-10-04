<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231004073835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD image_size INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN image.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE room ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_729F519B3DA5256D ON room (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE room DROP CONSTRAINT FK_729F519B3DA5256D');
        $this->addSql('DROP INDEX IDX_729F519B3DA5256D');
        $this->addSql('ALTER TABLE room DROP image_id');
        $this->addSql('ALTER TABLE image DROP image_name');
        $this->addSql('ALTER TABLE image DROP image_size');
        $this->addSql('ALTER TABLE image DROP updated_at');
    }
}

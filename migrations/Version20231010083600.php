<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010083600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE booking_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE booking (id INT NOT NULL, room_id INT NOT NULL, of_user_id INT NOT NULL, arrived_date DATE NOT NULL, leaving_date DATE NOT NULL, number_of_nights INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E00CEDDE54177093 ON booking (room_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE5A1B2224 ON booking (of_user_id)');
        $this->addSql('COMMENT ON COLUMN booking.arrived_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN booking.leaving_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE54177093 FOREIGN KEY (room_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE5A1B2224 FOREIGN KEY (of_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE booking_id_seq CASCADE');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDE54177093');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDE5A1B2224');
        $this->addSql('DROP TABLE booking');
    }
}

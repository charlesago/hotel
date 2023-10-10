<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010072916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE equipement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE equipement (id INT NOT NULL, name TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE equipement_room (equipement_id INT NOT NULL, room_id INT NOT NULL, PRIMARY KEY(equipement_id, room_id))');
        $this->addSql('CREATE INDEX IDX_9D43C8AB806F0F5C ON equipement_room (equipement_id)');
        $this->addSql('CREATE INDEX IDX_9D43C8AB54177093 ON equipement_room (room_id)');
        $this->addSql('ALTER TABLE equipement_room ADD CONSTRAINT FK_9D43C8AB806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipement_room ADD CONSTRAINT FK_9D43C8AB54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE equipement_id_seq CASCADE');
        $this->addSql('ALTER TABLE equipement_room DROP CONSTRAINT FK_9D43C8AB806F0F5C');
        $this->addSql('ALTER TABLE equipement_room DROP CONSTRAINT FK_9D43C8AB54177093');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE equipement_room');
    }
}

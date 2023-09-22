<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230922152909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invitations DROP FOREIGN KEY FK_232710AECD53EDB6');
        $this->addSql('ALTER TABLE invitations CHANGE status status VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE invitations ADD CONSTRAINT FK_232710AECD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invitations DROP FOREIGN KEY FK_232710AECD53EDB6');
        $this->addSql('ALTER TABLE invitations CHANGE status status VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE invitations ADD CONSTRAINT FK_232710AECD53EDB6 FOREIGN KEY (receiver_id) REFERENCES friends (id)');
    }
}

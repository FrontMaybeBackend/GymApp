<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230922140440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invitations (id INT AUTO_INCREMENT NOT NULL, status TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD shipper_id INT DEFAULT NULL, ADD receiver_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64938459F23 FOREIGN KEY (shipper_id) REFERENCES invitations (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CD53EDB6 FOREIGN KEY (receiver_id) REFERENCES invitations (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64938459F23 ON user (shipper_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649CD53EDB6 ON user (receiver_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64938459F23');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CD53EDB6');
        $this->addSql('DROP TABLE invitations');
        $this->addSql('DROP INDEX IDX_8D93D64938459F23 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649CD53EDB6 ON user');
        $this->addSql('ALTER TABLE user DROP shipper_id, DROP receiver_id');
    }
}

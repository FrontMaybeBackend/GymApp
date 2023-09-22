<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230922154632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invitations_user (invitations_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_CC13F73E5A6F1243 (invitations_id), INDEX IDX_CC13F73EA76ED395 (user_id), PRIMARY KEY(invitations_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invitations_user ADD CONSTRAINT FK_CC13F73E5A6F1243 FOREIGN KEY (invitations_id) REFERENCES invitations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invitations_user ADD CONSTRAINT FK_CC13F73EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invitations DROP FOREIGN KEY FK_232710AECD53EDB6');
        $this->addSql('DROP INDEX IDX_232710AECD53EDB6 ON invitations');
        $this->addSql('ALTER TABLE invitations CHANGE receiver_id receiver2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invitations ADD CONSTRAINT FK_232710AEE616C729 FOREIGN KEY (receiver2_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_232710AEE616C729 ON invitations (receiver2_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F624B39D');
        $this->addSql('DROP INDEX IDX_8D93D649F624B39D ON user');
        $this->addSql('ALTER TABLE user DROP sender_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invitations_user DROP FOREIGN KEY FK_CC13F73E5A6F1243');
        $this->addSql('ALTER TABLE invitations_user DROP FOREIGN KEY FK_CC13F73EA76ED395');
        $this->addSql('DROP TABLE invitations_user');
        $this->addSql('ALTER TABLE invitations DROP FOREIGN KEY FK_232710AEE616C729');
        $this->addSql('DROP INDEX IDX_232710AEE616C729 ON invitations');
        $this->addSql('ALTER TABLE invitations CHANGE receiver2_id receiver_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invitations ADD CONSTRAINT FK_232710AECD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_232710AECD53EDB6 ON invitations (receiver_id)');
        $this->addSql('ALTER TABLE user ADD sender_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F624B39D FOREIGN KEY (sender_id) REFERENCES invitations (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F624B39D ON user (sender_id)');
    }
}

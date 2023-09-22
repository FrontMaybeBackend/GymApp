<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230922152428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invitations DROP FOREIGN KEY FK_232710AEF624B39D');
        $this->addSql('DROP INDEX IDX_232710AEF624B39D ON invitations');
        $this->addSql('ALTER TABLE invitations DROP sender_id, CHANGE status status VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD sender_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F624B39D FOREIGN KEY (sender_id) REFERENCES invitations (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F624B39D ON user (sender_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invitations ADD sender_id INT DEFAULT NULL, CHANGE status status VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE invitations ADD CONSTRAINT FK_232710AEF624B39D FOREIGN KEY (sender_id) REFERENCES friends (id)');
        $this->addSql('CREATE INDEX IDX_232710AEF624B39D ON invitations (sender_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F624B39D');
        $this->addSql('DROP INDEX IDX_8D93D649F624B39D ON user');
        $this->addSql('ALTER TABLE user DROP sender_id');
    }
}

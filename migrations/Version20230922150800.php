<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230922150800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invitations ADD sender_id INT DEFAULT NULL, ADD receiver_id INT DEFAULT NULL, DROP status');
        $this->addSql('ALTER TABLE invitations ADD CONSTRAINT FK_232710AEF624B39D FOREIGN KEY (sender_id) REFERENCES friends (id)');
        $this->addSql('ALTER TABLE invitations ADD CONSTRAINT FK_232710AECD53EDB6 FOREIGN KEY (receiver_id) REFERENCES friends (id)');
        $this->addSql('CREATE INDEX IDX_232710AEF624B39D ON invitations (sender_id)');
        $this->addSql('CREATE INDEX IDX_232710AECD53EDB6 ON invitations (receiver_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CD53EDB6');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64938459F23');
        $this->addSql('DROP INDEX IDX_8D93D64938459F23 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649CD53EDB6 ON user');
        $this->addSql('ALTER TABLE user DROP shipper_id, DROP receiver_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invitations DROP FOREIGN KEY FK_232710AEF624B39D');
        $this->addSql('ALTER TABLE invitations DROP FOREIGN KEY FK_232710AECD53EDB6');
        $this->addSql('DROP INDEX IDX_232710AEF624B39D ON invitations');
        $this->addSql('DROP INDEX IDX_232710AECD53EDB6 ON invitations');
        $this->addSql('ALTER TABLE invitations ADD status TINYINT(1) DEFAULT NULL, DROP sender_id, DROP receiver_id');
        $this->addSql('ALTER TABLE user ADD shipper_id INT DEFAULT NULL, ADD receiver_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CD53EDB6 FOREIGN KEY (receiver_id) REFERENCES invitations (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64938459F23 FOREIGN KEY (shipper_id) REFERENCES invitations (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64938459F23 ON user (shipper_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649CD53EDB6 ON user (receiver_id)');
    }
}

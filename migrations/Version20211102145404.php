<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211102145404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD user_enterprise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64947F3B793 FOREIGN KEY (user_enterprise_id) REFERENCES enterprise (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64947F3B793 ON user (user_enterprise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64947F3B793');
        $this->addSql('DROP INDEX UNIQ_8D93D64947F3B793 ON user');
        $this->addSql('ALTER TABLE user DROP user_enterprise_id');
    }
}

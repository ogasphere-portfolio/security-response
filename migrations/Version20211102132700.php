<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211102132700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE member CHANGE gender gender INT NOT NULL, CHANGE job_status job_status INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD user_member_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64975775E1A FOREIGN KEY (user_member_id) REFERENCES member (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64975775E1A ON user (user_member_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE member CHANGE gender gender INT DEFAULT NULL, CHANGE job_status job_status INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64975775E1A');
        $this->addSql('DROP INDEX UNIQ_8D93D64975775E1A ON user');
        $this->addSql('ALTER TABLE user DROP user_member_id');
    }
}

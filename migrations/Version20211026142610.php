<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211026142610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE announcement_certification (announcement_id INT NOT NULL, certification_id INT NOT NULL, INDEX IDX_55C5AF09913AEA17 (announcement_id), INDEX IDX_55C5AF09CB47068A (certification_id), PRIMARY KEY(announcement_id, certification_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE announcement_member (announcement_id INT NOT NULL, member_id INT NOT NULL, INDEX IDX_68314C23913AEA17 (announcement_id), INDEX IDX_68314C237597D3FE (member_id), PRIMARY KEY(announcement_id, member_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE announcement_specialization (announcement_id INT NOT NULL, specialization_id INT NOT NULL, INDEX IDX_C75336BF913AEA17 (announcement_id), INDEX IDX_C75336BFFA846217 (specialization_id), PRIMARY KEY(announcement_id, specialization_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_enterprise (document_id INT NOT NULL, enterprise_id INT NOT NULL, INDEX IDX_1070C155C33F7837 (document_id), INDEX IDX_1070C155A97D1AC3 (enterprise_id), PRIMARY KEY(document_id, enterprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member_social_network (member_id INT NOT NULL, social_network_id INT NOT NULL, INDEX IDX_B128B927597D3FE (member_id), INDEX IDX_B128B92FA413953 (social_network_id), PRIMARY KEY(member_id, social_network_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member_specialization (member_id INT NOT NULL, specialization_id INT NOT NULL, INDEX IDX_7A342BD97597D3FE (member_id), INDEX IDX_7A342BD9FA846217 (specialization_id), PRIMARY KEY(member_id, specialization_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE announcement_certification ADD CONSTRAINT FK_55C5AF09913AEA17 FOREIGN KEY (announcement_id) REFERENCES announcement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE announcement_certification ADD CONSTRAINT FK_55C5AF09CB47068A FOREIGN KEY (certification_id) REFERENCES certification (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE announcement_member ADD CONSTRAINT FK_68314C23913AEA17 FOREIGN KEY (announcement_id) REFERENCES announcement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE announcement_member ADD CONSTRAINT FK_68314C237597D3FE FOREIGN KEY (member_id) REFERENCES member (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE announcement_specialization ADD CONSTRAINT FK_C75336BF913AEA17 FOREIGN KEY (announcement_id) REFERENCES announcement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE announcement_specialization ADD CONSTRAINT FK_C75336BFFA846217 FOREIGN KEY (specialization_id) REFERENCES specialization (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_enterprise ADD CONSTRAINT FK_1070C155C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_enterprise ADD CONSTRAINT FK_1070C155A97D1AC3 FOREIGN KEY (enterprise_id) REFERENCES enterprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_social_network ADD CONSTRAINT FK_B128B927597D3FE FOREIGN KEY (member_id) REFERENCES member (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_social_network ADD CONSTRAINT FK_B128B92FA413953 FOREIGN KEY (social_network_id) REFERENCES social_network (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_specialization ADD CONSTRAINT FK_7A342BD97597D3FE FOREIGN KEY (member_id) REFERENCES member (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_specialization ADD CONSTRAINT FK_7A342BD9FA846217 FOREIGN KEY (specialization_id) REFERENCES specialization (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE announcement ADD document_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91CC33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('CREATE INDEX IDX_4DB9D91CC33F7837 ON announcement (document_id)');
        $this->addSql('ALTER TABLE category ADD announcement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1913AEA17 FOREIGN KEY (announcement_id) REFERENCES announcement (id)');
        $this->addSql('CREATE INDEX IDX_64C19C1913AEA17 ON category (announcement_id)');
        $this->addSql('ALTER TABLE enterprise ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enterprise ADD CONSTRAINT FK_B1B36A03A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B1B36A03A76ED395 ON enterprise (user_id)');
        $this->addSql('ALTER TABLE member ADD user_id INT NOT NULL, ADD document_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78C33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70E4FA78A76ED395 ON member (user_id)');
        $this->addSql('CREATE INDEX IDX_70E4FA78C33F7837 ON member (document_id)');
        $this->addSql('ALTER TABLE user ADD role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON user (role_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE announcement_certification');
        $this->addSql('DROP TABLE announcement_member');
        $this->addSql('DROP TABLE announcement_specialization');
        $this->addSql('DROP TABLE document_enterprise');
        $this->addSql('DROP TABLE member_social_network');
        $this->addSql('DROP TABLE member_specialization');
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91CC33F7837');
        $this->addSql('DROP INDEX IDX_4DB9D91CC33F7837 ON announcement');
        $this->addSql('ALTER TABLE announcement DROP document_id');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1913AEA17');
        $this->addSql('DROP INDEX IDX_64C19C1913AEA17 ON category');
        $this->addSql('ALTER TABLE category DROP announcement_id');
        $this->addSql('ALTER TABLE enterprise DROP FOREIGN KEY FK_B1B36A03A76ED395');
        $this->addSql('DROP INDEX UNIQ_B1B36A03A76ED395 ON enterprise');
        $this->addSql('ALTER TABLE enterprise DROP user_id');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78A76ED395');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78C33F7837');
        $this->addSql('DROP INDEX UNIQ_70E4FA78A76ED395 ON member');
        $this->addSql('DROP INDEX IDX_70E4FA78C33F7837 ON member');
        $this->addSql('ALTER TABLE member DROP user_id, DROP document_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('DROP INDEX IDX_8D93D649D60322AC ON user');
        $this->addSql('ALTER TABLE user DROP role_id');
    }
}

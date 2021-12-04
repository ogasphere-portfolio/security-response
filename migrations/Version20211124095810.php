<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211124095810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compagny (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) DEFAULT NULL, business_name VARCHAR(255) NOT NULL, siret_number VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, address_more VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) NOT NULL, phone_number VARCHAR(20) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, latitude NUMERIC(50, 10) DEFAULT NULL, longitude NUMERIC(50, 10) DEFAULT NULL, contact_mail VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compagny_certification (compagny_id INT NOT NULL, certification_id INT NOT NULL, INDEX IDX_3DF3AAA21224ABE0 (compagny_id), INDEX IDX_3DF3AAA2CB47068A (certification_id), PRIMARY KEY(compagny_id, certification_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_compagny (document_id INT NOT NULL, compagny_id INT NOT NULL, INDEX IDX_98648B5DC33F7837 (document_id), INDEX IDX_98648B5D1224ABE0 (compagny_id), PRIMARY KEY(document_id, compagny_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compagny_certification ADD CONSTRAINT FK_3DF3AAA21224ABE0 FOREIGN KEY (compagny_id) REFERENCES compagny (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compagny_certification ADD CONSTRAINT FK_3DF3AAA2CB47068A FOREIGN KEY (certification_id) REFERENCES certification (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_compagny ADD CONSTRAINT FK_98648B5DC33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_compagny ADD CONSTRAINT FK_98648B5D1224ABE0 FOREIGN KEY (compagny_id) REFERENCES compagny (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE announcement_specialization');
        $this->addSql('ALTER TABLE announcement ADD compagny_id INT DEFAULT NULL, ADD specialization_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91C1224ABE0 FOREIGN KEY (compagny_id) REFERENCES compagny (id)');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91CFA846217 FOREIGN KEY (specialization_id) REFERENCES specialization (id)');
        $this->addSql('CREATE INDEX IDX_4DB9D91C1224ABE0 ON announcement (compagny_id)');
        $this->addSql('CREATE INDEX IDX_4DB9D91CFA846217 ON announcement (specialization_id)');
        $this->addSql('ALTER TABLE user ADD user_compagny_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BB3F6275 FOREIGN KEY (user_compagny_id) REFERENCES compagny (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649BB3F6275 ON user (user_compagny_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91C1224ABE0');
        $this->addSql('ALTER TABLE compagny_certification DROP FOREIGN KEY FK_3DF3AAA21224ABE0');
        $this->addSql('ALTER TABLE document_compagny DROP FOREIGN KEY FK_98648B5D1224ABE0');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BB3F6275');
        $this->addSql('CREATE TABLE announcement_specialization (announcement_id INT NOT NULL, specialization_id INT NOT NULL, INDEX IDX_C75336BFFA846217 (specialization_id), INDEX IDX_C75336BF913AEA17 (announcement_id), PRIMARY KEY(announcement_id, specialization_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE announcement_specialization ADD CONSTRAINT FK_C75336BF913AEA17 FOREIGN KEY (announcement_id) REFERENCES announcement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE announcement_specialization ADD CONSTRAINT FK_C75336BFFA846217 FOREIGN KEY (specialization_id) REFERENCES specialization (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE compagny');
        $this->addSql('DROP TABLE compagny_certification');
        $this->addSql('DROP TABLE document_compagny');
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91CFA846217');
        $this->addSql('DROP INDEX IDX_4DB9D91C1224ABE0 ON announcement');
        $this->addSql('DROP INDEX IDX_4DB9D91CFA846217 ON announcement');
        $this->addSql('ALTER TABLE announcement DROP compagny_id, DROP specialization_id');
        $this->addSql('DROP INDEX UNIQ_8D93D649BB3F6275 ON user');
        $this->addSql('ALTER TABLE user DROP user_compagny_id');
    }
}

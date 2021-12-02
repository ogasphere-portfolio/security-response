<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211202071958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91C1224ABE0');
        $this->addSql('ALTER TABLE compagny_certification DROP FOREIGN KEY FK_3DF3AAA21224ABE0');
        $this->addSql('ALTER TABLE document_compagny DROP FOREIGN KEY FK_98648B5D1224ABE0');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BB3F6275');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) DEFAULT NULL, business_name VARCHAR(255) NOT NULL, siret_number VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, address_more VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) NOT NULL, phone_number VARCHAR(20) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, contact_mail VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_company (document_id INT NOT NULL, company_id INT NOT NULL, INDEX IDX_EBD0AF93C33F7837 (document_id), INDEX IDX_EBD0AF93979B1AD6 (company_id), PRIMARY KEY(document_id, company_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document_company ADD CONSTRAINT FK_EBD0AF93C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_company ADD CONSTRAINT FK_EBD0AF93979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE compagny');
        $this->addSql('DROP TABLE compagny_certification');
        $this->addSql('DROP TABLE document_compagny');
        $this->addSql('DROP INDEX IDX_4DB9D91C1224ABE0 ON announcement');
        $this->addSql('ALTER TABLE announcement CHANGE compagny_id company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91C979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_4DB9D91C979B1AD6 ON announcement (company_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649BB3F6275 ON user');
        $this->addSql('ALTER TABLE user CHANGE user_compagny_id user_company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64930FCDC3A FOREIGN KEY (user_company_id) REFERENCES company (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64930FCDC3A ON user (user_company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91C979B1AD6');
        $this->addSql('ALTER TABLE document_company DROP FOREIGN KEY FK_EBD0AF93979B1AD6');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64930FCDC3A');
        $this->addSql('CREATE TABLE compagny (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, business_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, siret_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address_more VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, zip_code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phone_number VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, logo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, contact_mail VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, city VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, updated_by VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE compagny_certification (compagny_id INT NOT NULL, certification_id INT NOT NULL, INDEX IDX_3DF3AAA2CB47068A (certification_id), INDEX IDX_3DF3AAA21224ABE0 (compagny_id), PRIMARY KEY(compagny_id, certification_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE document_compagny (document_id INT NOT NULL, compagny_id INT NOT NULL, INDEX IDX_98648B5D1224ABE0 (compagny_id), INDEX IDX_98648B5DC33F7837 (document_id), PRIMARY KEY(document_id, compagny_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE compagny_certification ADD CONSTRAINT FK_3DF3AAA21224ABE0 FOREIGN KEY (compagny_id) REFERENCES compagny (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compagny_certification ADD CONSTRAINT FK_3DF3AAA2CB47068A FOREIGN KEY (certification_id) REFERENCES certification (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_compagny ADD CONSTRAINT FK_98648B5D1224ABE0 FOREIGN KEY (compagny_id) REFERENCES compagny (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_compagny ADD CONSTRAINT FK_98648B5DC33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE document_company');
        $this->addSql('DROP INDEX IDX_4DB9D91C979B1AD6 ON announcement');
        $this->addSql('ALTER TABLE announcement CHANGE company_id compagny_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91C1224ABE0 FOREIGN KEY (compagny_id) REFERENCES compagny (id)');
        $this->addSql('CREATE INDEX IDX_4DB9D91C1224ABE0 ON announcement (compagny_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D64930FCDC3A ON user');
        $this->addSql('ALTER TABLE user CHANGE user_company_id user_compagny_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BB3F6275 FOREIGN KEY (user_compagny_id) REFERENCES compagny (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649BB3F6275 ON user (user_compagny_id)');
    }
}

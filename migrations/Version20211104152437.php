<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211104152437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announcement ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_4DB9D91C12469DE2 ON announcement (category_id)');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1913AEA17');
        $this->addSql('DROP INDEX IDX_64C19C1913AEA17 ON category');
        $this->addSql('ALTER TABLE category DROP announcement_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91C12469DE2');
        $this->addSql('DROP INDEX IDX_4DB9D91C12469DE2 ON announcement');
        $this->addSql('ALTER TABLE announcement DROP category_id');
        $this->addSql('ALTER TABLE category ADD announcement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1913AEA17 FOREIGN KEY (announcement_id) REFERENCES announcement (id)');
        $this->addSql('CREATE INDEX IDX_64C19C1913AEA17 ON category (announcement_id)');
    }
}

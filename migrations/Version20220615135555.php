<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615135555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE musicien (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musicien_groupe (musicien_id INT NOT NULL, groupe_id INT NOT NULL, INDEX IDX_E25DB2CE60A30C4A (musicien_id), INDEX IDX_E25DB2CE7A45358C (groupe_id), PRIMARY KEY(musicien_id, groupe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musicien_instrument (musicien_id INT NOT NULL, instrument_id INT NOT NULL, INDEX IDX_EF2D818C60A30C4A (musicien_id), INDEX IDX_EF2D818CCF11D9C (instrument_id), PRIMARY KEY(musicien_id, instrument_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE musicien_groupe ADD CONSTRAINT FK_E25DB2CE60A30C4A FOREIGN KEY (musicien_id) REFERENCES musicien (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musicien_groupe ADD CONSTRAINT FK_E25DB2CE7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musicien_instrument ADD CONSTRAINT FK_EF2D818C60A30C4A FOREIGN KEY (musicien_id) REFERENCES musicien (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musicien_instrument ADD CONSTRAINT FK_EF2D818CCF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE musicien_groupe DROP FOREIGN KEY FK_E25DB2CE60A30C4A');
        $this->addSql('ALTER TABLE musicien_instrument DROP FOREIGN KEY FK_EF2D818C60A30C4A');
        $this->addSql('DROP TABLE musicien');
        $this->addSql('DROP TABLE musicien_groupe');
        $this->addSql('DROP TABLE musicien_instrument');
    }
}

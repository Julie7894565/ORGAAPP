<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615134358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, style_id INT NOT NULL, name VARCHAR(255) NOT NULL, contact_name VARCHAR(255) NOT NULL, contact_phone VARCHAR(255) NOT NULL, contact_email VARCHAR(255) NOT NULL, setup TIME NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL, INDEX IDX_4B98C21A76ED395 (user_id), INDEX IDX_4B98C21BACD6074 (style_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrument (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrument_materiel (instrument_id INT NOT NULL, materiel_id INT NOT NULL, INDEX IDX_B97B1090CF11D9C (instrument_id), INDEX IDX_B97B109016880AAF (materiel_id), PRIMARY KEY(instrument_id, materiel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, style_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21BACD6074 FOREIGN KEY (style_id) REFERENCES style (id)');
        $this->addSql('ALTER TABLE instrument_materiel ADD CONSTRAINT FK_B97B1090CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrument_materiel ADD CONSTRAINT FK_B97B109016880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE instrument_materiel DROP FOREIGN KEY FK_B97B1090CF11D9C');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C21BACD6074');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE instrument');
        $this->addSql('DROP TABLE instrument_materiel');
        $this->addSql('DROP TABLE style');
    }
}

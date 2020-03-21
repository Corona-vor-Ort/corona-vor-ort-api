<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321170443 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bundesland (id INT AUTO_INCREMENT NOT NULL, bundesland_id INT NOT NULL, name VARCHAR(63) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kategorie (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(63) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kreis (id INT AUTO_INCREMENT NOT NULL, kreisnummer INT NOT NULL, name VARCHAR(63) NOT NULL, bundesland INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link_kreise_meldungen (id INT AUTO_INCREMENT NOT NULL, kreisnummer INT NOT NULL, meldung_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link_meldungen_kategorien (id INT AUTO_INCREMENT NOT NULL, meldung_id INT NOT NULL, kategorie_id INT NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meldung (id INT AUTO_INCREMENT NOT NULL, meldung_id INT NOT NULL, bbk_identifier VARCHAR(63) DEFAULT NULL, sent DATETIME NOT NULL, message_type VARCHAR(31) NOT NULL, headline VARCHAR(511) NOT NULL, description LONGTEXT NOT NULL, instruction LONGTEXT DEFAULT NULL, more_information_link VARCHAR(511) DEFAULT NULL, contact LONGTEXT DEFAULT NULL, area_description VARCHAR(63) NOT NULL, severity INT DEFAULT NULL, language VARCHAR(7) NOT NULL, meldende_stelle VARCHAR(127) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meldungsreferenz (id INT AUTO_INCREMENT NOT NULL, origin INT NOT NULL, target INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plz (id INT AUTO_INCREMENT NOT NULL, plz INT NOT NULL, kreisnummer INT NOT NULL, ort VARCHAR(63) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE locale CHANGE id id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE bundesland');
        $this->addSql('DROP TABLE kategorie');
        $this->addSql('DROP TABLE kreis');
        $this->addSql('DROP TABLE link_kreise_meldungen');
        $this->addSql('DROP TABLE link_meldungen_kategorien');
        $this->addSql('DROP TABLE meldung');
        $this->addSql('DROP TABLE meldungsreferenz');
        $this->addSql('DROP TABLE plz');
        $this->addSql('ALTER TABLE locale CHANGE id id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
    }
}

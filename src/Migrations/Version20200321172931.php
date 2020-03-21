<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321172931 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE city CHANGE id id BINARY(16) NOT NULL, CHANGE county_id county_id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE city_translation CHANGE id id BINARY(16) NOT NULL, CHANGE city_id city_id BINARY(16) NOT NULL, CHANGE locale_id locale_id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE city_zip_code CHANGE id id BINARY(16) NOT NULL, CHANGE city_id city_id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE country CHANGE id id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE country_translation CHANGE id id BINARY(16) NOT NULL, CHANGE country_id country_id BINARY(16) NOT NULL, CHANGE locale_id locale_id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE county CHANGE id id BINARY(16) NOT NULL, CHANGE country_id country_id BINARY(16) NOT NULL, CHANGE state_id state_id BINARY(16) DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE county_translation CHANGE id id BINARY(16) NOT NULL, CHANGE county_id county_id BINARY(16) NOT NULL, CHANGE locale_id locale_id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE locale CHANGE id id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE meldung CHANGE bbk_identifier bbk_identifier VARCHAR(63) DEFAULT NULL, CHANGE more_information_link more_information_link VARCHAR(511) DEFAULT NULL, CHANGE severity severity INT DEFAULT NULL, CHANGE meldende_stelle meldende_stelle VARCHAR(127) DEFAULT NULL');
        $this->addSql('ALTER TABLE state CHANGE id id BINARY(16) NOT NULL, CHANGE country_id country_id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE state_translation CHANGE id id BINARY(16) NOT NULL, CHANGE state_id state_id BINARY(16) NOT NULL, CHANGE locale_id locale_id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bundesland (id INT AUTO_INCREMENT NOT NULL, bundesland_id INT NOT NULL, name VARCHAR(63) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE kreis (id INT AUTO_INCREMENT NOT NULL, kreisnummer INT NOT NULL, name VARCHAR(63) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, bundesland INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE plz (id INT AUTO_INCREMENT NOT NULL, plz INT NOT NULL, kreisnummer INT NOT NULL, ort VARCHAR(63) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE city CHANGE id id BINARY(16) NOT NULL, CHANGE county_id county_id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE city_translation CHANGE id id BINARY(16) NOT NULL, CHANGE city_id city_id BINARY(16) NOT NULL, CHANGE locale_id locale_id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE city_zip_code CHANGE id id BINARY(16) NOT NULL, CHANGE city_id city_id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE country CHANGE id id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE country_translation CHANGE id id BINARY(16) NOT NULL, CHANGE country_id country_id BINARY(16) NOT NULL, CHANGE locale_id locale_id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE county CHANGE id id BINARY(16) NOT NULL, CHANGE country_id country_id BINARY(16) NOT NULL, CHANGE state_id state_id BINARY(16) DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE county_translation CHANGE id id BINARY(16) NOT NULL, CHANGE county_id county_id BINARY(16) NOT NULL, CHANGE locale_id locale_id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE locale CHANGE id id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE meldung CHANGE bbk_identifier bbk_identifier VARCHAR(63) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE more_information_link more_information_link VARCHAR(511) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE severity severity INT DEFAULT NULL, CHANGE meldende_stelle meldende_stelle VARCHAR(127) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE state CHANGE id id BINARY(16) NOT NULL, CHANGE country_id country_id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE state_translation CHANGE id id BINARY(16) NOT NULL, CHANGE state_id state_id BINARY(16) NOT NULL, CHANGE locale_id locale_id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
    }
}

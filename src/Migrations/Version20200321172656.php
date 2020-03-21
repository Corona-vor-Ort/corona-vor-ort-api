<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321172656 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE city (id BINARY(16) NOT NULL, county_id BINARY(16) NOT NULL, ags VARCHAR(255) NOT NULL, osm VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_2D5B023485E73F45 (county_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city_translation (id BINARY(16) NOT NULL, city_id BINARY(16) NOT NULL, locale_id BINARY(16) NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_97DD5B608BAC62AF (city_id), INDEX IDX_97DD5B60E559DFD1 (locale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city_zip_code (id BINARY(16) NOT NULL, city_id BINARY(16) NOT NULL, code VARCHAR(10) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_2474993E8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id BINARY(16) NOT NULL, iso VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country_translation (id BINARY(16) NOT NULL, country_id BINARY(16) NOT NULL, locale_id BINARY(16) NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_A1FE6FA4F92F3E70 (country_id), INDEX IDX_A1FE6FA4E559DFD1 (locale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE county (id BINARY(16) NOT NULL, country_id BINARY(16) NOT NULL, state_id BINARY(16) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_58E2FF25F92F3E70 (country_id), INDEX IDX_58E2FF255D83CC1 (state_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE county_translation (id BINARY(16) NOT NULL, county_id BINARY(16) NOT NULL, locale_id BINARY(16) NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_8AE0F6F185E73F45 (county_id), INDEX IDX_8AE0F6F1E559DFD1 (locale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE state (id BINARY(16) NOT NULL, country_id BINARY(16) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_A393D2FBF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE state_translation (id BINARY(16) NOT NULL, state_id BINARY(16) NOT NULL, locale_id BINARY(16) NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_7F4D61325D83CC1 (state_id), INDEX IDX_7F4D6132E559DFD1 (locale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B023485E73F45 FOREIGN KEY (county_id) REFERENCES county (id)');
        $this->addSql('ALTER TABLE city_translation ADD CONSTRAINT FK_97DD5B608BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE city_translation ADD CONSTRAINT FK_97DD5B60E559DFD1 FOREIGN KEY (locale_id) REFERENCES locale (id)');
        $this->addSql('ALTER TABLE city_zip_code ADD CONSTRAINT FK_2474993E8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE country_translation ADD CONSTRAINT FK_A1FE6FA4F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE country_translation ADD CONSTRAINT FK_A1FE6FA4E559DFD1 FOREIGN KEY (locale_id) REFERENCES locale (id)');
        $this->addSql('ALTER TABLE county ADD CONSTRAINT FK_58E2FF25F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE county ADD CONSTRAINT FK_58E2FF255D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE county_translation ADD CONSTRAINT FK_8AE0F6F185E73F45 FOREIGN KEY (county_id) REFERENCES county (id)');
        $this->addSql('ALTER TABLE county_translation ADD CONSTRAINT FK_8AE0F6F1E559DFD1 FOREIGN KEY (locale_id) REFERENCES locale (id)');
        $this->addSql('ALTER TABLE state ADD CONSTRAINT FK_A393D2FBF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE state_translation ADD CONSTRAINT FK_7F4D61325D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE state_translation ADD CONSTRAINT FK_7F4D6132E559DFD1 FOREIGN KEY (locale_id) REFERENCES locale (id)');
        $this->addSql('ALTER TABLE locale CHANGE id id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE meldung CHANGE bbk_identifier bbk_identifier VARCHAR(63) DEFAULT NULL, CHANGE more_information_link more_information_link VARCHAR(511) DEFAULT NULL, CHANGE severity severity INT DEFAULT NULL, CHANGE meldende_stelle meldende_stelle VARCHAR(127) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE city_translation DROP FOREIGN KEY FK_97DD5B608BAC62AF');
        $this->addSql('ALTER TABLE city_zip_code DROP FOREIGN KEY FK_2474993E8BAC62AF');
        $this->addSql('ALTER TABLE country_translation DROP FOREIGN KEY FK_A1FE6FA4F92F3E70');
        $this->addSql('ALTER TABLE county DROP FOREIGN KEY FK_58E2FF25F92F3E70');
        $this->addSql('ALTER TABLE state DROP FOREIGN KEY FK_A393D2FBF92F3E70');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B023485E73F45');
        $this->addSql('ALTER TABLE county_translation DROP FOREIGN KEY FK_8AE0F6F185E73F45');
        $this->addSql('ALTER TABLE county DROP FOREIGN KEY FK_58E2FF255D83CC1');
        $this->addSql('ALTER TABLE state_translation DROP FOREIGN KEY FK_7F4D61325D83CC1');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE city_translation');
        $this->addSql('DROP TABLE city_zip_code');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE country_translation');
        $this->addSql('DROP TABLE county');
        $this->addSql('DROP TABLE county_translation');
        $this->addSql('DROP TABLE state');
        $this->addSql('DROP TABLE state_translation');
        $this->addSql('ALTER TABLE locale CHANGE id id BINARY(16) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE meldung CHANGE bbk_identifier bbk_identifier VARCHAR(63) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE more_information_link more_information_link VARCHAR(511) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE severity severity INT DEFAULT NULL, CHANGE meldende_stelle meldende_stelle VARCHAR(127) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}

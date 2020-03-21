<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321190912 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE county_meldung (county_id BINARY(16) NOT NULL, meldung_id INT NOT NULL, INDEX IDX_B927773F85E73F45 (county_id), INDEX IDX_B927773F6BC67899 (meldung_id), PRIMARY KEY(county_id, meldung_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE county_meldung ADD CONSTRAINT FK_B927773F85E73F45 FOREIGN KEY (county_id) REFERENCES county (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE county_meldung ADD CONSTRAINT FK_B927773F6BC67899 FOREIGN KEY (meldung_id) REFERENCES meldung (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE link_kreise_meldungen');
        $this->addSql('ALTER TABLE meldung DROP meldung_id');
        $this->addSql('ALTER TABLE meldungsreferenz ADD origin_id INT NOT NULL, ADD target_id INT NOT NULL, DROP origin, DROP target');
        $this->addSql('ALTER TABLE meldungsreferenz ADD CONSTRAINT FK_FD3524EE56A273CC FOREIGN KEY (origin_id) REFERENCES meldung (id)');
        $this->addSql('ALTER TABLE meldungsreferenz ADD CONSTRAINT FK_FD3524EE158E0B66 FOREIGN KEY (target_id) REFERENCES meldung (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD3524EE56A273CC ON meldungsreferenz (origin_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD3524EE158E0B66 ON meldungsreferenz (target_id)');
        $this->addSql('ALTER TABLE kategorie DROP category_id');
        $this->addSql('ALTER TABLE link_meldungen_kategorien ADD meldung_id_id INT NOT NULL, ADD kategorie_id_id INT NOT NULL, DROP meldung_id, DROP kategorie_id');
        $this->addSql('ALTER TABLE link_meldungen_kategorien ADD CONSTRAINT FK_21415A64162D25F FOREIGN KEY (meldung_id_id) REFERENCES meldung (id)');
        $this->addSql('ALTER TABLE link_meldungen_kategorien ADD CONSTRAINT FK_21415A6445B5BF00 FOREIGN KEY (kategorie_id_id) REFERENCES kategorie (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_21415A64162D25F ON link_meldungen_kategorien (meldung_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_21415A6445B5BF00 ON link_meldungen_kategorien (kategorie_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE link_kreise_meldungen (id INT AUTO_INCREMENT NOT NULL, kreisnummer INT NOT NULL, meldung_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE county_meldung');
        $this->addSql('ALTER TABLE kategorie ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE link_meldungen_kategorien DROP FOREIGN KEY FK_21415A64162D25F');
        $this->addSql('ALTER TABLE link_meldungen_kategorien DROP FOREIGN KEY FK_21415A6445B5BF00');
        $this->addSql('DROP INDEX UNIQ_21415A64162D25F ON link_meldungen_kategorien');
        $this->addSql('DROP INDEX UNIQ_21415A6445B5BF00 ON link_meldungen_kategorien');
        $this->addSql('ALTER TABLE link_meldungen_kategorien ADD meldung_id INT NOT NULL, ADD kategorie_id INT NOT NULL, DROP meldung_id_id, DROP kategorie_id_id');
        $this->addSql('ALTER TABLE meldung ADD meldung_id INT NOT NULL');
        $this->addSql('ALTER TABLE meldungsreferenz DROP FOREIGN KEY FK_FD3524EE56A273CC');
        $this->addSql('ALTER TABLE meldungsreferenz DROP FOREIGN KEY FK_FD3524EE158E0B66');
        $this->addSql('DROP INDEX UNIQ_FD3524EE56A273CC ON meldungsreferenz');
        $this->addSql('DROP INDEX UNIQ_FD3524EE158E0B66 ON meldungsreferenz');
        $this->addSql('ALTER TABLE meldungsreferenz ADD origin INT NOT NULL, ADD target INT NOT NULL, DROP origin_id, DROP target_id');
    }
}

<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322120348 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE meldung_keyword (id BINARY(16) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meldung_keyword_meldung (meldung_keyword_id BINARY(16) NOT NULL, meldung_id INT NOT NULL, INDEX IDX_1ABE38CD7D93873C (meldung_keyword_id), INDEX IDX_1ABE38CD6BC67899 (meldung_id), PRIMARY KEY(meldung_keyword_id, meldung_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meldung_keyword_meldung ADD CONSTRAINT FK_1ABE38CD7D93873C FOREIGN KEY (meldung_keyword_id) REFERENCES meldung_keyword (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meldung_keyword_meldung ADD CONSTRAINT FK_1ABE38CD6BC67899 FOREIGN KEY (meldung_id) REFERENCES meldung (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE meldung_keyword_meldung DROP FOREIGN KEY FK_1ABE38CD7D93873C');
        $this->addSql('DROP TABLE meldung_keyword');
        $this->addSql('DROP TABLE meldung_keyword_meldung');
    }
}

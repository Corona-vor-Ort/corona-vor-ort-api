<?php declare(strict_types=1);

namespace DoctrineMigrations;

use App\Defaults\DatabaseIds;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ramsey\Uuid\Uuid;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321153200 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add name to country germany';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->connection->insert('country_translation', [
            'id' => Uuid::uuid4()->getBytes(),
            'country_id' => Uuid::fromString(DatabaseIds::COUNTRY_DE)->getBytes(),
            'locale_id' => Uuid::fromString(DatabaseIds::LOCALE_DE_DE)->getBytes(),
            'name' => 'Deutschland',
            'created_at' => date_create()->setDate(2020, 3, 21)->setTime(15, 21)
        ], [
            'country_id' => 'binary',
            'locale_id' => 'binary',
            'created_at' => 'datetime',
        ]);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->connection->delete('country_translation', [
            'country_id' => Uuid::fromString(DatabaseIds::COUNTRY_DE)->getBytes(),
            'locale_id' => Uuid::fromString(DatabaseIds::LOCALE_DE_DE)->getBytes(),
        ], [
            'id' => 'binary',
        ]);
    }
}

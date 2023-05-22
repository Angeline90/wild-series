<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515153814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode DROP INDEX UNIQ_DDAA1CDA68756988, ADD INDEX IDX_DDAA1CDA4EC001D1 (season_id)');
        $this->addSql('ALTER TABLE season DROP INDEX UNIQ_F0E45BA9E12DEDA1, ADD INDEX IDX_F0E45BA93EB8070A (program_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode DROP INDEX IDX_DDAA1CDA4EC001D1, ADD UNIQUE INDEX UNIQ_DDAA1CDA68756988 (season_id)');
        $this->addSql('ALTER TABLE season DROP INDEX IDX_F0E45BA93EB8070A, ADD UNIQUE INDEX UNIQ_F0E45BA9E12DEDA1 (program_id)');
    }
}

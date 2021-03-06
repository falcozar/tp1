<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200917133015 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE menus ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME DEFAULT NULL');
        //$this->addSql('ALTER TABLE pages CHANGE slug slug VARCHAR(128) NOT NULL');
        //$this->addSql('CREATE UNIQUE INDEX UNIQ_2074E575989D9B62 ON pages (slug)');
        //$this->addSql('ALTER TABLE metas CHANGE slug slug VARCHAR(128) NOT NULL');
        //$this->addSql('CREATE UNIQUE INDEX UNIQ_4D6AF93C989D9B62 ON metas (slug)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE menus DROP created_at, DROP updated_at');
        $this->addSql('DROP INDEX UNIQ_4D6AF93C989D9B62 ON metas');
        $this->addSql('ALTER TABLE metas CHANGE slug slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX UNIQ_2074E575989D9B62 ON pages');
        $this->addSql('ALTER TABLE pages CHANGE slug slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

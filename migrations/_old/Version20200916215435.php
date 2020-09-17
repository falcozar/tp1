<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200916215435 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, etats_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_3AF3466867B3B43D (users_id), INDEX IDX_3AF34668CA7E0C2E (etats_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meta_page (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, etats_id INT NOT NULL, pages_id INT NOT NULL, metas_id INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_87ACC56367B3B43D (users_id), INDEX IDX_87ACC563CA7E0C2E (etats_id), INDEX IDX_87ACC563401ADD27 (pages_id), INDEX IDX_87ACC56323290B3B (metas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menus (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, etats_id INT NOT NULL, categories_id INT DEFAULT NULL, pages_id INT DEFAULT NULL, menu VARCHAR(255) NOT NULL, type SMALLINT NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_727508CF67B3B43D (users_id), INDEX IDX_727508CFCA7E0C2E (etats_id), INDEX IDX_727508CFA21214B7 (categories_id), INDEX IDX_727508CF401ADD27 (pages_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF3466867B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668CA7E0C2E FOREIGN KEY (etats_id) REFERENCES etats (id)');
        $this->addSql('ALTER TABLE meta_page ADD CONSTRAINT FK_87ACC56367B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE meta_page ADD CONSTRAINT FK_87ACC563CA7E0C2E FOREIGN KEY (etats_id) REFERENCES etats (id)');
        $this->addSql('ALTER TABLE meta_page ADD CONSTRAINT FK_87ACC563401ADD27 FOREIGN KEY (pages_id) REFERENCES pages (id)');
        $this->addSql('ALTER TABLE meta_page ADD CONSTRAINT FK_87ACC56323290B3B FOREIGN KEY (metas_id) REFERENCES metas (id)');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT FK_727508CF67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT FK_727508CFCA7E0C2E FOREIGN KEY (etats_id) REFERENCES etats (id)');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT FK_727508CFA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT FK_727508CF401ADD27 FOREIGN KEY (pages_id) REFERENCES pages (id)');
        $this->addSql('ALTER TABLE pages ADD users_id INT NOT NULL, ADD etats_id INT NOT NULL, ADD categories_id INT NOT NULL');
        $this->addSql('ALTER TABLE pages ADD CONSTRAINT FK_2074E57567B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE pages ADD CONSTRAINT FK_2074E575CA7E0C2E FOREIGN KEY (etats_id) REFERENCES etats (id)');
        $this->addSql('ALTER TABLE pages ADD CONSTRAINT FK_2074E575A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_2074E57567B3B43D ON pages (users_id)');
        $this->addSql('CREATE INDEX IDX_2074E575CA7E0C2E ON pages (etats_id)');
        $this->addSql('CREATE INDEX IDX_2074E575A21214B7 ON pages (categories_id)');
        $this->addSql('ALTER TABLE metas ADD meta_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE metas ADD CONSTRAINT FK_4D6AF93C8C379371 FOREIGN KEY (meta_type_id) REFERENCES meta_type (id)');
        $this->addSql('CREATE INDEX IDX_4D6AF93C8C379371 ON metas (meta_type_id)');
        $this->addSql('ALTER TABLE commentaires ADD etats_id INT NOT NULL, ADD pages_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C4CA7E0C2E FOREIGN KEY (etats_id) REFERENCES etats (id)');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C4401ADD27 FOREIGN KEY (pages_id) REFERENCES pages (id)');
        $this->addSql('CREATE INDEX IDX_D9BEC0C4CA7E0C2E ON commentaires (etats_id)');
        $this->addSql('CREATE INDEX IDX_D9BEC0C4401ADD27 ON commentaires (pages_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE menus DROP FOREIGN KEY FK_727508CFA21214B7');
        $this->addSql('ALTER TABLE pages DROP FOREIGN KEY FK_2074E575A21214B7');
        $this->addSql('DROP TABLE menus');
        $this->addSql('DROP TABLE meta_page');
        $this->addSql('DROP TABLE categories');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C4CA7E0C2E');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C4401ADD27');
        $this->addSql('DROP INDEX IDX_D9BEC0C4CA7E0C2E ON commentaires');
        $this->addSql('DROP INDEX IDX_D9BEC0C4401ADD27 ON commentaires');
        $this->addSql('ALTER TABLE commentaires DROP etats_id, DROP pages_id');
        $this->addSql('ALTER TABLE metas DROP FOREIGN KEY FK_4D6AF93C8C379371');
        $this->addSql('DROP INDEX IDX_4D6AF93C8C379371 ON metas');
        $this->addSql('ALTER TABLE metas DROP meta_type_id');
        $this->addSql('ALTER TABLE pages DROP FOREIGN KEY FK_2074E57567B3B43D');
        $this->addSql('ALTER TABLE pages DROP FOREIGN KEY FK_2074E575CA7E0C2E');
        $this->addSql('DROP INDEX IDX_2074E57567B3B43D ON pages');
        $this->addSql('DROP INDEX IDX_2074E575CA7E0C2E ON pages');
        $this->addSql('DROP INDEX IDX_2074E575A21214B7 ON pages');
        $this->addSql('ALTER TABLE pages DROP users_id, DROP etats_id, DROP categories_id');
    }
}

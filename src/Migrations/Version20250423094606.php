<?php

declare(strict_types=1);

namespace Aality\SyliusCMSBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250423094606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE aality_sylius_cms_page (id INT AUTO_INCREMENT NOT NULL, channel_id INT DEFAULT NULL, slug VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, metaDescription LONGTEXT DEFAULT NULL, content LONGTEXT NOT NULL, INDEX IDX_325BA06F72F5A1AA (channel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE aality_sylius_cms_page ADD CONSTRAINT FK_325BA06F72F5A1AA FOREIGN KEY (channel_id) REFERENCES sylius_channel (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE aality_sylius_cms_page DROP FOREIGN KEY FK_325BA06F72F5A1AA
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE aality_sylius_cms_page
        SQL);
    }
}

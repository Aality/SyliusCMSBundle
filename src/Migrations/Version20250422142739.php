<?php

declare(strict_types=1);

namespace Aality\SyliusCMSBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250422142739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {

        $this->addSql(<<<'SQL'
            CREATE TABLE Page (id INT AUTO_INCREMENT NOT NULL, channel_id INT DEFAULT NULL, slug VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, metaDescription LONGTEXT DEFAULT NULL, content LONGTEXT NOT NULL, INDEX IDX_B438191E72F5A1AA (channel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE Page ADD CONSTRAINT FK_B438191E72F5A1AA FOREIGN KEY (channel_id) REFERENCES sylius_channel (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE Page DROP FOREIGN KEY FK_B438191E72F5A1AA
        SQL);

        $this->addSql(<<<'SQL'
            DROP TABLE Page
        SQL);
    }
}

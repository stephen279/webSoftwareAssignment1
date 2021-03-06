<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200507114452 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE login CHANGE status status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE orders ADD status VARCHAR(255) NOT NULL, CHANGE productsordered productsordered VARCHAR(255) NOT NULL, CHANGE totalcost totalcost VARCHAR(255) NOT NULL, CHANGE username username VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE login CHANGE status status VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE orders DROP status, CHANGE productsordered productsordered VARCHAR(255) DEFAULT \'\' NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE totalcost totalcost VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE username username VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci');
    }
}

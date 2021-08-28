<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210827181028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pets ADD client_id_relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pets ADD CONSTRAINT FK_8638EA3FB871E23 FOREIGN KEY (client_id_relation_id) REFERENCES clients (id)');
        $this->addSql('CREATE INDEX IDX_8638EA3FB871E23 ON pets (client_id_relation_id)');
        $this->addSql('ALTER TABLE user CHANGE role role INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pets DROP FOREIGN KEY FK_8638EA3FB871E23');
        $this->addSql('DROP INDEX IDX_8638EA3FB871E23 ON pets');
        $this->addSql('ALTER TABLE pets DROP client_id_relation_id');
        $this->addSql('ALTER TABLE user CHANGE role role INT DEFAULT NULL');
    }
}

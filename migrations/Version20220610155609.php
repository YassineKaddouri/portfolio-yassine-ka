<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220610155609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE education ADD no_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED21A65C546 FOREIGN KEY (no_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_DB0A5ED21A65C546 ON education (no_id)');
        $this->addSql('ALTER TABLE person ADD educations VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED21A65C546');
        $this->addSql('DROP INDEX IDX_DB0A5ED21A65C546 ON education');
        $this->addSql('ALTER TABLE education DROP no_id');
        $this->addSql('ALTER TABLE person DROP educations');
    }
}

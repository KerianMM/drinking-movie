<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190510065819 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE participer (id INT AUTO_INCREMENT NOT NULL, session_id INT NOT NULL, participant_id INT NOT NULL, INDEX IDX_EDBE16F8613FECDF (session_id), INDEX IDX_EDBE16F89D1C3019 (participant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_EDBE16F8613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_EDBE16F89D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE participer');
    }
}

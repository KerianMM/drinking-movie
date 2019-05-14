<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190514090328 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D79F6B11E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rule (id INT AUTO_INCREMENT NOT NULL, movie_id INT NOT NULL, description LONGTEXT NOT NULL, titre VARCHAR(150) NOT NULL, INDEX IDX_46D8ACCC8F93B6FC (movie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session_participant (session_id INT NOT NULL, participant_id INT NOT NULL, INDEX IDX_2BC67566613FECDF (session_id), INDEX IDX_2BC675669D1C3019 (participant_id), PRIMARY KEY(session_id, participant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session_movie (session_id INT NOT NULL, movie_id INT NOT NULL, INDEX IDX_C6234AB9613FECDF (session_id), INDEX IDX_C6234AB98F93B6FC (movie_id), PRIMARY KEY(session_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rule ADD CONSTRAINT FK_46D8ACCC8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE session_participant ADD CONSTRAINT FK_2BC67566613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_participant ADD CONSTRAINT FK_2BC675669D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_movie ADD CONSTRAINT FK_C6234AB9613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_movie ADD CONSTRAINT FK_C6234AB98F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC5059D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id)');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505744E0351 FOREIGN KEY (rule_id) REFERENCES rule (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE session_participant DROP FOREIGN KEY FK_2BC675669D1C3019');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC5059D1C3019');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC505744E0351');
        $this->addSql('ALTER TABLE session_participant DROP FOREIGN KEY FK_2BC67566613FECDF');
        $this->addSql('ALTER TABLE session_movie DROP FOREIGN KEY FK_C6234AB9613FECDF');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC505613FECDF');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE rule');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE session_participant');
        $this->addSql('DROP TABLE session_movie');
    }
}

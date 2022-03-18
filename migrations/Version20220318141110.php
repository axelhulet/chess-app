<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220318141110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, last_name VARCHAR(50) NOT NULL, first_name VARCHAR(50) NOT NULL, birth_date DATE NOT NULL, elo INT DEFAULT NULL, gender VARCHAR(255) NOT NULL, picture VARCHAR(50) DEFAULT NULL, active TINYINT(1) DEFAULT 1 NOT NULL, UNIQUE INDEX UNIQ_98197A65F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_role (player_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_F573DA5999E6F5DF (player_id), INDEX IDX_F573DA59D60322AC (role_id), PRIMARY KEY(player_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_tournament (player_id INT NOT NULL, tournament_id INT NOT NULL, INDEX IDX_E2FA3CE499E6F5DF (player_id), INDEX IDX_E2FA3CE433D1A3E7 (tournament_id), PRIMARY KEY(player_id, tournament_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_57698A6AEA750E8 (label), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, city VARCHAR(50) NOT NULL, date DATE NOT NULL, classed TINYINT(1) DEFAULT 1 NOT NULL, elo_min INT DEFAULT NULL, elo_max INT DEFAULT NULL, age_category VARCHAR(255) NOT NULL, gender_category VARCHAR(255) NOT NULL, type_category VARCHAR(255) NOT NULL, rounds_number INT NOT NULL, min_players INT DEFAULT NULL, max_players INT DEFAULT NULL, active TINYINT(1) DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE player_role ADD CONSTRAINT FK_F573DA5999E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_role ADD CONSTRAINT FK_F573DA59D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_tournament ADD CONSTRAINT FK_E2FA3CE499E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_tournament ADD CONSTRAINT FK_E2FA3CE433D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_role DROP FOREIGN KEY FK_F573DA5999E6F5DF');
        $this->addSql('ALTER TABLE player_tournament DROP FOREIGN KEY FK_E2FA3CE499E6F5DF');
        $this->addSql('ALTER TABLE player_role DROP FOREIGN KEY FK_F573DA59D60322AC');
        $this->addSql('ALTER TABLE player_tournament DROP FOREIGN KEY FK_E2FA3CE433D1A3E7');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_role');
        $this->addSql('DROP TABLE player_tournament');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

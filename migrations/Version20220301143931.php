<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301143931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, movie_id INT DEFAULT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, rating DOUBLE PRECISION NOT NULL, reactions LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', watched_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_794381C68F93B6FC (movie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C68F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE casting DROP FOREIGN KEY FK_casting_movie');
        $this->addSql('ALTER TABLE casting DROP FOREIGN KEY FK_casting_person');
        $this->addSql('ALTER TABLE casting CHANGE movie_id movie_id INT NOT NULL');
        $this->addSql('DROP INDEX idx_casting_person ON casting');
        $this->addSql('CREATE INDEX IDX_D11BBA50217BBB47 ON casting (person_id)');
        $this->addSql('DROP INDEX idx_casting_movie ON casting');
        $this->addSql('CREATE INDEX IDX_D11BBA508F93B6FC ON casting (movie_id)');
        $this->addSql('ALTER TABLE casting ADD CONSTRAINT FK_casting_movie FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE casting ADD CONSTRAINT FK_casting_person FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE genre_movie DROP FOREIGN KEY FK_genre_id');
        $this->addSql('ALTER TABLE genre_movie DROP FOREIGN KEY FK_movie_id');
        $this->addSql('DROP INDEX idx_genre_id ON genre_movie');
        $this->addSql('CREATE INDEX IDX_A058EDAA4296D31F ON genre_movie (genre_id)');
        $this->addSql('DROP INDEX idx_movie_id ON genre_movie');
        $this->addSql('CREATE INDEX IDX_A058EDAA8F93B6FC ON genre_movie (movie_id)');
        $this->addSql('ALTER TABLE genre_movie ADD CONSTRAINT FK_genre_id FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_movie ADD CONSTRAINT FK_movie_id FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE review');
        $this->addSql('ALTER TABLE casting DROP FOREIGN KEY FK_D11BBA50217BBB47');
        $this->addSql('ALTER TABLE casting DROP FOREIGN KEY FK_D11BBA508F93B6FC');
        $this->addSql('ALTER TABLE casting CHANGE movie_id movie_id INT DEFAULT NULL, CHANGE role role VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX idx_d11bba508f93b6fc ON casting');
        $this->addSql('CREATE INDEX IDX_casting_movie ON casting (movie_id)');
        $this->addSql('DROP INDEX idx_d11bba50217bbb47 ON casting');
        $this->addSql('CREATE INDEX IDX_casting_person ON casting (person_id)');
        $this->addSql('ALTER TABLE casting ADD CONSTRAINT FK_D11BBA50217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE casting ADD CONSTRAINT FK_D11BBA508F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE genre CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE genre_movie DROP FOREIGN KEY FK_A058EDAA4296D31F');
        $this->addSql('ALTER TABLE genre_movie DROP FOREIGN KEY FK_A058EDAA8F93B6FC');
        $this->addSql('DROP INDEX idx_a058edaa4296d31f ON genre_movie');
        $this->addSql('CREATE INDEX IDX_genre_id ON genre_movie (genre_id)');
        $this->addSql('DROP INDEX idx_a058edaa8f93b6fc ON genre_movie');
        $this->addSql('CREATE INDEX IDX_movie_id ON genre_movie (movie_id)');
        $this->addSql('ALTER TABLE genre_movie ADD CONSTRAINT FK_A058EDAA4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_movie ADD CONSTRAINT FK_A058EDAA8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE movie CHANGE type type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE summary summary VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE synopsis synopsis LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE poster poster VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE person CHANGE first_name first_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

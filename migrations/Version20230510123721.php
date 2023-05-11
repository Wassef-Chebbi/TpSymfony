<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510123721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bibliotheque ADD nbetage INT NOT NULL, ADD nbrayon INT NOT NULL, DROP nb_etage, DROP nb_rayon, CHANGE domaine domaine VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE livre ADD numetage INT NOT NULL, ADD numrayon INT NOT NULL, DROP num_etage, DROP num_rayon, CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE auteur auteur VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bibliotheque ADD nb_etage INT NOT NULL, ADD nb_rayon INT NOT NULL, DROP nbetage, DROP nbrayon, CHANGE domaine domaine VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE livre ADD num_etage INT NOT NULL, ADD num_rayon INT NOT NULL, DROP numetage, DROP numrayon, CHANGE titre titre VARCHAR(50) NOT NULL, CHANGE auteur auteur VARCHAR(50) NOT NULL');
    }
}

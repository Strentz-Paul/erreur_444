<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220728143321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add compta tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bilan (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT NOT NULL, annee VARCHAR(255) NOT NULL, INDEX IDX_F4DF4F44A4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis (id INT AUTO_INCREMENT NOT NULL, bilan_id INT NOT NULL, statut VARCHAR(255) NOT NULL, completed TINYINT(1) NOT NULL, INDEX IDX_8B27C52B705F7C57 (bilan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, date_debut DATETIME DEFAULT NULL, date_fin DATETIME DEFAULT NULL, statut_juridique VARCHAR(255) NOT NULL, is_externe TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, devis_id INT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME DEFAULT NULL, tjm DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_9067F23C41DEFADA (devis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, type VARCHAR(255) NOT NULL, valeur DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement_mission (paiement_id INT NOT NULL, mission_id INT NOT NULL, INDEX IDX_8D5D42CD2A4C4478 (paiement_id), INDEX IDX_8D5D42CDBE6CAE90 (mission_id), PRIMARY KEY(paiement_id, mission_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement_bilan (paiement_id INT NOT NULL, bilan_id INT NOT NULL, INDEX IDX_5C47AA5B2A4C4478 (paiement_id), INDEX IDX_5C47AA5B705F7C57 (bilan_id), PRIMARY KEY(paiement_id, bilan_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_entreprise (personne_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_F710B264A21BD112 (personne_id), INDEX IDX_F710B264A4AEAFEA (entreprise_id), PRIMARY KEY(personne_id, entreprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bilan ADD CONSTRAINT FK_F4DF4F44A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B705F7C57 FOREIGN KEY (bilan_id) REFERENCES bilan (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('ALTER TABLE paiement_mission ADD CONSTRAINT FK_8D5D42CD2A4C4478 FOREIGN KEY (paiement_id) REFERENCES paiement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paiement_mission ADD CONSTRAINT FK_8D5D42CDBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paiement_bilan ADD CONSTRAINT FK_5C47AA5B2A4C4478 FOREIGN KEY (paiement_id) REFERENCES paiement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paiement_bilan ADD CONSTRAINT FK_5C47AA5B705F7C57 FOREIGN KEY (bilan_id) REFERENCES bilan (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_entreprise ADD CONSTRAINT FK_F710B264A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_entreprise ADD CONSTRAINT FK_F710B264A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B705F7C57');
        $this->addSql('ALTER TABLE paiement_bilan DROP FOREIGN KEY FK_5C47AA5B705F7C57');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C41DEFADA');
        $this->addSql('ALTER TABLE bilan DROP FOREIGN KEY FK_F4DF4F44A4AEAFEA');
        $this->addSql('ALTER TABLE personne_entreprise DROP FOREIGN KEY FK_F710B264A4AEAFEA');
        $this->addSql('ALTER TABLE paiement_mission DROP FOREIGN KEY FK_8D5D42CDBE6CAE90');
        $this->addSql('ALTER TABLE paiement_mission DROP FOREIGN KEY FK_8D5D42CD2A4C4478');
        $this->addSql('ALTER TABLE paiement_bilan DROP FOREIGN KEY FK_5C47AA5B2A4C4478');
        $this->addSql('ALTER TABLE personne_entreprise DROP FOREIGN KEY FK_F710B264A21BD112');
        $this->addSql('DROP TABLE bilan');
        $this->addSql('DROP TABLE devis');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE paiement_mission');
        $this->addSql('DROP TABLE paiement_bilan');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE personne_entreprise');
    }
}

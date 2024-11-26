<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20241126144405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE subcription_history DROP FOREIGN KEY FK_23BFDB912D5A078E');
        $this->addSql('DROP TABLE subcription_history');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE TABLE subcription_history (id INT AUTO_INCREMENT NOT NULL, subcription_id INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, INDEX IDX_23BFDB912D5A078E (subcription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE subcription_history ADD CONSTRAINT FK_23BFDB912D5A078E FOREIGN KEY (subcription_id) REFERENCES subscription (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20241126143641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE episode DROP duration');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE episode ADD duration TIME NOT NULL');
    }
}

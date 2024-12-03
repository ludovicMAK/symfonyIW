<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20241201205702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'enum mediaType';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media CHANGE mediaType mediaType ENUM(\'Films\', \'Séries\') NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media CHANGE mediaType mediaType VARCHAR(255) NOT NULL');
    }
}

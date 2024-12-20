<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20241102110653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'delte media_type_status column';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media DROP media_type_status');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media ADD media_type_status VARCHAR(255) NOT NULL');
    }
}

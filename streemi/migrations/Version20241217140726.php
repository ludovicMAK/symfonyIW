<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20241217140726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media CHANGE mediaType mediaType VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE playlist CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE playlist_media CHANGE added_at added_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE playlist_subcription CHANGE subcribed_at subcribed_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media CHANGE mediaType mediaType ENUM(\'Films\', \'Séries\') NOT NULL');
        $this->addSql('ALTER TABLE playlist_media CHANGE added_at added_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE playlist CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updated_at updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE playlist_subcription CHANGE subcribed_at subcribed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE `user` DROP roles');
    }
}

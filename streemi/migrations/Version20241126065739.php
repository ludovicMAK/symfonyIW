<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20241126065739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'correction des tables watch_history et subscription_history';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE subscription_history ADD subscription_id INT DEFAULT NULL, ADD start_date DATETIME NOT NULL, ADD end_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D09A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id)');
        $this->addSql('CREATE INDEX IDX_54AF90D09A1887DC ON subscription_history (subscription_id)');
        $this->addSql('ALTER TABLE watch_history ADD viewer_id INT NOT NULL, ADD media_id INT NOT NULL');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD86C59C752 FOREIGN KEY (viewer_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD8EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DE44EFD86C59C752 ON watch_history (viewer_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DE44EFD8EA9FDD75 ON watch_history (media_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD86C59C752');
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD8EA9FDD75');
        $this->addSql('DROP INDEX UNIQ_DE44EFD86C59C752 ON watch_history');
        $this->addSql('DROP INDEX UNIQ_DE44EFD8EA9FDD75 ON watch_history');
        $this->addSql('ALTER TABLE watch_history DROP viewer_id, DROP media_id');
        $this->addSql('ALTER TABLE subscription_history DROP FOREIGN KEY FK_54AF90D09A1887DC');
        $this->addSql('DROP INDEX IDX_54AF90D09A1887DC ON subscription_history');
        $this->addSql('ALTER TABLE subscription_history DROP subscription_id, DROP start_date, DROP end_date');
    }
}

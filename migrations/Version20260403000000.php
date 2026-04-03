<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260403000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Increase Actualite.titre column length from 255 to 512';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE actualite CHANGE titre titre VARCHAR(512) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE actualite CHANGE titre titre VARCHAR(255) NOT NULL');
    }
}

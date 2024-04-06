<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class VersionInit extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql(sql: 'CREATE TABLE users
                            (
                                id uuid PRIMARY KEY DEFAULT uuid_generate_v4(),
                                email VARCHAR UNIQUE NOT NULL,
                                name VARCHAR NOT NULL,
                                age INTEGER NOT NULL,
                                sex CHARACTER(1) NOT NULL,
                                birthday DATE NOT NULL,
                                phone VARCHAR UNIQUE NOT NULL,
                                created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
                                updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp
                            )'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE users');
    }
}

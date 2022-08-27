<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220827154953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Todo table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE todo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE todo (id INT NOT NULL, status VARCHAR(10) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE todo_id_seq CASCADE');
        $this->addSql('DROP TABLE todo');
    }
}

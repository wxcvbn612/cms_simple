<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260401213000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add services predefined block with three cards to landing page content';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE landing_page_content
            ADD services_enabled TINYINT(1) NOT NULL DEFAULT 0,
            ADD services_title VARCHAR(255) NOT NULL DEFAULT 'Nos services',
            ADD services_subtitle VARCHAR(255) DEFAULT NULL,
            ADD services_bg VARCHAR(7) NOT NULL DEFAULT '#ffffff',
            ADD service_card1_title VARCHAR(255) NOT NULL DEFAULT 'Service 1',
            ADD service_card1_description LONGTEXT DEFAULT NULL,
            ADD service_card1_image VARCHAR(255) DEFAULT NULL,
            ADD service_card2_title VARCHAR(255) NOT NULL DEFAULT 'Service 2',
            ADD service_card2_description LONGTEXT DEFAULT NULL,
            ADD service_card2_image VARCHAR(255) DEFAULT NULL,
            ADD service_card3_title VARCHAR(255) NOT NULL DEFAULT 'Service 3',
            ADD service_card3_description LONGTEXT DEFAULT NULL,
            ADD service_card3_image VARCHAR(255) DEFAULT NULL");

        $this->addSql("UPDATE landing_page_content
            SET section_order = CASE
                WHEN section_order LIKE '%services%' THEN section_order
                WHEN section_order IS NULL OR section_order = '' THEN 'hero,about,actualites,services,social,faq,testimonials,gallery,partners,cta,contact'
                ELSE REPLACE(section_order, 'actualites,', 'actualites,services,')
            END");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE landing_page_content
            DROP services_enabled,
            DROP services_title,
            DROP services_subtitle,
            DROP services_bg,
            DROP service_card1_title,
            DROP service_card1_description,
            DROP service_card1_image,
            DROP service_card2_title,
            DROP service_card2_description,
            DROP service_card2_image,
            DROP service_card3_title,
            DROP service_card3_description,
            DROP service_card3_image');

        $this->addSql("UPDATE landing_page_content
            SET section_order = REPLACE(section_order, ',services', '')");
    }
}

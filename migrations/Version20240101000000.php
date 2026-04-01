<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240101000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create initial schema: actualite, site_settings, landing_page_content, contact_message';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE actualite (
            id INT AUTO_INCREMENT NOT NULL,
            titre VARCHAR(255) NOT NULL,
            contenu LONGTEXT NOT NULL,
            image VARCHAR(255) DEFAULT NULL,
            date_publication DATETIME NOT NULL,
            is_published TINYINT(1) NOT NULL,
            created_at DATETIME NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE site_settings (
            id INT AUTO_INCREMENT NOT NULL,
            site_name VARCHAR(255) NOT NULL,
            site_tagline VARCHAR(255) DEFAULT NULL,
            logo_filename VARCHAR(255) DEFAULT NULL,
            favicon_filename VARCHAR(255) DEFAULT NULL,
            phone VARCHAR(50) DEFAULT NULL,
            email VARCHAR(255) DEFAULT NULL,
            admin_email VARCHAR(255) NOT NULL,
            address VARCHAR(500) DEFAULT NULL,
            default_locale VARCHAR(5) NOT NULL,
            facebook_url VARCHAR(255) DEFAULT NULL,
            instagram_url VARCHAR(255) DEFAULT NULL,
            whatsapp VARCHAR(50) DEFAULT NULL,
            footer_text VARCHAR(500) DEFAULT NULL,
            updated_at DATETIME NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE landing_page_content (
            id INT AUTO_INCREMENT NOT NULL,
            color_primary VARCHAR(7) NOT NULL,
            color_secondary VARCHAR(7) NOT NULL,
            color_background VARCHAR(7) NOT NULL,
            color_text VARCHAR(7) NOT NULL,
            color_navbar_bg VARCHAR(7) NOT NULL,
            color_navbar_text VARCHAR(7) NOT NULL,
            color_footer_bg VARCHAR(7) NOT NULL,
            color_footer_text VARCHAR(7) NOT NULL,
            font_body VARCHAR(100) NOT NULL,
            font_heading VARCHAR(100) NOT NULL,
            font_size_base VARCHAR(10) NOT NULL,
            hero_title VARCHAR(255) NOT NULL,
            hero_subtitle VARCHAR(500) DEFAULT NULL,
            hero_background_image VARCHAR(255) DEFAULT NULL,
            hero_background_color VARCHAR(7) DEFAULT NULL,
            hero_text_color VARCHAR(7) NOT NULL,
            hero_button_text VARCHAR(100) NOT NULL,
            hero_button_color VARCHAR(7) NOT NULL,
            hero_button_text_color VARCHAR(7) NOT NULL,
            actualites_section_title VARCHAR(255) NOT NULL,
            actualites_section_subtitle VARCHAR(255) DEFAULT NULL,
            actualites_section_bg VARCHAR(7) NOT NULL,
            contact_section_title VARCHAR(255) NOT NULL,
            contact_section_subtitle VARCHAR(255) DEFAULT NULL,
            contact_section_bg VARCHAR(7) NOT NULL,
            about_enabled TINYINT(1) NOT NULL,
            about_title VARCHAR(255) DEFAULT NULL,
            about_text LONGTEXT DEFAULT NULL,
            about_image VARCHAR(255) DEFAULT NULL,
            updated_at DATETIME NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE contact_message (
            id INT AUTO_INCREMENT NOT NULL,
            nom VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            telephone VARCHAR(50) DEFAULT NULL,
            message LONGTEXT NOT NULL,
            is_read TINYINT(1) NOT NULL,
            created_at DATETIME NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE actualite');
        $this->addSql('DROP TABLE site_settings');
        $this->addSql('DROP TABLE landing_page_content');
        $this->addSql('DROP TABLE contact_message');
    }
}

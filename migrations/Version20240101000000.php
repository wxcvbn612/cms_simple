<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Full initial schema — includes all fields as of current entity state.
 * Run on fresh installs.
 */
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
            x_url VARCHAR(255) DEFAULT NULL,
            linkedin_url VARCHAR(255) DEFAULT NULL,
            youtube_url VARCHAR(255) DEFAULT NULL,
            tiktok_url VARCHAR(255) DEFAULT NULL,
            whatsapp VARCHAR(50) DEFAULT NULL,
            footer_text VARCHAR(500) DEFAULT NULL,
            show_social_in_navbar TINYINT(1) NOT NULL DEFAULT 0,
            show_social_in_footer TINYINT(1) NOT NULL DEFAULT 1,
            show_social_in_landing_block TINYINT(1) NOT NULL DEFAULT 0,
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
            about_enabled TINYINT(1) NOT NULL DEFAULT 0,
            about_title VARCHAR(255) DEFAULT NULL,
            about_text LONGTEXT DEFAULT NULL,
            about_image VARCHAR(255) DEFAULT NULL,
            section_order VARCHAR(500) NOT NULL,
            social_block_enabled TINYINT(1) NOT NULL DEFAULT 0,
            social_block_title VARCHAR(255) NOT NULL,
            social_block_subtitle VARCHAR(255) DEFAULT NULL,
            social_block_bg VARCHAR(7) NOT NULL,
            testimonials_enabled TINYINT(1) NOT NULL DEFAULT 0,
            testimonials_title VARCHAR(255) NOT NULL,
            testimonials_subtitle VARCHAR(255) DEFAULT NULL,
            testimonials_bg VARCHAR(7) NOT NULL,
            faq_enabled TINYINT(1) NOT NULL DEFAULT 0,
            faq_title VARCHAR(255) NOT NULL,
            faq_subtitle VARCHAR(255) DEFAULT NULL,
            faq_bg VARCHAR(7) NOT NULL,
            gallery_enabled TINYINT(1) NOT NULL DEFAULT 0,
            gallery_title VARCHAR(255) NOT NULL,
            gallery_subtitle VARCHAR(255) DEFAULT NULL,
            gallery_bg VARCHAR(7) NOT NULL,
            partners_enabled TINYINT(1) NOT NULL DEFAULT 0,
            partners_title VARCHAR(255) NOT NULL,
            partners_subtitle VARCHAR(255) DEFAULT NULL,
            partners_bg VARCHAR(7) NOT NULL,
            services_enabled TINYINT(1) NOT NULL DEFAULT 0,
            services_title VARCHAR(255) NOT NULL,
            services_subtitle VARCHAR(255) DEFAULT NULL,
            services_bg VARCHAR(7) NOT NULL,
            service_card1_title VARCHAR(255) NOT NULL,
            service_card1_description LONGTEXT DEFAULT NULL,
            service_card1_image VARCHAR(255) DEFAULT NULL,
            service_card2_title VARCHAR(255) NOT NULL,
            service_card2_description LONGTEXT DEFAULT NULL,
            service_card2_image VARCHAR(255) DEFAULT NULL,
            service_card3_title VARCHAR(255) NOT NULL,
            service_card3_description LONGTEXT DEFAULT NULL,
            service_card3_image VARCHAR(255) DEFAULT NULL,
            faq_q1 VARCHAR(255) NOT NULL DEFAULT \'Question 1 ?\',
            faq_a1 LONGTEXT DEFAULT NULL,
            faq_q2 VARCHAR(255) NOT NULL DEFAULT \'Question 2 ?\',
            faq_a2 LONGTEXT DEFAULT NULL,
            faq_q3 VARCHAR(255) NOT NULL DEFAULT \'Question 3 ?\',
            faq_a3 LONGTEXT DEFAULT NULL,
            testimonial1_text LONGTEXT DEFAULT NULL,
            testimonial1_author VARCHAR(100) DEFAULT NULL,
            testimonial1_role VARCHAR(100) DEFAULT NULL,
            testimonial2_text LONGTEXT DEFAULT NULL,
            testimonial2_author VARCHAR(100) DEFAULT NULL,
            testimonial2_role VARCHAR(100) DEFAULT NULL,
            testimonial3_text LONGTEXT DEFAULT NULL,
            testimonial3_author VARCHAR(100) DEFAULT NULL,
            testimonial3_role VARCHAR(100) DEFAULT NULL,
            gallery_image1 VARCHAR(255) DEFAULT NULL,
            gallery_caption1 VARCHAR(150) DEFAULT NULL,
            gallery_image2 VARCHAR(255) DEFAULT NULL,
            gallery_caption2 VARCHAR(150) DEFAULT NULL,
            gallery_image3 VARCHAR(255) DEFAULT NULL,
            gallery_caption3 VARCHAR(150) DEFAULT NULL,
            gallery_image4 VARCHAR(255) DEFAULT NULL,
            gallery_caption4 VARCHAR(150) DEFAULT NULL,
            gallery_image5 VARCHAR(255) DEFAULT NULL,
            gallery_caption5 VARCHAR(150) DEFAULT NULL,
            gallery_image6 VARCHAR(255) DEFAULT NULL,
            gallery_caption6 VARCHAR(150) DEFAULT NULL,
            partner_name1 VARCHAR(150) DEFAULT NULL,
            partner_logo1 VARCHAR(255) DEFAULT NULL,
            partner_name2 VARCHAR(150) DEFAULT NULL,
            partner_logo2 VARCHAR(255) DEFAULT NULL,
            partner_name3 VARCHAR(150) DEFAULT NULL,
            partner_logo3 VARCHAR(255) DEFAULT NULL,
            partner_name4 VARCHAR(150) DEFAULT NULL,
            partner_logo4 VARCHAR(255) DEFAULT NULL,
            partner_name5 VARCHAR(150) DEFAULT NULL,
            partner_logo5 VARCHAR(255) DEFAULT NULL,
            partner_name6 VARCHAR(150) DEFAULT NULL,
            partner_logo6 VARCHAR(255) DEFAULT NULL,
            cta_block_enabled TINYINT(1) NOT NULL DEFAULT 0,
            cta_block_title VARCHAR(255) NOT NULL,
            cta_block_text VARCHAR(500) DEFAULT NULL,
            cta_button_text VARCHAR(100) NOT NULL,
            cta_button_link VARCHAR(255) NOT NULL,
            cta_block_bg VARCHAR(7) NOT NULL,
            cta_text_color VARCHAR(7) NOT NULL,
            updated_at DATETIME NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB ROW_FORMAT=DYNAMIC');

        $this->addSql('CREATE TABLE contact_message (
            id INT AUTO_INCREMENT NOT NULL,
            nom VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            telephone VARCHAR(50) DEFAULT NULL,
            message LONGTEXT NOT NULL,
            is_read TINYINT(1) NOT NULL DEFAULT 0,
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

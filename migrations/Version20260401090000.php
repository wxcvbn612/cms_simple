<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260401090000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add landing blocks ordering/customization and extended social settings';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE site_settings
            ADD x_url VARCHAR(255) DEFAULT NULL,
            ADD linkedin_url VARCHAR(255) DEFAULT NULL,
            ADD youtube_url VARCHAR(255) DEFAULT NULL,
            ADD tiktok_url VARCHAR(255) DEFAULT NULL,
            ADD show_social_in_navbar TINYINT(1) NOT NULL DEFAULT 0,
            ADD show_social_in_footer TINYINT(1) NOT NULL DEFAULT 1,
            ADD show_social_in_landing_block TINYINT(1) NOT NULL DEFAULT 0");

        $this->addSql("ALTER TABLE landing_page_content
            ADD section_order VARCHAR(500) NOT NULL DEFAULT 'hero,about,actualites,social,faq,testimonials,gallery,partners,cta,contact',
            ADD social_block_enabled TINYINT(1) NOT NULL DEFAULT 0,
            ADD social_block_title VARCHAR(255) NOT NULL DEFAULT 'Suivez-nous',
            ADD social_block_subtitle VARCHAR(255) DEFAULT NULL,
            ADD social_block_bg VARCHAR(7) NOT NULL DEFAULT '#f8f9fa',
            ADD testimonials_enabled TINYINT(1) NOT NULL DEFAULT 0,
            ADD testimonials_title VARCHAR(255) NOT NULL DEFAULT 'Temoignages',
            ADD testimonials_subtitle VARCHAR(255) DEFAULT NULL,
            ADD testimonials_bg VARCHAR(7) NOT NULL DEFAULT '#ffffff',
            ADD faq_enabled TINYINT(1) NOT NULL DEFAULT 0,
            ADD faq_title VARCHAR(255) NOT NULL DEFAULT 'Questions frequentes',
            ADD faq_subtitle VARCHAR(255) DEFAULT NULL,
            ADD faq_bg VARCHAR(7) NOT NULL DEFAULT '#f8f9fa',
            ADD gallery_enabled TINYINT(1) NOT NULL DEFAULT 0,
            ADD gallery_title VARCHAR(255) NOT NULL DEFAULT 'Galerie',
            ADD gallery_subtitle VARCHAR(255) DEFAULT NULL,
            ADD gallery_bg VARCHAR(7) NOT NULL DEFAULT '#ffffff',
            ADD partners_enabled TINYINT(1) NOT NULL DEFAULT 0,
            ADD partners_title VARCHAR(255) NOT NULL DEFAULT 'Nos partenaires',
            ADD partners_subtitle VARCHAR(255) DEFAULT NULL,
            ADD partners_bg VARCHAR(7) NOT NULL DEFAULT '#f8f9fa',
            ADD cta_block_enabled TINYINT(1) NOT NULL DEFAULT 0,
            ADD cta_block_title VARCHAR(255) NOT NULL DEFAULT 'Pret a demarrer ?',
            ADD cta_block_text VARCHAR(500) DEFAULT NULL,
            ADD cta_button_text VARCHAR(100) NOT NULL DEFAULT 'Contactez-nous',
            ADD cta_button_link VARCHAR(255) NOT NULL DEFAULT '#contact',
            ADD cta_block_bg VARCHAR(7) NOT NULL DEFAULT '#0d6efd',
            ADD cta_text_color VARCHAR(7) NOT NULL DEFAULT '#ffffff'");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE site_settings
            DROP x_url,
            DROP linkedin_url,
            DROP youtube_url,
            DROP tiktok_url,
            DROP show_social_in_navbar,
            DROP show_social_in_footer,
            DROP show_social_in_landing_block');

        $this->addSql('ALTER TABLE landing_page_content
            DROP section_order,
            DROP social_block_enabled,
            DROP social_block_title,
            DROP social_block_subtitle,
            DROP social_block_bg,
            DROP testimonials_enabled,
            DROP testimonials_title,
            DROP testimonials_subtitle,
            DROP testimonials_bg,
            DROP faq_enabled,
            DROP faq_title,
            DROP faq_subtitle,
            DROP faq_bg,
            DROP gallery_enabled,
            DROP gallery_title,
            DROP gallery_subtitle,
            DROP gallery_bg,
            DROP partners_enabled,
            DROP partners_title,
            DROP partners_subtitle,
            DROP partners_bg,
            DROP cta_block_enabled,
            DROP cta_block_title,
            DROP cta_block_text,
            DROP cta_button_text,
            DROP cta_button_link,
            DROP cta_block_bg,
            DROP cta_text_color');
    }
}

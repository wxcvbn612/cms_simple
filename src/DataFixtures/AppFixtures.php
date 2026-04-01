<?php

namespace App\DataFixtures;

use App\Entity\LandingPageContent;
use App\Entity\SiteSettings;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Creates the singleton rows (id=1) for SiteSettings and LandingPageContent.
 * Run: php bin/console doctrine:fixtures:load
 */
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // ---- SiteSettings (id=1) ----
        $settings = new SiteSettings();
        $settings->setSiteName('Mon Entreprise');
        $settings->setSiteTagline('Votre partenaire de confiance');
        $settings->setPhone('+213 XX XX XX XX');
        $settings->setEmail('contact@monentreprise.dz');
        $settings->setAdminEmail('admin@monentreprise.dz');
        $settings->setAddress('123 Rue Principale, Alger, Algérie');
        $settings->setDefaultLocale('fr');
        $settings->setFooterText('© ' . date('Y') . ' Mon Entreprise. Tous droits réservés.');
        $manager->persist($settings);

        // ---- LandingPageContent (id=1) ----
        $lp = new LandingPageContent();
        $lp->setColorPrimary('#0d6efd');
        $lp->setColorSecondary('#6c757d');
        $lp->setColorBackground('#ffffff');
        $lp->setColorText('#212529');
        $lp->setColorNavbarBg('#ffffff');
        $lp->setColorNavbarText('#212529');
        $lp->setColorFooterBg('#212529');
        $lp->setColorFooterText('#ffffff');
        $lp->setFontBody('Roboto');
        $lp->setFontHeading('Poppins');
        $lp->setFontSizeBase('16px');
        $lp->setHeroTitle('Bienvenue chez Mon Entreprise');
        $lp->setHeroSubtitle('Votre partenaire de confiance pour tous vos besoins');
        $lp->setHeroBackgroundColor('#0d6efd');
        $lp->setHeroTextColor('#ffffff');
        $lp->setHeroButtonText('Contactez-nous');
        $lp->setHeroButtonColor('#ffffff');
        $lp->setHeroButtonTextColor('#0d6efd');
        $lp->setActualitesSectionTitle('Nos Actualités');
        $lp->setActualitesSectionSubtitle('Restez informé de nos dernières nouvelles');
        $lp->setActualitesSectionBg('#f8f9fa');
        $lp->setContactSectionTitle('Contactez-nous');
        $lp->setContactSectionSubtitle('Nous sommes à votre écoute');
        $lp->setContactSectionBg('#ffffff');
        $lp->setAboutEnabled(false);
        $manager->persist($lp);

        $manager->flush();
    }
}

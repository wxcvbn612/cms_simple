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
        $settings->setFacebookUrl('https://facebook.com');
        $settings->setInstagramUrl('https://instagram.com');
        $settings->setShowSocialInFooter(true);
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
        $lp->setSectionOrder('hero,about,actualites,services,social,faq,testimonials,gallery,partners,cta,contact');
        $lp->setServicesEnabled(true);
        $lp->setServicesTitle('Nos services');
        $lp->setServicesSubtitle('Des solutions claires et adaptees a vos besoins');
        $lp->setServicesBg('#ffffff');
        $lp->setServiceCard1Title('Conseil');
        $lp->setServiceCard1Description('Nous analysons votre besoin et proposons la meilleure approche.');
        $lp->setServiceCard2Title('Implementation');
        $lp->setServiceCard2Description('Nous mettons en place des solutions modernes, fiables et evolutives.');
        $lp->setServiceCard3Title('Accompagnement');
        $lp->setServiceCard3Description('Nous restons a vos cotes apres la mise en ligne pour vous aider.');
        $lp->setSocialBlockEnabled(false);
        $lp->setTestimonialsEnabled(false);
        $lp->setFaqEnabled(false);
        $lp->setGalleryEnabled(false);
        $lp->setPartnersEnabled(false);
        $lp->setCtaBlockEnabled(false);

        // FAQ default content
        $lp->setFaqQ1('Quels sont vos horaires d\'ouverture ?');
        $lp->setFaqA1('Nous sommes disponibles du lundi au vendredi, de 8h à 18h. Vous pouvez également nous contacter par email à tout moment.');
        $lp->setFaqQ2('Comment puis-je vous contacter ?');
        $lp->setFaqA2('Utilisez le formulaire de contact sur cette page ou appelez-nous directement. Nous répondons sous 24h.');
        $lp->setFaqQ3('Proposez-vous des devis gratuits ?');
        $lp->setFaqA3('Oui, tous nos devis sont gratuits et sans engagement. Contactez-nous pour décrire votre projet.');

        // Testimonials default content
        $lp->setTestimonial1Text('Un service exceptionnel et une équipe très professionnelle. Je recommande vivement !');
        $lp->setTestimonial1Author('Sarah M.');
        $lp->setTestimonial1Role('Cliente');
        $lp->setTestimonial2Text('Résultats rapides et conformes à nos attentes. Nous travaillons ensemble depuis 2 ans maintenant.');
        $lp->setTestimonial2Author('Karim B.');
        $lp->setTestimonial2Role('Directeur, Entreprise XYZ');
        $lp->setTestimonial3Text('Sérieux, réactif et à l\'écoute. Une collaboration que je renouvelle sans hésitation.');
        $lp->setTestimonial3Author('Nadia A.');
        $lp->setTestimonial3Role('Gérante');
        $manager->persist($lp);

        $manager->flush();
    }
}

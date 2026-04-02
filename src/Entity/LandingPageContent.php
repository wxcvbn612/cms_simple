<?php

namespace App\Entity;

use App\Repository\LandingPageContentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Single-row entity (always id=1). Controls ALL visual/textual customization of the landing page.
 */
#[ORM\Entity(repositoryClass: LandingPageContentRepository::class)]
#[ORM\HasLifecycleCallbacks]
class LandingPageContent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // === COLORS ===

    #[ORM\Column(length: 7)]
    private string $colorPrimary = '#0d6efd';

    #[ORM\Column(length: 7)]
    private string $colorSecondary = '#6c757d';

    #[ORM\Column(length: 7)]
    private string $colorBackground = '#ffffff';

    #[ORM\Column(length: 7)]
    private string $colorText = '#212529';

    #[ORM\Column(length: 7)]
    private string $colorNavbarBg = '#ffffff';

    #[ORM\Column(length: 7)]
    private string $colorNavbarText = '#212529';

    #[ORM\Column(length: 7)]
    private string $colorFooterBg = '#212529';

    #[ORM\Column(length: 7)]
    private string $colorFooterText = '#ffffff';

    // === TYPOGRAPHY ===

    #[ORM\Column(length: 100)]
    private string $fontBody = 'Roboto';

    #[ORM\Column(length: 100)]
    private string $fontHeading = 'Poppins';

    #[ORM\Column(length: 10)]
    private string $fontSizeBase = '16px';

    // === HERO SECTION ===

    #[ORM\Column(length: 255)]
    private string $heroTitle = 'Bienvenue sur notre site';

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $heroSubtitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $heroBackgroundImage = null;

    #[ORM\Column(length: 7, nullable: true)]
    private ?string $heroBackgroundColor = '#0d6efd';

    #[ORM\Column(length: 7)]
    private string $heroTextColor = '#ffffff';

    #[ORM\Column(length: 100)]
    private string $heroButtonText = 'Contactez-nous';

    #[ORM\Column(length: 7)]
    private string $heroButtonColor = '#ffffff';

    #[ORM\Column(length: 7)]
    private string $heroButtonTextColor = '#0d6efd';

    // === ACTUALITÉS SECTION ===

    #[ORM\Column(length: 255)]
    private string $actualitesSectionTitle = 'Nos Actualités';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $actualitesSectionSubtitle = null;

    #[ORM\Column(length: 7)]
    private string $actualitesSectionBg = '#f8f9fa';

    // === CONTACT SECTION ===

    #[ORM\Column(length: 255)]
    private string $contactSectionTitle = 'Contactez-nous';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactSectionSubtitle = null;

    #[ORM\Column(length: 7)]
    private string $contactSectionBg = '#ffffff';

    // === ABOUT SECTION (optional) ===

    #[ORM\Column]
    private bool $aboutEnabled = false;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $aboutTitle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $aboutText = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $aboutImage = null;

    #[ORM\Column(length: 500)]
    private string $sectionOrder = 'hero,about,actualites,services,social,faq,testimonials,gallery,partners,cta,contact';

    #[ORM\Column]
    private bool $socialBlockEnabled = false;

    #[ORM\Column(length: 255)]
    private string $socialBlockTitle = 'Suivez-nous';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $socialBlockSubtitle = null;

    #[ORM\Column(length: 7)]
    private string $socialBlockBg = '#f8f9fa';

    #[ORM\Column]
    private bool $testimonialsEnabled = false;

    #[ORM\Column(length: 255)]
    private string $testimonialsTitle = 'Temoignages';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $testimonialsSubtitle = null;

    #[ORM\Column(length: 7)]
    private string $testimonialsBg = '#ffffff';

    #[ORM\Column]
    private bool $faqEnabled = false;

    #[ORM\Column(length: 255)]
    private string $faqTitle = 'Questions frequentes';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $faqSubtitle = null;

    #[ORM\Column(length: 7)]
    private string $faqBg = '#f8f9fa';

    #[ORM\Column]
    private bool $galleryEnabled = false;

    #[ORM\Column(length: 255)]
    private string $galleryTitle = 'Galerie';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gallerySubtitle = null;

    #[ORM\Column(length: 7)]
    private string $galleryBg = '#ffffff';

    #[ORM\Column]
    private bool $partnersEnabled = false;

    #[ORM\Column(length: 255)]
    private string $partnersTitle = 'Nos partenaires';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $partnersSubtitle = null;

    #[ORM\Column(length: 7)]
    private string $partnersBg = '#f8f9fa';

    #[ORM\Column]
    private bool $servicesEnabled = false;

    #[ORM\Column(length: 255)]
    private string $servicesTitle = 'Nos services';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $servicesSubtitle = null;

    #[ORM\Column(length: 7)]
    private string $servicesBg = '#ffffff';

    #[ORM\Column(length: 255)]
    private string $serviceCard1Title = 'Service 1';

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $serviceCard1Description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $serviceCard1Image = null;

    #[ORM\Column(length: 255)]
    private string $serviceCard2Title = 'Service 2';

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $serviceCard2Description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $serviceCard2Image = null;

    #[ORM\Column(length: 255)]
    private string $serviceCard3Title = 'Service 3';

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $serviceCard3Description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $serviceCard3Image = null;

    #[ORM\Column]
    private bool $ctaBlockEnabled = false;

    #[ORM\Column(length: 255)]
    private string $ctaBlockTitle = 'Pret a demarrer ?';

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $ctaBlockText = null;

    #[ORM\Column(length: 100)]
    private string $ctaButtonText = 'Contactez-nous';

    #[ORM\Column(length: 255)]
    private string $ctaButtonLink = '#contact';

    #[ORM\Column(length: 7)]
    private string $ctaBlockBg = '#0d6efd';

    #[ORM\Column(length: 7)]
    private string $ctaTextColor = '#ffffff';

    // === FAQ CONTENT ===

    #[ORM\Column(length: 255)]
    private string $faqQ1 = 'Question 1 ?';

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $faqA1 = null;

    #[ORM\Column(length: 255)]
    private string $faqQ2 = 'Question 2 ?';

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $faqA2 = null;

    #[ORM\Column(length: 255)]
    private string $faqQ3 = 'Question 3 ?';

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $faqA3 = null;

    // === TESTIMONIALS CONTENT ===

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $testimonial1Text = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $testimonial1Author = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $testimonial1Role = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $testimonial2Text = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $testimonial2Author = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $testimonial2Role = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $testimonial3Text = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $testimonial3Author = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $testimonial3Role = null;

    // === GALLERY CONTENT (6 items: image + caption) ===

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $galleryImage1 = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $galleryCaption1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $galleryImage2 = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $galleryCaption2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $galleryImage3 = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $galleryCaption3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $galleryImage4 = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $galleryCaption4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $galleryImage5 = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $galleryCaption5 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $galleryImage6 = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $galleryCaption6 = null;

    // === PARTNERS CONTENT (6 items: name + logo) ===

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $partnerName1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $partnerLogo1 = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $partnerName2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $partnerLogo2 = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $partnerName3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $partnerLogo3 = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $partnerName4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $partnerLogo4 = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $partnerName5 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $partnerLogo5 = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $partnerName6 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $partnerLogo6 = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updateTimestamp(): void
    {
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int { return $this->id; }

    public function getColorPrimary(): string { return $this->colorPrimary; }
    public function setColorPrimary(string $v): static { $this->colorPrimary = $v; return $this; }

    public function getColorSecondary(): string { return $this->colorSecondary; }
    public function setColorSecondary(string $v): static { $this->colorSecondary = $v; return $this; }

    public function getColorBackground(): string { return $this->colorBackground; }
    public function setColorBackground(string $v): static { $this->colorBackground = $v; return $this; }

    public function getColorText(): string { return $this->colorText; }
    public function setColorText(string $v): static { $this->colorText = $v; return $this; }

    public function getColorNavbarBg(): string { return $this->colorNavbarBg; }
    public function setColorNavbarBg(string $v): static { $this->colorNavbarBg = $v; return $this; }

    public function getColorNavbarText(): string { return $this->colorNavbarText; }
    public function setColorNavbarText(string $v): static { $this->colorNavbarText = $v; return $this; }

    public function getColorFooterBg(): string { return $this->colorFooterBg; }
    public function setColorFooterBg(string $v): static { $this->colorFooterBg = $v; return $this; }

    public function getColorFooterText(): string { return $this->colorFooterText; }
    public function setColorFooterText(string $v): static { $this->colorFooterText = $v; return $this; }

    public function getFontBody(): string { return $this->fontBody; }
    public function setFontBody(string $v): static { $this->fontBody = $v; return $this; }

    public function getFontHeading(): string { return $this->fontHeading; }
    public function setFontHeading(string $v): static { $this->fontHeading = $v; return $this; }

    public function getFontSizeBase(): string { return $this->fontSizeBase; }
    public function setFontSizeBase(string $v): static { $this->fontSizeBase = $v; return $this; }

    public function getHeroTitle(): string { return $this->heroTitle; }
    public function setHeroTitle(string $v): static { $this->heroTitle = $v; return $this; }

    public function getHeroSubtitle(): ?string { return $this->heroSubtitle; }
    public function setHeroSubtitle(?string $v): static { $this->heroSubtitle = $v; return $this; }

    public function getHeroBackgroundImage(): ?string { return $this->heroBackgroundImage; }
    public function setHeroBackgroundImage(?string $v): static { $this->heroBackgroundImage = $v; return $this; }

    public function getHeroBackgroundColor(): ?string { return $this->heroBackgroundColor; }
    public function setHeroBackgroundColor(?string $v): static { $this->heroBackgroundColor = $v; return $this; }

    public function getHeroTextColor(): string { return $this->heroTextColor; }
    public function setHeroTextColor(string $v): static { $this->heroTextColor = $v; return $this; }

    public function getHeroButtonText(): string { return $this->heroButtonText; }
    public function setHeroButtonText(string $v): static { $this->heroButtonText = $v; return $this; }

    public function getHeroButtonColor(): string { return $this->heroButtonColor; }
    public function setHeroButtonColor(string $v): static { $this->heroButtonColor = $v; return $this; }

    public function getHeroButtonTextColor(): string { return $this->heroButtonTextColor; }
    public function setHeroButtonTextColor(string $v): static { $this->heroButtonTextColor = $v; return $this; }

    public function getActualitesSectionTitle(): string { return $this->actualitesSectionTitle; }
    public function setActualitesSectionTitle(string $v): static { $this->actualitesSectionTitle = $v; return $this; }

    public function getActualitesSectionSubtitle(): ?string { return $this->actualitesSectionSubtitle; }
    public function setActualitesSectionSubtitle(?string $v): static { $this->actualitesSectionSubtitle = $v; return $this; }

    public function getActualitesSectionBg(): string { return $this->actualitesSectionBg; }
    public function setActualitesSectionBg(string $v): static { $this->actualitesSectionBg = $v; return $this; }

    public function getContactSectionTitle(): string { return $this->contactSectionTitle; }
    public function setContactSectionTitle(string $v): static { $this->contactSectionTitle = $v; return $this; }

    public function getContactSectionSubtitle(): ?string { return $this->contactSectionSubtitle; }
    public function setContactSectionSubtitle(?string $v): static { $this->contactSectionSubtitle = $v; return $this; }

    public function getContactSectionBg(): string { return $this->contactSectionBg; }
    public function setContactSectionBg(string $v): static { $this->contactSectionBg = $v; return $this; }

    public function isAboutEnabled(): bool { return $this->aboutEnabled; }
    public function getAboutEnabled(): bool { return $this->aboutEnabled; }
    public function setAboutEnabled(bool $v): static { $this->aboutEnabled = $v; return $this; }

    public function getAboutTitle(): ?string { return $this->aboutTitle; }
    public function setAboutTitle(?string $v): static { $this->aboutTitle = $v; return $this; }

    public function getAboutText(): ?string { return $this->aboutText; }
    public function setAboutText(?string $v): static { $this->aboutText = $v; return $this; }

    public function getAboutImage(): ?string { return $this->aboutImage; }
    public function setAboutImage(?string $v): static { $this->aboutImage = $v; return $this; }

    public function getSectionOrder(): string { return $this->sectionOrder; }
    public function setSectionOrder(string $v): static { $this->sectionOrder = $v; return $this; }

    public function isSocialBlockEnabled(): bool { return $this->socialBlockEnabled; }
    public function getSocialBlockEnabled(): bool { return $this->socialBlockEnabled; }
    public function setSocialBlockEnabled(bool $v): static { $this->socialBlockEnabled = $v; return $this; }

    public function getSocialBlockTitle(): string { return $this->socialBlockTitle; }
    public function setSocialBlockTitle(string $v): static { $this->socialBlockTitle = $v; return $this; }

    public function getSocialBlockSubtitle(): ?string { return $this->socialBlockSubtitle; }
    public function setSocialBlockSubtitle(?string $v): static { $this->socialBlockSubtitle = $v; return $this; }

    public function getSocialBlockBg(): string { return $this->socialBlockBg; }
    public function setSocialBlockBg(string $v): static { $this->socialBlockBg = $v; return $this; }

    public function isTestimonialsEnabled(): bool { return $this->testimonialsEnabled; }
    public function getTestimonialsEnabled(): bool { return $this->testimonialsEnabled; }
    public function setTestimonialsEnabled(bool $v): static { $this->testimonialsEnabled = $v; return $this; }

    public function getTestimonialsTitle(): string { return $this->testimonialsTitle; }
    public function setTestimonialsTitle(string $v): static { $this->testimonialsTitle = $v; return $this; }

    public function getTestimonialsSubtitle(): ?string { return $this->testimonialsSubtitle; }
    public function setTestimonialsSubtitle(?string $v): static { $this->testimonialsSubtitle = $v; return $this; }

    public function getTestimonialsBg(): string { return $this->testimonialsBg; }
    public function setTestimonialsBg(string $v): static { $this->testimonialsBg = $v; return $this; }

    public function isFaqEnabled(): bool { return $this->faqEnabled; }
    public function getFaqEnabled(): bool { return $this->faqEnabled; }
    public function setFaqEnabled(bool $v): static { $this->faqEnabled = $v; return $this; }

    public function getFaqTitle(): string { return $this->faqTitle; }
    public function setFaqTitle(string $v): static { $this->faqTitle = $v; return $this; }

    public function getFaqSubtitle(): ?string { return $this->faqSubtitle; }
    public function setFaqSubtitle(?string $v): static { $this->faqSubtitle = $v; return $this; }

    public function getFaqBg(): string { return $this->faqBg; }
    public function setFaqBg(string $v): static { $this->faqBg = $v; return $this; }

    public function isGalleryEnabled(): bool { return $this->galleryEnabled; }
    public function getGalleryEnabled(): bool { return $this->galleryEnabled; }
    public function setGalleryEnabled(bool $v): static { $this->galleryEnabled = $v; return $this; }

    public function getGalleryTitle(): string { return $this->galleryTitle; }
    public function setGalleryTitle(string $v): static { $this->galleryTitle = $v; return $this; }

    public function getGallerySubtitle(): ?string { return $this->gallerySubtitle; }
    public function setGallerySubtitle(?string $v): static { $this->gallerySubtitle = $v; return $this; }

    public function getGalleryBg(): string { return $this->galleryBg; }
    public function setGalleryBg(string $v): static { $this->galleryBg = $v; return $this; }

    public function isPartnersEnabled(): bool { return $this->partnersEnabled; }
    public function getPartnersEnabled(): bool { return $this->partnersEnabled; }
    public function setPartnersEnabled(bool $v): static { $this->partnersEnabled = $v; return $this; }

    public function getPartnersTitle(): string { return $this->partnersTitle; }
    public function setPartnersTitle(string $v): static { $this->partnersTitle = $v; return $this; }

    public function getPartnersSubtitle(): ?string { return $this->partnersSubtitle; }
    public function setPartnersSubtitle(?string $v): static { $this->partnersSubtitle = $v; return $this; }

    public function getPartnersBg(): string { return $this->partnersBg; }
    public function setPartnersBg(string $v): static { $this->partnersBg = $v; return $this; }

    public function isServicesEnabled(): bool { return $this->servicesEnabled; }
    public function getServicesEnabled(): bool { return $this->servicesEnabled; }
    public function setServicesEnabled(bool $v): static { $this->servicesEnabled = $v; return $this; }

    public function getServicesTitle(): string { return $this->servicesTitle; }
    public function setServicesTitle(string $v): static { $this->servicesTitle = $v; return $this; }

    public function getServicesSubtitle(): ?string { return $this->servicesSubtitle; }
    public function setServicesSubtitle(?string $v): static { $this->servicesSubtitle = $v; return $this; }

    public function getServicesBg(): string { return $this->servicesBg; }
    public function setServicesBg(string $v): static { $this->servicesBg = $v; return $this; }

    public function getServiceCard1Title(): string { return $this->serviceCard1Title; }
    public function setServiceCard1Title(string $v): static { $this->serviceCard1Title = $v; return $this; }

    public function getServiceCard1Description(): ?string { return $this->serviceCard1Description; }
    public function setServiceCard1Description(?string $v): static { $this->serviceCard1Description = $v; return $this; }

    public function getServiceCard1Image(): ?string { return $this->serviceCard1Image; }
    public function setServiceCard1Image(?string $v): static { $this->serviceCard1Image = $v; return $this; }

    public function getServiceCard2Title(): string { return $this->serviceCard2Title; }
    public function setServiceCard2Title(string $v): static { $this->serviceCard2Title = $v; return $this; }

    public function getServiceCard2Description(): ?string { return $this->serviceCard2Description; }
    public function setServiceCard2Description(?string $v): static { $this->serviceCard2Description = $v; return $this; }

    public function getServiceCard2Image(): ?string { return $this->serviceCard2Image; }
    public function setServiceCard2Image(?string $v): static { $this->serviceCard2Image = $v; return $this; }

    public function getServiceCard3Title(): string { return $this->serviceCard3Title; }
    public function setServiceCard3Title(string $v): static { $this->serviceCard3Title = $v; return $this; }

    public function getServiceCard3Description(): ?string { return $this->serviceCard3Description; }
    public function setServiceCard3Description(?string $v): static { $this->serviceCard3Description = $v; return $this; }

    public function getServiceCard3Image(): ?string { return $this->serviceCard3Image; }
    public function setServiceCard3Image(?string $v): static { $this->serviceCard3Image = $v; return $this; }

    public function isCtaBlockEnabled(): bool { return $this->ctaBlockEnabled; }
    public function getCtaBlockEnabled(): bool { return $this->ctaBlockEnabled; }
    public function setCtaBlockEnabled(bool $v): static { $this->ctaBlockEnabled = $v; return $this; }

    public function getCtaBlockTitle(): string { return $this->ctaBlockTitle; }
    public function setCtaBlockTitle(string $v): static { $this->ctaBlockTitle = $v; return $this; }

    public function getCtaBlockText(): ?string { return $this->ctaBlockText; }
    public function setCtaBlockText(?string $v): static { $this->ctaBlockText = $v; return $this; }

    public function getCtaButtonText(): string { return $this->ctaButtonText; }
    public function setCtaButtonText(string $v): static { $this->ctaButtonText = $v; return $this; }

    public function getCtaButtonLink(): string { return $this->ctaButtonLink; }
    public function setCtaButtonLink(string $v): static { $this->ctaButtonLink = $v; return $this; }

    public function getCtaBlockBg(): string { return $this->ctaBlockBg; }
    public function setCtaBlockBg(string $v): static { $this->ctaBlockBg = $v; return $this; }

    public function getCtaTextColor(): string { return $this->ctaTextColor; }
    public function setCtaTextColor(string $v): static { $this->ctaTextColor = $v; return $this; }

    // === FAQ CONTENT ===

    public function getFaqQ1(): string { return $this->faqQ1; }
    public function setFaqQ1(string $v): static { $this->faqQ1 = $v; return $this; }

    public function getFaqA1(): ?string { return $this->faqA1; }
    public function setFaqA1(?string $v): static { $this->faqA1 = $v; return $this; }

    public function getFaqQ2(): string { return $this->faqQ2; }
    public function setFaqQ2(string $v): static { $this->faqQ2 = $v; return $this; }

    public function getFaqA2(): ?string { return $this->faqA2; }
    public function setFaqA2(?string $v): static { $this->faqA2 = $v; return $this; }

    public function getFaqQ3(): string { return $this->faqQ3; }
    public function setFaqQ3(string $v): static { $this->faqQ3 = $v; return $this; }

    public function getFaqA3(): ?string { return $this->faqA3; }
    public function setFaqA3(?string $v): static { $this->faqA3 = $v; return $this; }

    // === TESTIMONIALS CONTENT ===

    public function getTestimonial1Text(): ?string { return $this->testimonial1Text; }
    public function setTestimonial1Text(?string $v): static { $this->testimonial1Text = $v; return $this; }

    public function getTestimonial1Author(): ?string { return $this->testimonial1Author; }
    public function setTestimonial1Author(?string $v): static { $this->testimonial1Author = $v; return $this; }

    public function getTestimonial1Role(): ?string { return $this->testimonial1Role; }
    public function setTestimonial1Role(?string $v): static { $this->testimonial1Role = $v; return $this; }

    public function getTestimonial2Text(): ?string { return $this->testimonial2Text; }
    public function setTestimonial2Text(?string $v): static { $this->testimonial2Text = $v; return $this; }

    public function getTestimonial2Author(): ?string { return $this->testimonial2Author; }
    public function setTestimonial2Author(?string $v): static { $this->testimonial2Author = $v; return $this; }

    public function getTestimonial2Role(): ?string { return $this->testimonial2Role; }
    public function setTestimonial2Role(?string $v): static { $this->testimonial2Role = $v; return $this; }

    public function getTestimonial3Text(): ?string { return $this->testimonial3Text; }
    public function setTestimonial3Text(?string $v): static { $this->testimonial3Text = $v; return $this; }

    public function getTestimonial3Author(): ?string { return $this->testimonial3Author; }
    public function setTestimonial3Author(?string $v): static { $this->testimonial3Author = $v; return $this; }

    public function getTestimonial3Role(): ?string { return $this->testimonial3Role; }
    public function setTestimonial3Role(?string $v): static { $this->testimonial3Role = $v; return $this; }

    // === GALLERY CONTENT ===

    public function getGalleryImage1(): ?string { return $this->galleryImage1; }
    public function setGalleryImage1(?string $v): static { $this->galleryImage1 = $v; return $this; }

    public function getGalleryCaption1(): ?string { return $this->galleryCaption1; }
    public function setGalleryCaption1(?string $v): static { $this->galleryCaption1 = $v; return $this; }

    public function getGalleryImage2(): ?string { return $this->galleryImage2; }
    public function setGalleryImage2(?string $v): static { $this->galleryImage2 = $v; return $this; }

    public function getGalleryCaption2(): ?string { return $this->galleryCaption2; }
    public function setGalleryCaption2(?string $v): static { $this->galleryCaption2 = $v; return $this; }

    public function getGalleryImage3(): ?string { return $this->galleryImage3; }
    public function setGalleryImage3(?string $v): static { $this->galleryImage3 = $v; return $this; }

    public function getGalleryCaption3(): ?string { return $this->galleryCaption3; }
    public function setGalleryCaption3(?string $v): static { $this->galleryCaption3 = $v; return $this; }

    public function getGalleryImage4(): ?string { return $this->galleryImage4; }
    public function setGalleryImage4(?string $v): static { $this->galleryImage4 = $v; return $this; }

    public function getGalleryCaption4(): ?string { return $this->galleryCaption4; }
    public function setGalleryCaption4(?string $v): static { $this->galleryCaption4 = $v; return $this; }

    public function getGalleryImage5(): ?string { return $this->galleryImage5; }
    public function setGalleryImage5(?string $v): static { $this->galleryImage5 = $v; return $this; }

    public function getGalleryCaption5(): ?string { return $this->galleryCaption5; }
    public function setGalleryCaption5(?string $v): static { $this->galleryCaption5 = $v; return $this; }

    public function getGalleryImage6(): ?string { return $this->galleryImage6; }
    public function setGalleryImage6(?string $v): static { $this->galleryImage6 = $v; return $this; }

    public function getGalleryCaption6(): ?string { return $this->galleryCaption6; }
    public function setGalleryCaption6(?string $v): static { $this->galleryCaption6 = $v; return $this; }

    // === PARTNERS CONTENT ===

    public function getPartnerName1(): ?string { return $this->partnerName1; }
    public function setPartnerName1(?string $v): static { $this->partnerName1 = $v; return $this; }

    public function getPartnerLogo1(): ?string { return $this->partnerLogo1; }
    public function setPartnerLogo1(?string $v): static { $this->partnerLogo1 = $v; return $this; }

    public function getPartnerName2(): ?string { return $this->partnerName2; }
    public function setPartnerName2(?string $v): static { $this->partnerName2 = $v; return $this; }

    public function getPartnerLogo2(): ?string { return $this->partnerLogo2; }
    public function setPartnerLogo2(?string $v): static { $this->partnerLogo2 = $v; return $this; }

    public function getPartnerName3(): ?string { return $this->partnerName3; }
    public function setPartnerName3(?string $v): static { $this->partnerName3 = $v; return $this; }

    public function getPartnerLogo3(): ?string { return $this->partnerLogo3; }
    public function setPartnerLogo3(?string $v): static { $this->partnerLogo3 = $v; return $this; }

    public function getPartnerName4(): ?string { return $this->partnerName4; }
    public function setPartnerName4(?string $v): static { $this->partnerName4 = $v; return $this; }

    public function getPartnerLogo4(): ?string { return $this->partnerLogo4; }
    public function setPartnerLogo4(?string $v): static { $this->partnerLogo4 = $v; return $this; }

    public function getPartnerName5(): ?string { return $this->partnerName5; }
    public function setPartnerName5(?string $v): static { $this->partnerName5 = $v; return $this; }

    public function getPartnerLogo5(): ?string { return $this->partnerLogo5; }
    public function setPartnerLogo5(?string $v): static { $this->partnerLogo5 = $v; return $this; }

    public function getPartnerName6(): ?string { return $this->partnerName6; }
    public function setPartnerName6(?string $v): static { $this->partnerName6 = $v; return $this; }

    public function getPartnerLogo6(): ?string { return $this->partnerLogo6; }
    public function setPartnerLogo6(?string $v): static { $this->partnerLogo6 = $v; return $this; }

    public function getUpdatedAt(): ?\DateTimeInterface { return $this->updatedAt; }
}

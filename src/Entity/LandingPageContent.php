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

    public function getUpdatedAt(): ?\DateTimeInterface { return $this->updatedAt; }
}

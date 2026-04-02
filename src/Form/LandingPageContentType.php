<?php

namespace App\Form;

use App\Entity\LandingPageContent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class LandingPageContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sectionOrder', HiddenType::class)

        // === TAB: COLORS ===
            ->add('colorPrimary', ColorType::class, ['label' => 'Couleur primaire (boutons, liens)'])
            ->add('colorSecondary', ColorType::class, ['label' => 'Couleur secondaire'])
            ->add('colorBackground', ColorType::class, ['label' => 'Fond de page'])
            ->add('colorText', ColorType::class, ['label' => 'Texte principal'])
            ->add('colorNavbarBg', ColorType::class, ['label' => 'Fond navbar'])
            ->add('colorNavbarText', ColorType::class, ['label' => 'Texte navbar'])
            ->add('colorFooterBg', ColorType::class, ['label' => 'Fond footer'])
            ->add('colorFooterText', ColorType::class, ['label' => 'Texte footer'])

        // === TAB: FONTS ===
            ->add('fontBody', TextType::class, [
                'label' => 'Police corps (Google Fonts)',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Roboto'],
            ])
            ->add('fontHeading', TextType::class, [
                'label' => 'Police titres (Google Fonts)',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Poppins'],
            ])
            ->add('fontSizeBase', TextType::class, [
                'label' => 'Taille de base',
                'attr' => ['class' => 'form-control', 'placeholder' => '16px'],
            ])

        // === TAB: HERO ===
            ->add('heroTitle', TextType::class, [
                'label' => 'Titre principal (hero)',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('heroSubtitle', TextType::class, [
                'label' => 'Sous-titre hero',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('heroBackgroundImageFile', FileType::class, [
                'label' => 'Image de fond hero (JPG, PNG, WebP, HEIC)',
                'mapped' => false,
                'required' => false,
                'constraints' => [new File(maxSize: '4M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/heic', 'image/heif'], mimeTypesMessage: 'Veuillez telecharger une image valide (JPG, PNG, WebP ou HEIC).')],
                'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.heic,.heif'],
            ])
            ->add('heroBackgroundColor', ColorType::class, [
                'label' => 'Couleur de fond hero (si pas d\'image)',
                'required' => false,
            ])
            ->add('heroTextColor', ColorType::class, ['label' => 'Couleur texte hero'])
            ->add('heroButtonText', TextType::class, [
                'label' => 'Texte du bouton CTA',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('heroButtonColor', ColorType::class, ['label' => 'Couleur fond bouton CTA'])
            ->add('heroButtonTextColor', ColorType::class, ['label' => 'Couleur texte bouton CTA'])

        // === TAB: SECTIONS ===
            ->add('actualitesSectionTitle', TextType::class, [
                'label' => 'Titre section Actualités',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('actualitesSectionSubtitle', TextType::class, [
                'label' => 'Sous-titre section Actualités',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('actualitesSectionBg', ColorType::class, ['label' => 'Fond section Actualités'])
            ->add('contactSectionTitle', TextType::class, [
                'label' => 'Titre section Contact',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('contactSectionSubtitle', TextType::class, [
                'label' => 'Sous-titre section Contact',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('contactSectionBg', ColorType::class, ['label' => 'Fond section Contact'])

        // === TAB: ABOUT ===
            ->add('aboutEnabled', CheckboxType::class, [
                'label' => 'Activer la section "À propos"',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('aboutTitle', TextType::class, [
                'label' => 'Titre À propos',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('aboutText', TextareaType::class, [
                'label' => 'Texte À propos',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => 5],
            ])
            ->add('aboutImageFile', FileType::class, [
                'label' => 'Image À propos',
                'mapped' => false,
                'required' => false,
                'constraints' => [new File(maxSize: '2M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/heic', 'image/heif'], mimeTypesMessage: 'Veuillez telecharger une image valide (JPG, PNG, WebP ou HEIC).')],
                'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.heic,.heif'],
            ])

        // === TAB: PREDEFINED BLOCKS ===
            ->add('socialBlockEnabled', CheckboxType::class, [
                'label' => 'Activer le bloc Reseaux sociaux',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('socialBlockTitle', TextType::class, [
                'label' => 'Titre bloc Reseaux sociaux',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('socialBlockSubtitle', TextType::class, [
                'label' => 'Sous-titre bloc Reseaux sociaux',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('socialBlockBg', ColorType::class, ['label' => 'Fond bloc Reseaux sociaux'])
            ->add('testimonialsEnabled', CheckboxType::class, [
                'label' => 'Activer le bloc Temoignages',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('testimonialsTitle', TextType::class, [
                'label' => 'Titre bloc Temoignages',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('testimonialsSubtitle', TextType::class, [
                'label' => 'Sous-titre bloc Temoignages',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('testimonialsBg', ColorType::class, ['label' => 'Fond bloc Temoignages'])
            ->add('faqEnabled', CheckboxType::class, [
                'label' => 'Activer le bloc FAQ',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('faqTitle', TextType::class, [
                'label' => 'Titre bloc FAQ',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('faqSubtitle', TextType::class, [
                'label' => 'Sous-titre bloc FAQ',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('faqBg', ColorType::class, ['label' => 'Fond bloc FAQ'])
            ->add('galleryEnabled', CheckboxType::class, [
                'label' => 'Activer le bloc Galerie',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('galleryTitle', TextType::class, [
                'label' => 'Titre bloc Galerie',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('gallerySubtitle', TextType::class, [
                'label' => 'Sous-titre bloc Galerie',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('galleryBg', ColorType::class, ['label' => 'Fond bloc Galerie'])
            ->add('partnersEnabled', CheckboxType::class, [
                'label' => 'Activer le bloc Partenaires',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('partnersTitle', TextType::class, [
                'label' => 'Titre bloc Partenaires',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('partnersSubtitle', TextType::class, [
                'label' => 'Sous-titre bloc Partenaires',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('partnersBg', ColorType::class, ['label' => 'Fond bloc Partenaires'])
            ->add('servicesEnabled', CheckboxType::class, [
                'label' => 'Activer le bloc Services',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('servicesTitle', TextType::class, [
                'label' => 'Titre bloc Services',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('servicesSubtitle', TextType::class, [
                'label' => 'Sous-titre bloc Services',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('servicesBg', ColorType::class, ['label' => 'Fond bloc Services'])
            ->add('serviceCard1Title', TextType::class, [
                'label' => 'Titre carte service 1',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('serviceCard1Description', TextareaType::class, [
                'label' => 'Description carte service 1',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => 3],
            ])
            ->add('serviceCard1ImageFile', FileType::class, [
                'label' => 'Image carte service 1',
                'mapped' => false,
                'required' => false,
                'constraints' => [new File(maxSize: '2M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/heic', 'image/heif'], mimeTypesMessage: 'Veuillez telecharger une image valide (JPG, PNG, WebP ou HEIC).')],
                'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.heic,.heif'],
            ])
            ->add('serviceCard2Title', TextType::class, [
                'label' => 'Titre carte service 2',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('serviceCard2Description', TextareaType::class, [
                'label' => 'Description carte service 2',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => 3],
            ])
            ->add('serviceCard2ImageFile', FileType::class, [
                'label' => 'Image carte service 2',
                'mapped' => false,
                'required' => false,
                'constraints' => [new File(maxSize: '2M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/heic', 'image/heif'], mimeTypesMessage: 'Veuillez telecharger une image valide (JPG, PNG, WebP ou HEIC).')],
                'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.heic,.heif'],
            ])
            ->add('serviceCard3Title', TextType::class, [
                'label' => 'Titre carte service 3',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('serviceCard3Description', TextareaType::class, [
                'label' => 'Description carte service 3',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => 3],
            ])
            ->add('serviceCard3ImageFile', FileType::class, [
                'label' => 'Image carte service 3',
                'mapped' => false,
                'required' => false,
                'constraints' => [new File(maxSize: '2M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/heic', 'image/heif'], mimeTypesMessage: 'Veuillez telecharger une image valide (JPG, PNG, WebP ou HEIC).')],
                'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.heic,.heif'],
            ])
            ->add('ctaBlockEnabled', CheckboxType::class, [
                'label' => 'Activer le bloc CTA',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('ctaBlockTitle', TextType::class, [
                'label' => 'Titre bloc CTA',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('ctaBlockText', TextareaType::class, [
                'label' => 'Texte bloc CTA',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => 3],
            ])
            ->add('ctaButtonText', TextType::class, [
                'label' => 'Texte bouton CTA',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('ctaButtonLink', TextType::class, [
                'label' => 'Lien bouton CTA (URL ou #ancre)',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('ctaBlockBg', ColorType::class, ['label' => 'Fond bloc CTA'])
            ->add('ctaTextColor', ColorType::class, ['label' => 'Couleur texte bloc CTA'])

        // === FAQ CONTENT ===
            ->add('faqQ1', TextType::class, ['label' => 'Question 1', 'attr' => ['class' => 'form-control']])
            ->add('faqA1', TextareaType::class, ['label' => 'Réponse 1', 'required' => false, 'attr' => ['class' => 'form-control', 'rows' => 3]])
            ->add('faqQ2', TextType::class, ['label' => 'Question 2', 'attr' => ['class' => 'form-control']])
            ->add('faqA2', TextareaType::class, ['label' => 'Réponse 2', 'required' => false, 'attr' => ['class' => 'form-control', 'rows' => 3]])
            ->add('faqQ3', TextType::class, ['label' => 'Question 3', 'attr' => ['class' => 'form-control']])
            ->add('faqA3', TextareaType::class, ['label' => 'Réponse 3', 'required' => false, 'attr' => ['class' => 'form-control', 'rows' => 3]])

        // === TESTIMONIALS CONTENT ===
            ->add('testimonial1Text', TextareaType::class, ['label' => 'Témoignage 1', 'required' => false, 'attr' => ['class' => 'form-control', 'rows' => 3]])
            ->add('testimonial1Author', TextType::class, ['label' => 'Auteur 1', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('testimonial1Role', TextType::class, ['label' => 'Rôle 1', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('testimonial2Text', TextareaType::class, ['label' => 'Témoignage 2', 'required' => false, 'attr' => ['class' => 'form-control', 'rows' => 3]])
            ->add('testimonial2Author', TextType::class, ['label' => 'Auteur 2', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('testimonial2Role', TextType::class, ['label' => 'Rôle 2', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('testimonial3Text', TextareaType::class, ['label' => 'Témoignage 3', 'required' => false, 'attr' => ['class' => 'form-control', 'rows' => 3]])
            ->add('testimonial3Author', TextType::class, ['label' => 'Auteur 3', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('testimonial3Role', TextType::class, ['label' => 'Rôle 3', 'required' => false, 'attr' => ['class' => 'form-control']])

        // === GALLERY CONTENT ===
            ->add('galleryCaption1', TextType::class, ['label' => 'Légende 1', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('galleryImage1File', FileType::class, ['label' => 'Image 1', 'mapped' => false, 'required' => false, 'constraints' => [new File(maxSize: '2M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/heic', 'image/heif'], mimeTypesMessage: 'Image valide (JPG, PNG, WebP ou HEIC).')], 'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.heic,.heif']])
            ->add('galleryCaption2', TextType::class, ['label' => 'Légende 2', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('galleryImage2File', FileType::class, ['label' => 'Image 2', 'mapped' => false, 'required' => false, 'constraints' => [new File(maxSize: '2M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/heic', 'image/heif'], mimeTypesMessage: 'Image valide (JPG, PNG, WebP ou HEIC).')], 'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.heic,.heif']])
            ->add('galleryCaption3', TextType::class, ['label' => 'Légende 3', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('galleryImage3File', FileType::class, ['label' => 'Image 3', 'mapped' => false, 'required' => false, 'constraints' => [new File(maxSize: '2M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/heic', 'image/heif'], mimeTypesMessage: 'Image valide (JPG, PNG, WebP ou HEIC).')], 'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.heic,.heif']])
            ->add('galleryCaption4', TextType::class, ['label' => 'Légende 4', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('galleryImage4File', FileType::class, ['label' => 'Image 4', 'mapped' => false, 'required' => false, 'constraints' => [new File(maxSize: '2M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/heic', 'image/heif'], mimeTypesMessage: 'Image valide (JPG, PNG, WebP ou HEIC).')], 'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.heic,.heif']])
            ->add('galleryCaption5', TextType::class, ['label' => 'Légende 5', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('galleryImage5File', FileType::class, ['label' => 'Image 5', 'mapped' => false, 'required' => false, 'constraints' => [new File(maxSize: '2M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/heic', 'image/heif'], mimeTypesMessage: 'Image valide (JPG, PNG, WebP ou HEIC).')], 'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.heic,.heif']])
            ->add('galleryCaption6', TextType::class, ['label' => 'Légende 6', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('galleryImage6File', FileType::class, ['label' => 'Image 6', 'mapped' => false, 'required' => false, 'constraints' => [new File(maxSize: '2M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/heic', 'image/heif'], mimeTypesMessage: 'Image valide (JPG, PNG, WebP ou HEIC).')], 'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.heic,.heif']])

        // === PARTNERS CONTENT ===
            ->add('partnerName1', TextType::class, ['label' => 'Partenaire 1 — Nom', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('partnerLogo1File', FileType::class, ['label' => 'Partenaire 1 — Logo', 'mapped' => false, 'required' => false, 'constraints' => [new File(maxSize: '1M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'], mimeTypesMessage: 'Image valide (JPG, PNG, WebP ou SVG).')], 'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.svg']])
            ->add('partnerName2', TextType::class, ['label' => 'Partenaire 2 — Nom', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('partnerLogo2File', FileType::class, ['label' => 'Partenaire 2 — Logo', 'mapped' => false, 'required' => false, 'constraints' => [new File(maxSize: '1M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'], mimeTypesMessage: 'Image valide (JPG, PNG, WebP ou SVG).')], 'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.svg']])
            ->add('partnerName3', TextType::class, ['label' => 'Partenaire 3 — Nom', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('partnerLogo3File', FileType::class, ['label' => 'Partenaire 3 — Logo', 'mapped' => false, 'required' => false, 'constraints' => [new File(maxSize: '1M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'], mimeTypesMessage: 'Image valide (JPG, PNG, WebP ou SVG).')], 'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.svg']])
            ->add('partnerName4', TextType::class, ['label' => 'Partenaire 4 — Nom', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('partnerLogo4File', FileType::class, ['label' => 'Partenaire 4 — Logo', 'mapped' => false, 'required' => false, 'constraints' => [new File(maxSize: '1M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'], mimeTypesMessage: 'Image valide (JPG, PNG, WebP ou SVG).')], 'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.svg']])
            ->add('partnerName5', TextType::class, ['label' => 'Partenaire 5 — Nom', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('partnerLogo5File', FileType::class, ['label' => 'Partenaire 5 — Logo', 'mapped' => false, 'required' => false, 'constraints' => [new File(maxSize: '1M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'], mimeTypesMessage: 'Image valide (JPG, PNG, WebP ou SVG).')], 'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.svg']])
            ->add('partnerName6', TextType::class, ['label' => 'Partenaire 6 — Nom', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('partnerLogo6File', FileType::class, ['label' => 'Partenaire 6 — Logo', 'mapped' => false, 'required' => false, 'constraints' => [new File(maxSize: '1M', mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'], mimeTypesMessage: 'Image valide (JPG, PNG, WebP ou SVG).')], 'attr' => ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp,.svg']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LandingPageContent::class,
        ]);
    }
}

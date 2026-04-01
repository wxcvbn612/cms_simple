<?php

namespace App\Form;

use App\Entity\LandingPageContent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class LandingPageContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // === TAB: COLORS ===
        $builder
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
                'label' => 'Image de fond hero (JPG, PNG, WebP)',
                'mapped' => false,
                'required' => false,
                'constraints' => [new File(['maxSize' => '4M', 'mimeTypes' => ['image/jpeg', 'image/png', 'image/webp']])],
                'attr' => ['class' => 'form-control'],
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
                'constraints' => [new File(['maxSize' => '2M', 'mimeTypes' => ['image/jpeg', 'image/png', 'image/webp']])],
                'attr' => ['class' => 'form-control'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LandingPageContent::class,
        ]);
    }
}

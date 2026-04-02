<?php

namespace App\Form;

use App\Entity\SiteSettings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class SiteSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('siteName', TextType::class, [
                'label' => 'Nom du site / société',
                'constraints' => [new NotBlank()],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('siteTagline', TextType::class, [
                'label' => 'Slogan / Sous-titre',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('logoFile', FileType::class, [
                'label' => 'Logo (PNG, SVG, WebP)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File(maxSize: '1M', mimeTypes: ['image/png', 'image/svg+xml', 'image/webp', 'image/jpeg']),
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('faviconFile', FileType::class, [
                'label' => 'Favicon (ICO, PNG)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File(maxSize: '512k', mimeTypes: ['image/x-icon', 'image/png', 'image/vnd.microsoft.icon']),
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email affiché publiquement',
                'required' => false,
                'constraints' => [new Email()],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('adminEmail', EmailType::class, [
                'label' => 'Email admin (réception des messages)',
                'constraints' => [new NotBlank(), new Email()],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('address', TextareaType::class, [
                'label' => 'Adresse',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => 3],
            ])
            ->add('defaultLocale', ChoiceType::class, [
                'label' => 'Langue par défaut',
                'choices' => ['Français' => 'fr', 'Arabe (عربي)' => 'ar'],
                'attr' => ['class' => 'form-select'],
            ])
            ->add('facebookUrl', UrlType::class, [
                'label' => 'Facebook URL',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('instagramUrl', UrlType::class, [
                'label' => 'Instagram URL',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('xUrl', UrlType::class, [
                'label' => 'X (Twitter) URL',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('linkedinUrl', UrlType::class, [
                'label' => 'LinkedIn URL',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('youtubeUrl', UrlType::class, [
                'label' => 'YouTube URL',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('tiktokUrl', UrlType::class, [
                'label' => 'TikTok URL',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('whatsapp', TextType::class, [
                'label' => 'WhatsApp (numéro avec indicatif)',
                'required' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => '+213xxxxxxxxx'],
            ])
            ->add('showSocialInNavbar', CheckboxType::class, [
                'label' => 'Afficher les reseaux sociaux dans la navbar',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('showSocialInFooter', CheckboxType::class, [
                'label' => 'Afficher les reseaux sociaux dans le footer',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('showSocialInLandingBlock', CheckboxType::class, [
                'label' => 'Afficher les reseaux sociaux dans le bloc dedie',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('footerText', TextareaType::class, [
                'label' => 'Texte du pied de page',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => 2],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SiteSettings::class,
        ]);
    }
}

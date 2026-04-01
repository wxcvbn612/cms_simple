<?php

namespace App\Form;

use App\Entity\ContactMessage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'contact.name',
                'constraints' => [new NotBlank(message: 'contact.name_required')],
                'attr' => ['class' => 'form-control', 'placeholder' => 'contact.name'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'contact.email',
                'constraints' => [
                    new NotBlank(message: 'contact.email_required'),
                    new Email(message: 'contact.email_invalid'),
                ],
                'attr' => ['class' => 'form-control', 'placeholder' => 'contact.email'],
            ])
            ->add('telephone', TextType::class, [
                'label' => 'contact.phone',
                'required' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'contact.phone'],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'contact.message',
                'constraints' => [new NotBlank(message: 'contact.message_required')],
                'attr' => ['class' => 'form-control', 'rows' => 5, 'placeholder' => 'contact.message'],
            ])
            // Honeypot — must be empty on submit
            ->add('website', TextType::class, [
                'label' => false,
                'mapped' => false,
                'required' => false,
                'attr' => ['style' => 'display:none !important', 'tabindex' => '-1', 'autocomplete' => 'off'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactMessage::class,
        ]);
    }
}

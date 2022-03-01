<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /*
        email
        case à cocher ( m'envoyer l'email de réponse )
        sujet ( bogue / amélioration)
        urgence 1 -> 5
        Message
        */
        $builder->add('email', EmailType::class, [
            'label' => 'E-mail',
            'attr' => ['placeholder' => 'mail@example.com'],
        ]);
        $builder->add('sendEmail', CheckboxType::class);
        $builder->add('subject', ChoiceType::class, [
            'label' => 'Objet du message',
            'choices'  => [
                'Autre' => 'other',
                'Bogue' => 'bogue',
                'Amélioration' => 'feature',
            ],
            'multiple' => false,
            'expanded' => false,
        ]);
        $builder->add('urgency', IntegerType::class, [
            'label' => 'Urgence',
            'required' => false,
        ]);
        $builder->add('message', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Review;
use App\Entity\Movie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('username',null,[
                'label' => 'Username',
                'required' => true ]);
            $builder->add('email', EmailType::class, [
                'label' => 'E-mail',
                'attr' => ['placeholder' => 'mail@example.com'],
                'required' => true 
            ]);
            $builder->add('content', TextareaType::class,['attr' => ['minlength' => 100],'required' => true ] );
            $builder->add('rating', ChoiceType::class, [
                'label' => 'Avis',
                'choices'  => [
                    'Excellent' => '5',
                    'Très bon' => '4',
                    'Bon' => '3', 
                     'Peut mieux faire' => '2', 
                      'A éviter' => '1', 
                ],
                'multiple' => false,
                'expanded' => true,
            ]);
            $builder->add('reactions',ChoiceType::class, [
                'label' => 'Ce film vous a fait',
                'choices'  => [
                    'Rire' => 'smile',
                    'Pleurer' => 'cry',
                    'Réfléchir' => 'think', 
                     'Dormir' => 'sleep', 
                      'Rêver' => 'dream', 
                ], 
                'multiple' => true,
                'expanded' => true,
            ]);
            $builder->add('watchedAt', DateType::class, [
                'widget' => 'choice',
                'input'  => 'datetime_immutable'
            ]);
            $builder->add('movieName');
           
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}

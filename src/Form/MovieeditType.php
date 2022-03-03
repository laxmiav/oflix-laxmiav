<?php

namespace App\Form;

use App\Entity\Movie;
use App\Entity\Genre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FloatType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MovieeditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type',TextType::class, [
                'label' => 'TYPE',
            ])
            ->add('title',TextType::class, [
                'label' => 'Title',
            ])
            ->add('duration', IntegerType::class, [
                'label' => 'duration',
                
            ])
            ->add('releaseDate')
            ->add('summary', TextareaType::class, [
                'label' => 'Summary',
            ])
            ->add('synopsis', TextareaType::class, [
                'label' => 'synopsis',
            ])
            ->add('poster', TextType::class, [
                'label' => 'poster',
            ])
            ->add('rating',IntegerType::class, [
                'label' => 'rating',
                
            ])
            
            
         ->add('genres', EntityType::class,[ 'class' => Genre::class,
             'choice_label' => 'name',
            'expanded' => true,
            'multiple' => true,
             'choice_value' => 'id'
             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
    
}

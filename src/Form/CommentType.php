<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Titre',
            'attr' => [
                'placeholder' => 'Donnez un titre à votre commentaire'
            ]
            ]) 
            ->add('content', TextareaType::class, ['label' => 'Contenu', 
            'attr' => [
                'placeholder' => 'Tapez votre commentaire ici'
            ]
            ])
            ->add('author', TextType::class, ['label' => 'Auteur', 'attr' => [
                'placeholder' => 'Tapez votre nom'
            ]
            ])
            ->add('save', SubmitType::class, ['label' => 'Soumettre']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}

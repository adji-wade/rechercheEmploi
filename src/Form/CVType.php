<?php

namespace App\Form;

use App\Entity\CV;
use App\Entity\Demandeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CVType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('age')
            ->add('address')
            ->add('email')
            ->add('telephone')
            ->add('specialite')
            ->add('niveauEtude')
            ->add('experience')
          ->add('demandeur', EntityType::class,
           [
             'class' => Demandeur::class,
            'choice_label' => 'id',
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CV::class,
        ]);
    }
}

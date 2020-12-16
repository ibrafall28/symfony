<?php

namespace App\Form;

use App\Entity\Salle;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom',TextType::class,array('label'=>'Nom Salle','attr'=>array('require'=>'require','class'=>'form-control form-group')))
            ->add('users',EntityType::class,array('class'=>User::class,'label'=>"nom   utilisatue",'attr'=>array('require'=>'require','class'=>'form-control form-group')))
            ->add('valider',SubmitType::class,array('attr'=>array('class'=>'btn btn-success')))
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Salle::class,
        ]);
    }
}

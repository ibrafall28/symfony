<?php

namespace App\Form;

use App\Entity\Machine;
use App\Entity\Salle;
use App\Entity\User;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MachineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ipadresse',TextType::class,array('label'=>'Adresse ip','attr'=>array('require'=>'require','class'=>'form-control form-group')))
            ->add('macadresse',TextType::class,array('label'=>'Adresse mac','attr'=>array('require'=>'require','class'=>'form-control form-group')))
            ->add('marque',TextType::class,array('label'=>'Marque','attr'=>array('require'=>'require','class'=>'form-control form-group')))
            ->add('salle',EntityType::class,array('class'=>Salle::class,'label'=>"nom du salle",'attr'=>array('require'=>'require','class'=>'form-control form-group')))
            ->add('users',EntityType::class,array('class'=>User::class,'label'=>"nom  utilisateur",'attr'=>array('require'=>'require','class'=>'form-control form-group')))
            ->add('valider',SubmitType::class,array('attr'=>array('class'=>'btn btn-success')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Machine::class,
        ]);
    }
}

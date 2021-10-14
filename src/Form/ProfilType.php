<?php

namespace App\Form;

use App\Entity\Participant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, ['label' => 'Pseudo: '])
            ->add('prenom', TextType::class, ['label' => 'Prenom: '])
            ->add('nom', TextType::class, ['label' => 'Nom: '])
            ->add('telephone', NumberType::class, ['label' => 'Telephone: '])
            ->add('email', TextType::class, ['label' => 'Email: '])
            //->add('password', TextType::class, ['label' => 'Mot de passe: '])
            ->add('site', null, ['choice_label' => 'nomSite', 'label' => 'Ville de rattachement: '])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
            'sites_no_site' => 1,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Lieux;
use App\Entity\Sorties;
use App\Entity\Villes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjouterSortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, ['label' => 'Nom de la sortie: '])
            ->add('datedebut', DateTimeType::class, ['label' => 'Date et heure de la sortie: '])
            ->add('datecloture', DateType::class, ['label' => "Date limite d'inscription"])
            ->add('nbinscriptionsmax', IntegerType::class, ['label' => 'Nombre de places:'])
            ->add('duree', IntegerType::class, ['label' => 'Duree'])
            ->add('descriptioninfos', TextareaType::class, ['label' => 'Description et infos: '])
            ->add('ville', EntityType::class, [
                'class' => 'App\Entity\Villes',
                'mapped' => false,
                'choice_label' => 'nomVille',
                'placeholder' => 'Selectionner une ville',
                'required' => false,
            ])
        ;
        $builder->get('ville')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addLieuField($form->getParent(), $form->getData());
            }
        );
        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                $data = $event->getData();
                /* @var $lieu \App\Entity\Lieux */
                $lieu = $data->getLieuxNoLieu();
                $form = $event->getForm();
                if ($lieu) {
                    $ville = $lieu->getVille();
                    $this->addLieuField($form, $ville);
                    $form->get('ville')->setData($ville);
                } else {
                    $this->addLieuField($form, null);
                }
            }
        );
    }

    private function addLieuField(FormInterface $form, ?Villes $ville)
    {
        $builder = $form->add('lieuxNoLieu', EntityType::class, [
            'class' => Lieux::class,
            'choice_label' => 'nomLieu',
            'placeholder' => $ville ? 'Selectionner votre lieu' : 'Selectionner votre ville',
            'required' => true,
            'auto_initialize' => false,
            'choices' => $ville ? $ville->getLieux() : [],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
        ]);
    }
}

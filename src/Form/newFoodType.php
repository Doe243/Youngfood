<?php

namespace App\Form;

use App\Entity\Food;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class newFoodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Intitulé de l\'aliment',
                'required' => true,
            ])
            ->add('category', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => [
                    'Entrée' => 'E',
                    'Plat principal' => 'P',
                    'Dessert' => 'D'
                ]
            ])
            ->add('picture', FileType::class, [
                'label' => 'Suggestion de présentation',
                'mapped' => false,
                'required' => false, //false because if we want to edit it in the future we'll have to upload again the pic, yes that's dumb
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Le fichier est trop volumineux.',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Le type {{ type }} n\'est pas accepté. Veuillez réessayer.'
                    ])
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'save'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Food::class,
        ]);
    }
}

<?php

namespace PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('tags', EntityType::class, array(
                'class' => 'PlatformBundle\Entity\Tag',
                'choice_label' => 'name',

                'expanded' => true,
                'multiple' => true
            )) 
            ->add('category', EntityType::class, array(
                'class' => 'PlatformBundle\Entity\Category',
                'choice_label' => 'name',
                'placeholder' => 'Please choose',
                'empty_data' => null,
                'required' => false
 
            )) 
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlatformBundle\Entity\Article'
        ));
    }
}

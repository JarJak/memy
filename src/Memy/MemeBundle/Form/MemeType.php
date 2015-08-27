<?php

namespace Memy\MemeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MemeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('filename')
            ->add('originalFilename')
            ->add('title')
            ->add('description')
            ->add('tags')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Memy\MemeBundle\Entity\Meme'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'memy_memebundle_meme';
    }
}

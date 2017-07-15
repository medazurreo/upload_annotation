<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('content',TextType::class,  array('required' => false))
            ->add('file', FileType::class, array(
                    'required' => false,
                    'label' => 'Upload ur file',
                    'label_attr' => array('class' => 'control-label', ),
                    'attr' => array('id' => 'input-folder-1' , 'class' => 'file-loading', 'placeholder' => 'Upload a file'),
                )
            )
            ->add('avatarFile', FileType::class, array(
                    'required' => false,
                    'label' => 'Upload ur avatr',
                    'label_attr' => array('class' => 'control-label', ),
                    'attr' => array('id' => 'input-folder-1' , 'class' => 'file-loading', 'placeholder' => 'Upload an avatar'),
                )
            )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Post'
        ));
    }
}

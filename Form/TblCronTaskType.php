<?php

namespace Trovit\CronManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * TblCronTaskType Form
 *
 * @package Trovit\CronManagerBundle\Form
 */
class TblCronTaskType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => false))
            ->add('description', null, array('label' => false))
            ->add('command', null, array('label' => false))
            ->add('cronExpression', null, array('label' => false))
            ->add('active', null, array('label' => false, 'required' => false))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Trovit\CronManagerBundle\Entity\TblCronTask'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trovit_cronmanagerbundle_tblcrontask';
    }
}

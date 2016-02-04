<?php

namespace Trovit\CronManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
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

<?php

namespace ScoreBoardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MatchsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('teamA', 'entity', array('class'=>'ScoreBoardBundle\Entity\Team', 'property'=>'team'))
            ->add('teamB', 'entity', array('class'=>'ScoreBoardBundle\Entity\Team', 'property'=>'team'))
            ->add('tournament', 'entity', array('class'=>'ScoreBoardBundle\Entity\Tournament', 'property'=>'name', 'required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ScoreBoardBundle\Entity\Matchs'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'scoreboardbundle_matchs';
    }
}
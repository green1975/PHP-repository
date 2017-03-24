<?php 

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use blackknight467\StarRatingBundle\Form\RatingType as RatingType;


class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title')
        ->add('description')
        ->add('price')
        ->add('user')
        ->add('rating', RatingType::class, [
        'label' => 'Rating'
    ]);

        $builder->add('rating', CollectionType::class, array(
            'entry_type' => RatingproductType::class,
            'allow_add'    => true,
        ))
        ->add('comments', CollectionType::class, array(
            'entry_type' => RatingproductType::class,
            'allow_add'    => true,
        ));


    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_product';
    }


}

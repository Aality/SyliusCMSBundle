<?php
// src/Bundle/SyliusCMSBundle/Form/Type/PageType.php
namespace Aality\SyliusCMSBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;
use Sylius\Bundle\ChannelBundle\Form\Type\ChannelChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Aality\SyliusCMSBundle\Entity\Page\Page;

class PageType extends AbstractResourceType
{
    public function __construct()
    {
        parent::__construct(Page::class);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('slug')
            ->add('title')
            ->add('metaDescription')
            ->add('content')
            ->add('channel', ChannelChoiceType::class, [
                'label' => 'aality_cms_page.ui.associated_channel',
                'choice_label' => 'name',
                'required' => false,
                'placeholder' => 'aality_cms_page.ui.all_channels',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
    }
}

<?php

namespace SendMailBundle\Form\Type;


use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use SendMailBundle\Model\Mail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class MailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, ['label' => 'Email'
            ])
            ->add('subject', TextType::class, ['label' => 'Subject'])
            ->add('content', CKEditorType::class, ['label' => 'Content'])
            ->add('files', FileType::class, ['multiple' => true])
            ->add('save', SubmitType::class, ['label' => 'Send email']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Mail::class,
        ));
    }
}
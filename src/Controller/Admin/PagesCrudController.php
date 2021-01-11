<?php

namespace App\Controller\Admin;

use App\Entity\Pages;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class PagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pages::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('page')
            ->setEntityLabelInPlural('Simple Pages')
            ->setSearchFields(['id', 'title', 'body', 'metatitle', 'keywords', 'description'])
            ->setPageTitle('index', '%entity_label_plural% - view')
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IdField::new('id')->hideOnForm();
        $title = TextField::new('title');
        $slug = TextField::new('slug')->onlyOnForms();
        $body = TextareaField::new('body')->setFormType(CKEditorType::class);
        $metatitle = TextField::new('metatitle')->onlyOnForms()->setFormTypeOption('required',false);
        $keywords = TextField::new('keywords')->onlyOnForms()->setFormTypeOption('required',false);
        $description = TextField::new('description')->onlyOnForms()->setFormTypeOption('required',false);

        return [
            FormField::addPanel('Main Content'),
            $id, $title, $slug, $body,
            FormField::addPanel('SEO Block'),
            $metatitle, $keywords, $description,
        ];
    }
}

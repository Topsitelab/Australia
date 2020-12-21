<?php

namespace App\Controller\Admin;

use App\Entity\Pages;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pages::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}

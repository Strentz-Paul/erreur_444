<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield EmailField::new('email', 'global.email_label');
        yield TextField::new('displayName', 'global.username');
        yield TextEditorField::new('description', 'global.description_label');
        yield TextField::new('linkedinProfilLink', 'global.linkedin');
        yield TextField::new('twitterProfilLink', 'global.twitter');
        yield TextField::new('githubProfilLink', 'global.github');
        yield SlugField::new('slug', 'article.slug_label')->setTargetFieldName('displayName');
    }
}

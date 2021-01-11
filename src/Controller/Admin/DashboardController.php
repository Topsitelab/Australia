<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pages;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Require ROLE_ADMIN for *every* controller method in this class.
 *
 * @IsGranted("ROLE_ADMIN")
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        //return parent::index();

        // Start from some Pages
        $pagesListUrl = $this->get(CrudUrlGenerator::class)->build()->setController(PagesCrudController::class)->generateUrl();

        return $this->redirect($pagesListUrl);

        // Start from template
        //return $this->render('admin/welcome.html.twig');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin Panel');
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setDefaultSort(['id' => 'DESC'])
            ->setPaginatorPageSize(30)
            ->showEntityActionsAsDropdown()
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Home', 'fa fa-home');

        yield MenuItem::section('Content');
        yield MenuItem::linkToCrud('Pages', 'fa fa-file-text', Pages::class);

        //yield MenuItem::section('Дополнительно');
        //yield MenuItem::linkToCrud('Проекты', 'fa fa-file-text', Projects::class);
        //yield MenuItem::linkToCrud('Статьи', 'fa fa-file-text', Articles::class);

        yield MenuItem::section('Settings');
        yield MenuItem::linkToUrl('Google Search', 'fab fa-google', 'https://google.com')->setLinkTarget('_about');
        yield MenuItem::linkToLogout('Log Out', 'fa fa-user-circle-o');
    }
}

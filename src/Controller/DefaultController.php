<?php
declare (strict_types = 1);
namespace MyApp\Controller;
use MyApp\Service\DependencyContainer;
use Twig\Environment;
use MyApp\Model\AdministrateurModel;
use Myapp\Model\BeneficiaireModel;
use Myapp\Model\CircuitModel;

class DefaultController
{
    private $twig;
    private $typeModel;
    private $productModel;
    private $userModel;

    public function __construct(Environment $twig, DependencyContainer $dependencyContainer)
    {
        $this->twig = $twig;
        $this->typeModel = $dependencyContainer->get('TypeModel');
        $this->productModel = $dependencyContainer->get('ProductModel');
        $this->userModel = $dependencyContainer->get('UserModel');
    }
    public function types()
{
$types = $this->typeModel->getAllTypes();
echo $this->twig->render('defaultController/types.html.twig', ['types'=>$types]);
}


    public function home()
    {
        echo $this->twig->render('defaultController/home.html.twig', []);
    }

    public function error404()
    {
        echo $this->twig->render('defaultController/error404.html.twig', []);
    }

    public function error500()
    {
        echo $this->twig->render('defaultController/error500.html.twig', []);

    }
    public function contact()
    {
        echo $this->twig->render('defaultController/contact.html.twig', []);
        
    }
    public function mentionslegales()
    {
        echo $this->twig->render('defaultController/mentionslegales.html.twig', []);
        
    }
   
    public function products()
    {
        $products = $this->productModel->getAllProducts();
        echo $this->twig->render('defaultController/product.html.twig', ['products'=>$products]);
        
    }
    public function register()
    {
        $products = $this->ClientModel->getAllClients();
        echo $this->twig->render('defaultController/register.html.twig', ['clients'=>$clients]);
        
    }
    public function users()
    {
        $users = $this->userModel->getAllUsers();
        echo $this->twig->render('defaultController/users.html.twig', ['users'=>$users]);
        
    }
}

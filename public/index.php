<?php
declare (strict_types = 1);
session_start(); 
require_once __DIR__ . '/../vendor/autoload.php';

use MyApp\Service\DependencyContainer;
use MyApp\Routing\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../', '.env.local');
$dotenv->load();

$container = new DependencyContainer();
$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);
$router = new Router($container);
$twig->addGlobal('session', $_SESSION); // 🔹 Passe $_SESSION à Twig

$router->route($twig);

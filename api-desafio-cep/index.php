<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include('vendor/autoload.php');

use Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\Controller\ContainerControllerResolver;

$dotnev = Dotenv::createImmutable(__DIR__);
$dotnev->load();

// Criar um ContainerBuilder
$containerBuilder = new ContainerBuilder();

// Configurar um carregador YAML para carregar o arquivo services.yaml
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__.'/src/config'));
$loader->load('services.yaml'); // Caminho personalizado para o arquivo de serviços

// $containerBuilder->register(Distance::class, Distance::class);
$containerBuilder->compile(true);

$routes = include ('src/config/routes.php');

$request = Request::createFromGlobals();

$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);
$resolver = new ContainerControllerResolver($containerBuilder);
$argumentResolver = new ArgumentResolver();

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));
    $controller = $resolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);

    $response = call_user_func_array($controller, $arguments);
} catch (ResourceNotFoundException $e) {
    $response = new Response('Not Found', 404);
} catch (Exception $e) {
    $response = new Response('An error occurred', 500);
}

$response->send();

?>
<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Producto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//Hay que importar esta libreria desde la persistencia 
use Doctrine\Persistence\ManagerRegistry;

class PruebaController extends AbstractController
{
    #[Route('/prueba', name: 'app_prueba')]
    public function index(): Response
    {
        return $this->render('prueba/index.html.twig', [
            'controller_name' => 'PruebaController',
        ]);
    }



    #[Route('/persistencia', name: 'persistencia')]

    public function persistirDatos(ManagerRegistry $doctrine){
    $entityManager = $doctrine->getManager();

    $producto=new Producto();
    $producto->setNombre('cable');
    $producto->setCodigo('03');
    $entityManager->persist($producto);
    $entityManager->flush();
    return $this->render('prueba/success.html.twig');
    }



    #[Route('/busquedas/{id}', name: 'busquedas')]

    public function busquedas(ManagerRegistry $doctrine,$id){

    $entityManager = $doctrine->getManager();
    $producto=$entityManager->getRepository(Producto::class)->find(4);

        //Buscando por un atributo especifico: 
    $productos=$entityManager->getRepository(Producto::class)->findOneBy(['codigo'=>'02']);

    $productoss=$entityManager->getRepository(Producto::class)->findBy(['codigo'=>'7845']);

    $productosA=$entityManager->getRepository(Producto::class)->findAll();


    // Consulta implementando un repositorio: 

    $producto2=$entityManager->getRepository(Producto::class)->BuscarProductoPorId($id);


    return $this->render('prueba/busqueda.html.twig',array('find'=>$producto, 
    'findOneBy'=>$productos, 'findBy'=>$productoss, 'findAll'=>$productosA,  'BuscarProductoPorId'=>$producto2));
    }






}

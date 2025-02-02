<?php

namespace App\Controller;

use App\Document\Product;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class ProductController extends AbstractController
{
    #[Route('/add-product', name: 'add_product')]
    public function addProduct(DocumentManager $dm): Response
    {
        $product = new Product();
        $product->setName('Produit Exemple');
        $product->setPrice(19.99);

        $dm->persist($product);
        $dm->flush();

        return new Response('Produit ajouté avec succès : ' . $product->getId());
    }

    #[Route('/list-products', name: 'list_products')]
    public function listProducts(DocumentManager $dm): Response
    {
        $repository = $dm->getRepository(Product::class);
        $products = $repository->findAll();

        // Ajouter un groupe "product:read" pour sérialiser uniquement les champs configurés
        return $this->json($products, 200, [], [
            AbstractNormalizer::GROUPS => ['product:read'],
        ]);
    }
}
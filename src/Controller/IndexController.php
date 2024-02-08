<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Recette;

class IndexController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/index', name: 'app_index')]
    public function index(): Response
    {
        $recettes = $this->entityManager->getRepository(Recette::class)->findAll();

        $code_barre = '3017620422003';
        $api_url = "https://world.openfoodfacts.org/api/v2/product/$code_barre";

        $response = file_get_contents($api_url);

        if ($response !== false) {
            $product_data = json_decode($response, true);

            if ($product_data && $product_data['status'] === 1) {
                $energy = $product_data['product']['nutriments']['energy-kcal'] ?? 0;
                $saturated_fat = $product_data['product']['nutriments']['saturated-fat'] ?? 0;
                $sugars = $product_data['product']['nutriments']['sugars'] ?? 0;
                $proteins = $product_data['product']['nutriments']['proteins'] ?? 0;
                $fiber = $product_data['product']['nutriments']['fiber'] ?? 0;

                // Calcul du Nutri-Score (formule simplifiée)
                $nutri_score = $energy + $saturated_fat + $sugars - $proteins - $fiber;

            } else {
                echo "Aucune information disponible pour le code-barres $code_barre.";
            }
        } else {
            echo "Erreur lors de la récupération des données depuis l'API Open Food Facts.";
        }

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'recettes' => $recettes,
            'nutriscore' => $nutri_score
        ]);
    }
}
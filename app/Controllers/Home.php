<?php

namespace App\Controllers;

use App\Libraries\ProductCatalog;

class Home extends BaseController
{
    private ProductCatalog $catalog;

    public function __construct()
    {
        $this->catalog = new ProductCatalog();
    }

    public function index(): string
    {
        return view('V_accueil');
    }

    public function vetement(): string
    {
        return view('V_category', $this->categoryData('vetements'));
    }

    public function homme(): string
    {
        return view('V_category', $this->categoryData('homme'));
    }

    public function chaussures(): string
    {
        return view('V_category', $this->categoryData('chaussures'));
    }

    public function jalabe(): string
    {
        return view('V_category', $this->categoryData('jalabe'));
    }

    public function parfum(): string
    {
        return view('V_category', $this->categoryData('parfum'));
    }

    public function admin(): string
    {
        return view('V_admin');
    }

    private function categoryData(string $category): array
    {
        $themes = [
            'vetements' => [
                'pageTitle' => 'Vetements - Astou Global SHOP',
                'pageHeading' => 'Tous nos vetements',
                'pageDescription' => 'Retrouvez tous les vetements disponibles avec prix et commande directe sur WhatsApp.',
                'pageClass' => 'theme-vetements',
                'heroImage' => 'assets/img/HF2.jpeg',
                'theme' => [
                    'page_bg' => '#eef4ff',
                    'nav_bg' => '#0d3b8e',
                    'nav_bg_dark' => '#082a6b',
                    'primary' => '#1f6bff',
                    'primary_light' => '#49a2ff',
                    'text_main' => '#14305f',
                    'text_muted' => '#55709f',
                    'shadow_soft' => '0 18px 40px rgba(17, 71, 183, 0.12)',
                    'shadow_card' => '0 14px 32px rgba(20, 48, 95, 0.12)',
                ],
            ],
            'homme' => [
                'pageTitle' => 'Homme - Astou Global SHOP',
                'pageHeading' => 'Toutes nos tenues homme',
                'pageDescription' => 'Retrouvez toutes les tenues homme disponibles avec prix et commande directe sur WhatsApp.',
                'pageClass' => 'theme-homme',
                'heroImage' => 'assets/img/HH1.jpeg',
                'theme' => [
                    'page_bg' => '#edf1f5',
                    'nav_bg' => '#1e2c3a',
                    'nav_bg_dark' => '#121b24',
                    'primary' => '#2f5d8a',
                    'primary_light' => '#4d7daa',
                    'text_main' => '#1f2f3c',
                    'text_muted' => '#607180',
                    'shadow_soft' => '0 18px 40px rgba(30, 44, 58, 0.12)',
                    'shadow_card' => '0 14px 32px rgba(31, 47, 60, 0.12)',
                ],
            ],
            'chaussures' => [
                'pageTitle' => 'Chaussures - Astou Global SHOP',
                'pageHeading' => 'Toutes nos chaussures',
                'pageDescription' => 'Retrouvez tous les modeles de chaussures disponibles avec prix et commande WhatsApp.',
                'pageClass' => 'theme-chaussures',
                'heroImage' => 'assets/img/C2.jpeg',
                'theme' => [
                    'page_bg' => '#fff7ef',
                    'nav_bg' => '#935c0d',
                    'nav_bg_dark' => '#6e4308',
                    'primary' => '#d8841c',
                    'primary_light' => '#f3aa46',
                    'text_main' => '#5f3b14',
                    'text_muted' => '#95704a',
                    'shadow_soft' => '0 18px 40px rgba(147, 92, 13, 0.12)',
                    'shadow_card' => '0 14px 32px rgba(95, 59, 20, 0.12)',
                ],
            ],
            'jalabe' => [
                'pageTitle' => 'Jalabe - Astou Global SHOP',
                'pageHeading' => 'Tous nos jalabes',
                'pageDescription' => 'Retrouvez tous les modeles de jalabe disponibles avec prix et commande WhatsApp.',
                'pageClass' => 'theme-jalabe',
                'heroImage' => 'assets/img/jalabe2.jpg',
                'theme' => [
                    'page_bg' => '#f4f8ef',
                    'nav_bg' => '#3a6b1c',
                    'nav_bg_dark' => '#284c12',
                    'primary' => '#5e9d2f',
                    'primary_light' => '#82c54d',
                    'text_main' => '#274615',
                    'text_muted' => '#65844e',
                    'shadow_soft' => '0 18px 40px rgba(58, 107, 28, 0.12)',
                    'shadow_card' => '0 14px 32px rgba(39, 70, 21, 0.12)',
                ],
            ],
            'parfum' => [
                'pageTitle' => 'Parfum - Astou Global SHOP',
                'pageHeading' => 'Tous nos parfums',
                'pageDescription' => 'Retrouvez tous les parfums disponibles avec prix et commande directe sur WhatsApp.',
                'pageClass' => 'theme-parfum',
                'heroImage' => 'assets/img/blue_chanel.jpg',
                'theme' => [
                    'page_bg' => '#f8f1f1',
                    'nav_bg' => '#7b2233',
                    'nav_bg_dark' => '#5b1623',
                    'primary' => '#c94865',
                    'primary_light' => '#ec6a87',
                    'text_main' => '#561824',
                    'text_muted' => '#8e4e5c',
                    'shadow_soft' => '0 18px 40px rgba(123, 34, 51, 0.12)',
                    'shadow_card' => '0 14px 32px rgba(86, 24, 36, 0.12)',
                ],
            ],
        ];

        return array_merge(
            $themes[$category],
            [
                'category' => $category,
                'products' => $this->catalog->category($category),
            ]
        );
    }
}

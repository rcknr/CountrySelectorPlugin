<?php declare(strict_types=1);

namespace CountrySelectorPlugin\Storefront\Controller;

use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @RouteScope(scopes={"storefront"})
 */
class CountryController extends StorefrontController
{
    /**
     * @Route("/countries", name="frontend.countries.modal", methods={"GET","POST"}, defaults={"XmlHttpRequest"=true})
     */
    public function showCountries(Request $request): Response
    {
        if ($request->isXmlHttpRequest()) {
            $countries = Countries::getNames();

            return $this->renderStorefront('@CountrySelectorPlugin/storefront/countries.html.twig', [
                'country' => $request->cookies->get('country'),
                'options' => $countries,
            ]);
        }

        return $this->redirect('/');
    }
}

<?php

namespace App\Controller;

use App\Enum\Product\ProductSortableDirectionEnum;
use App\Enum\Product\ProductSortableFieldEnum;
use App\View\Product\List\ProductListViewFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route(
        '/products/{page}',
        requirements: ['page' => '\d+'],
        methods: 'GET'
    )]
    public function productsList(
        Request $request,
        ProductListViewFactory $productListViewFactory,
        ?int $page = 1
    ): Response {
        // here can be page validation, like when page * products per page > all products count

        // query params can be moved to 1 place, and view can build request params using this names from 1 place
        $sortByParam = $request->query->get('sortBy');
        $sortBy = ProductSortableFieldEnum::tryFrom($sortByParam) ?? ProductSortableFieldEnum::CREATED_AT;

        $sortDirectionParam = $request->query->get('sortDirection');
        $sortDirection = ProductSortableDirectionEnum::tryFrom($sortDirectionParam) ?? ProductSortableDirectionEnum::DESC;

        $productListView = $productListViewFactory->create(
            $page,
            $sortBy,
            $sortDirection
        );

        // this solution can be improved via attribute, that configure template/templates, twig variable name
        // this attribute can be prepared for \Symfony\Component\HttpKernel\KernelEvents::CONTROLLER event
        // for response and controller can return only view class and after response can be created
        // in listener for \Symfony\Component\HttpKernel\KernelEvents::VIEW event
        return $this->render('products_list.html.twig', [
            'productListView' => $productListView,
        ]);
    }
}

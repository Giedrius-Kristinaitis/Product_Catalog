<?php

namespace App\Http\View\Composers;

use App\Http\View\Composers\Product\AppliedDiscountDecorator;
use App\Http\View\Composers\Product\CalculatedPriceDecorator;
use App\Http\View\Composers\Product\CalculatedPriceWithoutDiscountDecorator;
use App\Http\View\Composers\Product\ImageUrlDecorator;
use App\Http\View\Composers\Product\ProductComposer;
use App\Http\View\Composers\Product\RatingDecorator;
use App\Http\View\Composers\Product\TaxRateDecorator;
use App\Product\Price\DiscountProviderInterface;
use App\Product\Price\PriceCalculator;
use App\Repository\ProductRepositoryInterface;
use App\Settings\SettingProvider;
use App\Utils\Url\UrlGeneratorInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class DetailedProductComposer
 *
 * Composes products to be displayed in product details page
 *
 * @package App\Http\View\Composers
 */
class DetailedProductComposer
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var PriceCalculator Calculates product prices
     */
    protected $price_calculator;

    /**
     * @var ProductRepositoryInterface
     */
    protected $product_repository;

    /**
     * @var UrlGeneratorInterface
     */
    protected $url_generator;

    /**
     * @var DiscountProviderInterface
     */
    protected $discount_provider;

    /**
     * @var SettingProvider
     */
    protected $settings;

    /**
     * DetailedProductComposer constructor.
     *
     * @param Request $request
     * @param PriceCalculator $price_calculator
     * @param ProductRepositoryInterface $product_repository
     * @param UrlGeneratorInterface $url_generator
     * @param DiscountProviderInterface $discount_provider
     * @param SettingProvider $settings
     */
    public function __construct(Request $request, PriceCalculator $price_calculator, ProductRepositoryInterface $product_repository, UrlGeneratorInterface $url_generator, DiscountProviderInterface $discount_provider, SettingProvider $settings)
    {
        $this->request = $request;
        $this->price_calculator = $price_calculator;
        $this->product_repository = $product_repository;
        $this->url_generator = $url_generator;
        $this->discount_provider = $discount_provider;
        $this->settings = $settings;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view): void
    {
        $product = $this->product_repository->getById($this->request->route('id'));

        $composer = new ImageUrlDecorator(
            new CalculatedPriceDecorator(
                new CalculatedPriceWithoutDiscountDecorator(
                    new AppliedDiscountDecorator(
                        new RatingDecorator(
                            new TaxRateDecorator(
                                new ProductComposer(),
                                $this->settings
                            ),
                            $this->product_repository
                        ),
                        $this->discount_provider
                    ),
                    $this->price_calculator
                ),
                $this->price_calculator
            ),
            $this->url_generator
        );

        $composer->compose($product);

        $view->with('product', $product);
    }
}
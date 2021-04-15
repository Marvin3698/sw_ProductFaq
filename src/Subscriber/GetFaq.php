<?php declare(strict_types=1);

namespace ProductFaq\Subscriber;

use Shopware\Core\Content\Product\Events\ProductListingCriteriaEvent;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Event\EntityLoadedEvent;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\NotFilter;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\Content\Product\ProductEvents;

use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Core\Defaults;
use Shopware\Core\Framework\Context;

class GetFaq implements EventSubscriberInterface
{

    private $product_faqRepo;

    public function __construct(SystemConfigService $systemConfigService,EntityRepositoryInterface $product_faqRepo)
    {
        $this->product_faqRepo=$product_faqRepo;

    }

    public static function getSubscribedEvents(): array
    {
        // Return the events to listen to as array like this:  <event to listen to> => <method to execute>
        return [
            ProductPageLoadedEvent::class => 'onProductsLoaded'
        ];
    }

    public function onProductsLoaded(ProductPageLoadedEvent $event)
    {
        $context = $event->getContext();

        $entities = $this->product_faqRepo->search(new Criteria(), $context);
        $ent = ($entities->getElements());
        if (sizeof($ent) > 0) {
            $key = array_keys($ent);
            for ($i = 0; $i < sizeof($ent); $i++) {
                $result[$i] = $ent[$key[$i]];
            }
            dump($result);
            $event->getContext()->setExtensions($result);
        }

    }
}

<?php declare(strict_types=1);

namespace ma\ProductFaq\Subscriber;

use Shopware\Core\Content\Product\Events\ProductListingCriteriaEvent;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Event\EntityLoadedEvent;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\NotFilter;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\Content\Product\ProductEvents;

use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\System\SystemConfig\SystemConfigService;

class GetFaq implements EventSubscriberInterface
{

    private $productFaqRepository;

    public function __construct(SystemConfigService $systemConfigService,EntityRepositoryInterface $productFaqRepository)
    {
        $this->productFaqRepository=$productFaqRepository;

    }

    public static function getSubscribedEvents(): array
    {
        // Return the events to listen to as array like this:  <event to listen to> => <method to execute>
        return [
            ProductListingCriteriaEvent::class => 'onProductsLoaded'
        ];
    }

    public function onProductsLoaded(EntityLoadedEvent $event)
    {
        $criteria = new criteria();
        $entities = $this->productFaqRepository->search(
            $criteria->addFilter(
                new NotFilter(
                    NotFilter::CONNECTION_OR,
                    [
                        new EqualsFilter('id', '999999'),
                    ]
                )
            ), \Shopware\Core\Framework\Context::createDefaultContext()

        );

        $ent = ($entities->getElements());
        if(sizeof($ent)>0){
            $key = array_keys($ent);
            for ($i = 0; $i < sizeof($ent); $i++) {
                $result[$i] = $ent[$key[$i]];
            }
            dump($result);
            $event->getContext()->setExtensions($result);
        }

    }

}

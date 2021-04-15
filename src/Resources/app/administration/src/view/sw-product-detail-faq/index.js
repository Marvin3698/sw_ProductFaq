import template from './sw-product-detail-faq.html.twig';

Shopware.Component.register('sw-product-detail-custom', {
    template,

    metaInfo() {
        return {
            title: 'FAQ'
        };
    },
});

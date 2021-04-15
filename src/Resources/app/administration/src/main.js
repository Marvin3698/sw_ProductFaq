import './page/sw-product-detail';
import './view/sw-product-detail-faq';
import './app/component/product-faq/product-faq';


Shopware.Module.register('sw-new-tab-faq', {
    routeMiddleware(next, currentRoute) {
        if (currentRoute.name === 'sw.product.detail') {
            currentRoute.children.push({
                name: 'sw.product.detail.faq',
                path: '/sw/product/detail/:id/faq',
                component: 'product-faq',
                meta: {
                    parentPath: "sw.product.index"
                }
            });
        }
        next(currentRoute);
    }
});

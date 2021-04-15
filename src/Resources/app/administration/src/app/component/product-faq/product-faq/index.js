import template from './product-faq.html.twig'
import './product-faq.scss'

const { Component } = Shopware;
const { Criteria } = Shopware.Data;

Shopware.Component.register('product-faq', {
   template,


    inject: [
        'repositoryFactory'
    ],
    data() {
        return {
            result:[],
            question:'',
            answer:'',
            product_id:'',
            entity: undefined


        }
    },

    created() {
        const productFaqRepo = this.repositoryFactory.create('product_faq');// add product-faq repository
        this.entity = productFaqRepo.create(Shopware.Context.api); // to save entity
        let url=window.location.href;
        console.log(url.slice(42,74));
        console.log(productFaqRepo);
        this.product_id=url.slice(42,74);
        const id = 'B7AD92202335401F8F33910C9228AC69 ';

        productFaqRepo
            .get(id, Shopware.Context.api)
            .then(entity => {
                this.entity = entity;
                console.log(this.entity);
            });

    },methods: {

        add: function () {
            const productFaqRepo = this.repositoryFactory.create('product_faq');// add product-faq repository

            alert();
            this.entity = productFaqRepo.create(Shopware.Context.api);

            this.entity.product_id = this.product_id;
            this.entity.question = this.question;
            this.entity.answer = this.answer;

            productFaqRepo.save(this.entity, Shopware.Context.api);

        },

    }
});

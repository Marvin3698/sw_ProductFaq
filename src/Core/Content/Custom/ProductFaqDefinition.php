<?php declare(strict_types=1);

namespace ProductFaq\Core\Content\Custom;

use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;

class ProductFaqDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'product_faq';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return ProductFaqCollection::class;
    }

    public function getEntityClass(): string
    {
        return ProductFaqEntity::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
            (new IdField('product_id', 'product_id')),
            (new StringField('question', 'question')),
            new StringField('answer', 'answer'),

        ]);
    }
}

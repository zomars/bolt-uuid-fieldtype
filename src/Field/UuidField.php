<?php

namespace Bolt\Extension\Zomars\UuidFieldType\Field;

use Bolt\Storage\EntityManager;
use Bolt\Storage\Field\Type\FieldTypeBase;
use Bolt\Storage\QuerySet;
use Ramsey\Uuid\Uuid;

class UuidField extends FieldTypeBase
{

    public function persist(QuerySet $queries, $entity, EntityManager $em = null)
    {
        $key = $this->mapping['fieldname'];
        $qb = $queries->getPrimary();
        $value = $entity->get($key);

        if (!$value) {
            $value = sha1(Uuid::uuid4()->toString());
        }

        $qb->setValue($key, ':' . $key);
        $qb->set($key, ':' . $key);
        $qb->setParameter($key, (string)$value);
    }

    public function hydrate($data, $entity)
    {
        $key = $this->mapping['fieldname'];

        $val = isset($data[$key]) ? $data[$key] : null;
        if ($val !== null) {
            $this->set($entity, $val);
        }
    }

    public function getName()
    {
        return 'uuid';
    }

    public function getTemplate()
    {
        return 'fields/_uuid.twig';
    }

    public function getStorageType()
    {
        return 'string';
    }

    public function getStorageOptions()
    {
        return ['default' => ''];
    }
}

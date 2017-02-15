<?php

namespace Bolt\Extension\Zomars\UuidFieldType\Field;

use Bolt\Field\FieldInterface;

class UuidField implements FieldInterface
{

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
        return 'text';
    }

    public function getStorageOptions()
    {
        return ['default' => ''];
    }
}

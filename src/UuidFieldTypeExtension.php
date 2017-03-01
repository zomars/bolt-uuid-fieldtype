<?php

namespace Bolt\Extension\Zomars\UuidFieldType;

use Bolt\Extension\Zomars\UuidFieldType\Provider\FieldProvider;
use Bolt\Extension\SimpleExtension;

/**
 * Uuid Field Type extension class.
 *
 * @author zomars <zomars@me.com>
 */
class UuidFieldTypeExtension extends SimpleExtension
{

    /**
     * {@inheritdoc}
     */
    public function getServiceProviders()
    {
        return [
            $this,
            new FieldProvider()
        ];
    }

    protected function registerTwigPaths()
    {
        return [
            'templates'
        ];
    }
}

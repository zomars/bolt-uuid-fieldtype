<?php

namespace Bolt\Extension\Zomars\UuidFieldType\Provider;

use Bolt\Extension\Zomars\UuidFieldType\Field\UuidField;
use Bolt\Storage\FieldManager;
use Silex\Application;
use Silex\ServiceProviderInterface;

class FieldProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['storage.typemap'] = array_merge(
            $app['storage.typemap'],
            [
                'uuid' => UuidField::class
            ]
        );

        $app['storage.field_manager'] = $app->share(
            $app->extend(
                'storage.field_manager',
                function (FieldManager $manager) {
                    $manager->addFieldType('uuid', new UuidField());

                    return $manager;
                }
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
    }
}

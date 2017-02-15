<?php

namespace Bolt\Extension\Zomars\UuidFieldType;

use Bolt\Extension\SimpleExtension;
use Bolt\Extension\Zomars\UuidFieldType\Field;
use Bolt\Events\StorageEvents;
use Bolt\Events\StorageEvent;
use Ramsey\Uuid\Uuid;

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
    public static function getSubscribedEvents()
    {
        return [
            StorageEvents::PRE_SAVE => [
                ['preSave', 0],
            ],
        ];
    }

    /**
     * StorageEvents::PRE_SAVE event callback.
     *
     * @param StorageEvent $event
     */
    public function preSave(StorageEvent $event)
    {
        // You're an angel @rossriley
        $app = $this->getContainer();

        $record = $event->getContent();
        $ct = $record->getContenttype();

        $values = $record->serialize();

        foreach ($values as $fieldname => $value) {
            $metadata = $app['storage']->getMapper()->getFieldMetadata((string)$ct, $fieldname);

            if ($metadata['data']['type'] === 'uuid' && !$value) {
                $record->set($fieldname, sha1(Uuid::uuid4()->toString()));
            }
        }
    }

    public function registerFields()
    {
        return [
            new Field\UuidField(),
        ];
    }

    protected function registerTwigPaths()
    {
        return [
            'templates'
        ];
    }
}

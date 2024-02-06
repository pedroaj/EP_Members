<?php

namespace App\Utils\Doctrine;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Doctrine\ORM\Mapping\MappingException;
use Doctrine\Persistence\Mapping\ClassMetadata;
use Doctrine\Persistence\Mapping\Driver\AnnotationDriver as AbstractAnnotationDriver;

class HybridMappingDriver extends AbstractAnnotationDriver {
    public function __construct(
        private AnnotationDriver $annotationDriver,
        private AttributeDriver $attributeDriver
    ) {
    }

    public function loadMetadataForClass($className, ClassMetadata $metadata): void {
        try {
            $this->attributeDriver->loadMetadataForClass($className, $metadata);
            return;
        } catch (MappingException $me) {
            // If the class isn't a valid entity, try the other driver
            if (!preg_match('/^Class (.)*$/', $me->getMessage())) {
                throw $me;
            }
        }
        $this->annotationDriver->loadMetadataForClass($className, $metadata);
    }

    public function isTransient($className): bool {
        return $this->attributeDriver->isTransient($className)
            || $this->annotationDriver->isTransient($className);
    }
}

<?php
namespace Med\UploadBundle\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Reflection\ReflectionClass;

/**
* this class will be user to get params from the annotation system
* and after that it will aliment the doctrine event
*
* to get the UplodableField we should create a service
*/
class UploadAnnotationReader
{
	/**
	* @var AnnotationReader $reader
	*/
	private $reader;

	function __construct(AnnotationReader $reader)
	{
		$this->reader = $reader;
	}

	/**
	* @param \BaseEntity $erntity
	* @return bool
	*/
	public function isUploadable($entity)
	{
        //Get class annotation
        $reflectionClass = new \ReflectionClass(get_class($entity));
        return $this->reader->getClassAnnotation($reflectionClass, \Med\UploadBundle\Annotation\Uploadable::class)!==null;
	}

	/**
	* @param $entity
	* @return array
	*/
	public function getUploadableFields($entity)
	{
		$reflectionClass = new \ReflectionClass(get_class($entity));

		if (!$this->isUploadable($entity))
		{
			return [];
		}

		$properties = array();

		foreach ($reflectionClass->getProperties() as $property) {
			$annotation = $this->reader->getPropertyAnnotation($property,  \Med\UploadBundle\Annotation\UploadableField::class);
			if ( $annotation !== null){
				$properties[$property->getName()] = $annotation;
			}
		}

		/**
		* get the proprties with the annotation Uplodable
		*/
		return $properties;
	}
}
<?php

namespace Med\UploadBundle\Handler;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\HttpFoundation\File\File;
/**
* 
*/
class UploadHandler
{
	/**
	* @var PropertyAccess $accessor
	*/
	private $accessor;

	function __construct()
	{
		$this->accessor = PropertyAccess::createPropertyAccessor();

	}

	/**
	* Upload file traitement
	* @param $entity
	* @param $property
	* @param $annotation
	*/
	public function uploadFile($entity, $property, $annotation)
	{
		$file = $this->accessor->getValue($entity, $property);
		//dump($file, $entity, $property, $annotation, $file instanceof UploadedFile); die;
		if($file instanceof UploadedFile)
		{	
			$this->removeOldFile($entity, $property, $annotation);
			$filename = $file->getClientoriginalname();
			$file->move($annotation->getPath(), $filename);
			$this->accessor->setValue($entity, $annotation->getFilename(), $filename);
		}
	}

	/**
	* set filename from property file 
	* @param $entity
	* @param $property
	* @param $annotation
	*/
	public function setFileFromFilename($entity, $property, $annotation)
	{
		// we will use a symfony class to get the get method of the property
		$file = $this->getFileFromFilename($entity, $annotation);
		$this->accessor->setValue($entity, $annotation->getFilename(), $file);
	}

	/**
	* remove old file in update case
	* @param $entity
	* @param $property
	* @param $annotation
	*/
	public function removeOldFile($entity, $property, $annotation)
	{
		$file = $this->getFileFromFilename($entity,  $annotation);
		if ($file !== null) {
			@unlink($file->getRealPath());
		}
	}

	/**
	* @param $entity
	* @param $annotation
	* @return File|null
	*/
	private function getFileFromFilename($entity, $annotation)
	{
		// we will use a symfony class to get the get method of the property
		$filename = $this->accessor->getValue($entity, $annotation->getFilename());
		if (empty($filename)) {
			return null;
		} else {
			return new File($annotation->getpath().DIRECTORY_SEPARATOR.$filename, false);
		}
	}

	public function removeFile($entity, $property, $annotation)
	{
		//$file = $this->accessor->getValue($entity, $property);
		$file = $this->accessor->getValue($entity, $annotation->getFilename());
		if ($file instanceof File) {
			@unlink($file->getRealPath());
		}
	}
}
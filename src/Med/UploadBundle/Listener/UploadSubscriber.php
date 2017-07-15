<?php

namespace Med\UploadBundle\Listener;
use  Doctrine\Common\EventSubscriber;
use  Doctrine\Common\EventArgs;
use Med\UploadBundle\Annotation\UploadAnnotationReader;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Med\UploadBundle\Handler\UploadHandler;

/**
* 
*/
class UploadSubscriber implements EventSubscriber 
{
	/**
	* @var UploadAnnotationReader $reader
	*/
	private $reader;
	
	/**
	* @var UploadHandler $handler
	*/
	private $handler;

	/**
	* @param UploadAnnotationReader $reader
	*/
	public function __construct(UploadAnnotationReader $reader, UploadHandler $handler)
	{
		$this->reader = $reader;
		$this->handler = $handler;
	}

	/**
	* @return array
	*/
	public function getSubscribedEvents()
	{
		return [ 'prePersist' , 'preUpdate',  'postLoad', 'postRemove' ];
	}

	/**
	* @param EventArgs $event
	*/
	public function prePersist(EventArgs $event)
	{
		$this->preEvent($event);
	}


	/**
	* @param EventArgs $event
	*/
	public function preUpdate(EventArgs $event)
	{
		$this->preEvent($event);
	}

	private function preEvent(EventArgs $event)
	{
		$entity = $event->getEntity();
		$uploadableFields  = $this->reader->getUploadableFields($entity);
		foreach ($uploadableFields as $property => $annotation) {
			$this->handler->uploadFile($entity, $property, $annotation);
		}
	}


	/**
	* @param EventArgs $event
	*/
	public function postLoad(EventArgs $event)
	{
		$entity = $event->getEntity();
		$uploadableFields  = $this->reader->getUploadableFields($entity);
		foreach ($uploadableFields as $property => $annotation) {
			$this->handler->setFileFromFilename($entity, $property, $annotation);
		}
	}

	public function postRemove(EventArgs $event)
	{
		$entity = $event->getEntity();
		$uploadableFields  = $this->reader->getUploadableFields($entity);
		foreach ($uploadableFields as $property => $annotation) {
			$this->handler->removeFile($entity, $property, $annotation);
		}
	}


}
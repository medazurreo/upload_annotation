<?php
namespace Med\UploadBundle\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;

/**
* @Annotation
* @Target("PROPERTY")
*/
class UploadableField
{
	/**
	* @var string $filename
	*/
	private $filename;
	
	/**
	* @var string $path
	*/
	private $path;

	function __construct(array $options )
	{
		if (empty($options['filename'])) {
			throw new \InvalidArgumentException("Annotation Error, l'attribut 'filename' est obligatoire");
		}

		if (empty($options['path'])) {
			throw new \InvalidArgumentException("Annotation Error, l'attribut 'path' est obligatoire");
		}

		$this->filename = $options['filename'];
		$this->path = $options['path'];
	}

	/**
	* @return string
	*/
	public function getPath()
	{
		return $this->path;
	}

	/**
	* @return string
	*/
	public function getFilename()
	{
		return $this->filename;
	}
}
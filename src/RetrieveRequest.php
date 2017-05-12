<?php namespace ATDev\Commweb;

/**
 * Class to get info about transaction
 */
class RetrieveRequest extends RequestAbstract {

	/** @var string Api operation */
	protected $apiOperation = 'RETRIEVE_TRANSACTION';
	/** @var string Request method */
	protected $method = 'GET';

	/**
	 * Specifies what has to be returned on serialization to json
	 *
	 * @return array Data to serialize
	 */
	public function jsonSerialize() {

		return [
			"apiOperation" => $this->apiOperation
		];
	}
}
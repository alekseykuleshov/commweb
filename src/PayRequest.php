<?php namespace ATDev\Commweb;

/**
 * An abstract class to init the transaction
 */
abstract class PayRequestAbstract extends RequestAbstract {

	/** @var \ATDev\Commweb\SourceOfFunds Source of funds for the transaction */
	private $sourceOfFunds;

	/**
	 * Sets source of funds of request
	 *
	 * @param \ATDev\Commweb\SourceOfFunds $sourceOfFunds
	 *
	 * @return \ATDev\Commweb\PayRequestAbstract
	 */
	public function setSourceOfFunds(SourceOfFunds $sourceOfFunds) {

		$this->sourceOfFunds = $sourceOfFunds;

		return $this;
	}

	/**
	 * Specifies what has to be returned on serialization to json
	 *
	 * @return array Data to serialize
	 */
	public function jsonSerialize() {

		$result = [
			"apiOperation" => $this->apiOperation,
			"order" => $this->order
		];

		if ( ! empty($this->sourceOfFunds) ) {

			$result["sourceOfFunds"] = $this->sourceOfFunds;
		}

		return $result;
	}
}

/**
 * Class to authorize the transaction
 */
class AuthorizeRequest extends PayRequestAbstract {

	protected $apiOperation = 'AUTHORIZE';
}

/**
 * Class to make payment transaction
 */
class PayRequest extends PayRequestAbstract {

	protected $apiOperation = 'PAY';
}

/**
 * Class just to verify card data before the transaction
 */
class VerifyRequest extends PayRequestAbstract {

	protected $apiOperation = 'VERIFY';
}
<?php namespace ATDev\Commweb;

abstract class PayRequestAbstract extends RequestAbstract {

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

		return [
			"apiOperation" => $this->apiOperation,
			"sourceOfFunds" => $this->sourceOfFunds,
			"order" => $this->order,
		];
	}
}

class AuthorizeRequest extends PayRequestAbstract {

	protected $apiOperation = 'AUTHORIZE';
}

class PayRequest extends PayRequestAbstract {

	protected $apiOperation = 'PAY';
}

class VerifyRequest extends PayRequestAbstract {

	protected $apiOperation = 'VERIFY';
}
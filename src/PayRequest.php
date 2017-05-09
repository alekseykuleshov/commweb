<?php namespace ATDev\Commweb;

abstract class PayRequestAbstract extends RequestAbstract {

	private $sourceOfFunds;

	public function setSourceOfFunds(SourceOfFunds $sourceOfFunds) {

		$this->sourceOfFunds = $sourceOfFunds;

		return $this;
	}

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
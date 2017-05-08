<?php namespace AK\Commweb;

class Transaction implements \JsonSerializable {

	private $id;
	private $amount;
	private $currency = 'AUD';

	public function __construct($id, $amount, $currency) {

		$this->setId($id);
		$this->setAmount($amount);
		$this->setCurrency($currency);
	}

	public function setId($id) {

		$this->id = $id;
	}

	public function getId() {

		return $this->id;
	}

	public function setAmount($amount) {

		$this->amount = $amount;
	}

	public function setCurrency($currency) {

		$this->currency = $currency;
	}

	public function jsonSerialize() {

		return [
			"amount" => $this->amount,
			"currency" => $this->currency
		];
	}
}
<?php namespace ATDev\Commweb;

class Order implements \JsonSerializable {

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

		return $this;
	}

	public function getId() {

		return $this->id;
	}

	public function setAmount($amount) {

		$this->amount = $amount;

		return $this;
	}

	public function setCurrency($currency) {

		$this->currency = $currency;

		return $this;
	}

	public function jsonSerialize() {

		return [
			"amount" => $this->amount,
			"currency" => $this->currency
		];
	}
}
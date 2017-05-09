<?php namespace ATDev\Commweb;

class Transaction implements \JsonSerializable {

	private $id;
	private $amount;
	private $currency = 'AUD';

	/**
	 * Class constructor
	 *
	 * @param string $id Transaction id
	 * @param string $amount Transaction amount
	 * @param string $currency Transaction currency
	 */
	public function __construct($id, $amount, $currency) {

		$this->setId($id);
		$this->setAmount($amount);
		$this->setCurrency($currency);
	}

	/**
	 * Sets transaction id
	 *
	 * @param string $id
	 *
	 * @return \ATDev\Commweb\Transaction
	 */
	public function setId($id) {

		$this->id = $id;

		return $this;
	}

	/**
	 * Gets transaction id
	 *
	 * @return string
	 */
	public function getId() {

		return $this->id;
	}

	/**
	 * Sets transaction amount
	 *
	 * @param string $amount
	 *
	 * @return \ATDev\Commweb\Transaction
	 */
	public function setAmount($amount) {

		$this->amount = $amount;

		return $this;
	}

	/**
	 * Sets transaction currency
	 *
	 * @param string $currency
	 *
	 * @return \ATDev\Commweb\Transaction
	 */
	public function setCurrency($currency) {

		$this->currency = $currency;

		return $this;
	}

	/**
	 * Specifies what has to be returned on serialization to json
	 *
	 * @return array Data to serialize
	 */
	public function jsonSerialize() {

		return [
			"amount" => $this->amount,
			"currency" => $this->currency
		];
	}
}
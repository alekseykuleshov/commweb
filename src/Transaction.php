<?php namespace ATDev\Commweb;

/**
 * Transaction class
 */
class Transaction implements \JsonSerializable {

	/** @var string Transaction id */
	private $id;
	/** @var string Transaction amount */
	private $amount;
	/** @var string Transaction currency */
	private $currency = 'AUD';

	/**
	 * Class constructor
	 *
	 * @param string $id Transaction id
	 * @param string|null $amount Transaction amount
	 * @param string|null $currency Transaction currency
	 */
	public function __construct($id, $amount = null, $currency = null) {

		$this->setId($id);

		if ( ! empty($amount) ) {

			$this->setAmount($amount);
		}

		if ( ! empty($currency)) {

			$this->setCurrency($currency);
		}
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

		if ( in_array($currency, Currency::getAvailableCurrencies()) ) {

			$this->currency = $currency;
		}

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
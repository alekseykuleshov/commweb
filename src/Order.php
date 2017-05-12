<?php namespace ATDev\Commweb;

/**
 * Order class
 */
class Order implements \JsonSerializable {

	/** @var string Order id */
	private $id;
	/** @var string Order amount */
	private $amount;
	/** @var string Order currency */
	private $currency = 'AUD';

	/**
	 * Class constructor
	 *
	 * @param string $id Order id
	 * @param string|null $amount Order amount
	 * @param string|null $currency Order currency
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
	 * Sets order id
	 *
	 * @param string $id
	 *
	 * @return \ATDev\Commweb\Order
	 */
	public function setId($id) {

		$this->id = $id;

		return $this;
	}

	/**
	 * Gets order id
	 *
	 * @return string
	 */
	public function getId() {

		return $this->id;
	}

	/**
	 * Sets order amount
	 *
	 * @param string $amount
	 *
	 * @return \ATDev\Commweb\Order
	 */
	public function setAmount($amount) {

		$this->amount = $amount;

		return $this;
	}

	/**
	 * Sets order currency
	 *
	 * @param string $currency
	 *
	 * @return \ATDev\Commweb\Order
	 */
	public function setCurrency($currency) {

		if ( in_array($currency, Currency::getAvailable()) ) {

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
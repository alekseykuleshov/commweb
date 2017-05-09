<?php namespace ATDev\Commweb;

class Card implements \JsonSerializable {

	private $number;
	private $month;
	private $year;
	private $securityCode;

	/**
	 * Class constructor
	 *
	 * @param string $number Card number
	 * @param string $month Expiration month
	 * @param string $year Expiration year
	 * @param string $securityCode Card security code
	 */
	public function __construct($number, $month, $year, $securityCode) {

		$this->setNumber($number);
		$this->setMonth($month);
		$this->setYear($year);
		$this->setSecurityCode($securityCode);
	}

	/**
	 * Sets card number
	 *
	 * @param string $number Card number
	 *
	 * @return \ATDev\Commweb\Card
	 */
	public function setNumber($number) {

		$this->number = $number;

		return $this;
	}

	/**
	 * Sets expiration month
	 *
	 * @param string $month Expiration month
	 *
	 * @return \ATDev\Commweb\Card
	 */
	public function setMonth($month) {

		$this->month = $month;

		return $this;
	}

	/**
	 * Sets expiration year
	 *
	 * @param string $year Expiration year
	 *
	 * @return \ATDev\Commweb\Card
	 */
	public function setYear($year) {

		$this->year = $year;

		return $this;
	}

	/**
	 * Sets card security code
	 *
	 * @param string $securityCode Card security code
	 *
	 * @return \ATDev\Commweb\Card
	 */
	public function setSecurityCode($securityCode) {

		$this->securityCode = $securityCode;

		return $this;
	}

	/**
	 * Specifies what has to be returned on serialization to json
	 *
	 * @return array Data to serialize
	 */
	public function jsonSerialize() {

		return [
			"number" => $this->number,
			"expiry" => [
				"month" => $this->month,
				"year" => $this->year,
			],
			"securityCode" => $this->securityCode
		];
	}
}
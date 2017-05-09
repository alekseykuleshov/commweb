<?php namespace ATDev\Commweb;

class Card implements \JsonSerializable {

	private $number;
	private $month;
	private $year;
	private $securityCode;

	public function __construct($number, $month, $year, $securityCode) {

		$this->setNumber($number);
		$this->setMonth($month);
		$this->setYear($year);
		$this->setSecurityCode($securityCode);
	}

	public function setNumber($number) {

		$this->number = $number;

		return $this;
	}

	public function setMonth($month) {

		$this->month = $month;

		return $this;
	}

	public function setYear($year) {

		$this->year = $year;

		return $this;
	}

	public function setSecurityCode($securityCode) {

		$this->securityCode = $securityCode;

		return $this;
	}

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
<?php namespace AK\Commweb;

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
	}

	public function setMonth($month) {

		$this->month = $month;
	}

	public function setYear($year) {

		$this->year = $year;
	}

	public function setSecurityCode($securityCode) {

		$this->securityCode = $securityCode;
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
<?php namespace ATDev\Commweb;

class SourceOfFunds implements \JsonSerializable {

	private $type = "CARD";
	private $card;

	public function __construct($type = null, Card $card = null) {

		if ( ! empty($type)) {
			$this->setType($type);
		}

		if ( ! empty($card)) {
			$this->setCard($card);
		}
	}

	public function setType($type) {

		$this->type = $type;

		return $this;
	}

	public function setCard(Card $card) {

		$this->card = $card;

		return $this;
	}

	public function jsonSerialize() {

		return [
			"type" => $this->type,
			"provided" => [
				"card" => $this->card
			]
		];
	}
}
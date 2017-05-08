<?php namespace AK\Commweb;

class SourceOfFunds implements \JsonSerializable {

	private $type = "CARD";
	private $card;

	public function __construct($type = null, Card $card = null) {

		$this->setType($type);
		$this->setCard($card);
	}

	public function setType($type) {

		$this->type = $type;
	}

	public function setCard(Card $card) {

		$this->card = $card;
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
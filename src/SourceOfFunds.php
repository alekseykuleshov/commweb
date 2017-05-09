<?php namespace ATDev\Commweb;

class SourceOfFunds implements \JsonSerializable {

	private $type = "CARD";
	private $card;

	/**
	 * Class constructor
	 *
	 * @param string $type Type of funds source
	 * @param \ATDev\Commweb\Card $card
	 */
	public function __construct($type = null, Card $card = null) {

		if ( ! empty($type)) {
			$this->setType($type);
		}

		if ( ! empty($card)) {
			$this->setCard($card);
		}
	}

	/**
	 * Sets source of funds type
	 *
	 * @param string $type
	 *
	 * @return \ATDev\Commweb\SourceOfFunds
	 */
	public function setType($type) {

		$this->type = $type;

		return $this;
	}

	/**
	 * Sets card for the source of funds = 'CARD'
	 *
	 * @param \ATDev\Commweb\Card $card
	 *
	 * @return \ATDev\Commweb\SourceOfFunds
	 */
	public function setCard(Card $card) {

		$this->card = $card;

		return $this;
	}

	/**
	 * Specifies what has to be returned on serialization to json
	 *
	 * @return array Data to serialize
	 */
	public function jsonSerialize() {

		return [
			"type" => $this->type,
			"provided" => [
				"card" => $this->card
			]
		];
	}
}
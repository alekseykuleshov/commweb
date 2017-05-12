<?php namespace ATDev\Commweb;

/**
 * An abstract source of funds class
 */
abstract class SourceOfFunds implements \JsonSerializable {

	/** @var string Type of funds source */
	protected $type;

	/**
	 * Specifies what has to be returned on serialization to json
	 *
	 * @return array Data to serialize
	 */
	public function jsonSerialize() {

		return [
			"type" => $this->type
		];
	}
}

/**
 * Card source of funds class
 */
class SourceOfFundsCard extends SourceOfFunds {

	/** @var string Type of funds source */
	protected $type = "CARD";

	/** @var \ATDev\Commweb\Card Card as funds source */
	private $card;

	/**
	 * Class constructor
	 *
	 * @param \ATDev\Commweb\Card $card
	 */
	public function __construct(Card $card) {

		if ( ! empty($card) ) {
			$this->setCard($card);
		}
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

/**
 * Card source of funds class for verification
 */
class SourceOfFundsCardVerify extends SourceOfFundsCard {

	/**
	 * Specifies what has to be returned on serialization to json
	 *
	 * @return array Data to serialize
	 */
	public function jsonSerialize() {

		return [
			"provided" => [
				"card" => $this->card
			]
		];
	}
}
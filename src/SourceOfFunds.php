<?php namespace ATDev\Commweb;

/**
 * Source of funds class
 */
class SourceOfFunds implements \JsonSerializable {

	/** @var string Type of card funds source */
	const TYPE_CARD = "CARD";

	/** @var array Available funds source types */
	private static $availableTypes = [
		self::TYPE_CARD
	];

	/** @var string Type of funds source */
	private $type = "CARD";
	/** @var \ATDev\Commweb\Card Card as funds source */
	private $card;

	/**
	 * Class constructor
	 *
	 * @param string $type Type of funds source
	 * @param \ATDev\Commweb\Card $card
	 */
	public function __construct($type = null, Card $card = null) {

		if ( ! empty($type) ) {
			$this->setType($type);
		}

		if ( ! empty($card) ) {
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

		if ( in_array($type, self::$availableTypes) ) {
			$this->type = $type;
		}

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
		$this->setType(self::TYPE_CARD);

		return $this;
	}

	/**
	 * Specifies what has to be returned on serialization to json
	 *
	 * @return array Data to serialize
	 */
	public function jsonSerialize() {

		$result = [];

		if ( ! empty($this->type) ) {

			$result["type"] = $this->type;
		}

		if ( ! empty($this->card) ) {

			$result["provided"] = [
				"card" => $this->card
			];
		}

		return $result;
	}
}
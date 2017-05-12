<?php namespace ATDev\Commweb;

/**
 * Currency class
 */
class Currency {

	/** @var string Australian dollars */
	const AUD = "AUD";

	/** @var array Available currencies */
	private static $availableCurrencies = [
		self::AUD
	];

	/**
	 * Gets available currencies
	 *
	 * @return array
	 */
	public static function getAvailableCurrencies() {

		return self::$availableCurrencies;
	}
}
<?php

namespace CleaniqueCoders\OpenPayroll\Processors;

class MoneyProcessor
{
   /**
     * Default currency configuration.
     * You can replace 'MY' and 'RM' with your actual default currency.
     */
    protected $currency = [
        'MY' => ['symbol' => 'RM', 'swift_code' => 'MYR'],
        'US' => ['symbol' => '$', 'swift_code' => 'USD'],
        'IN' => ['symbol' => '₹', 'swift_code' => 'INR'],
        // Add more here
    ];

    protected $currentCurrency = 'IN';

    /**
     * Create a static instance and set the currency.
     *
     * @param string|null $country ISO Alpha 2 country code
     * @return $this
     */
    public static function make(string $country = null)
    {
        return (new static())->setCurrency($country);
    }

    /**
     * Set the currency based on the provided country code.
     *
     * @param string|null $country ISO Alpha 2 country code
     * @return $this
     */
    public function setCurrency(string $country = null)
    {
        if (empty($country)) {
            $country = 'IN';
        }

        if (!isset($this->currency[$country])) {
            throw new \Exception("Currency for country code $country not available.");
        }

        $this->currentCurrency = $country;

        return $this;
    }

    /**
     * Get the current currency configuration.
     *
     * @return array
     */
    public function getCurrency()
    {
        return $this->currency[$this->currentCurrency];
    }

    /**
     * Get the current currency symbol.
     *
     * @return string
     */
    public function getCurrencySymbol()
    {
        return $this->getCurrency()['symbol'];
    }

    /**
     * Get the current currency swift code.
     *
     * @return string
     */
    public function getCurrencySwiftCode()
    {
        return $this->getCurrency()['swift_code'];
    }

    /**
     * Convert integer to human-readable money format.
     * 
     * @param int $amount The amount in integer format
     * @return string The human-readable amount
     */
    public function toHuman(int $amount): string
    {
        $humanAmount = number_format($amount / 100, 2, '.', ',');
        return $this->getCurrencySymbol() . ' ' . $humanAmount;
    }

    /**
     * Convert a human-readable money format to integer.
     *
     * @param string $amount The amount in string format (e.g., "1.00")
     * @return int The machine-readable amount (e.g., 100)
     */
    public function toMachine(string $amount): int
    {
        // Remove any non-numeric characters except for dots and minus sign
        $cleanedAmount = preg_replace('/[^0-9.-]/', '', $amount);
        
        // Convert to integer (assuming 2 decimal places)
        return intval(floatval($cleanedAmount) * 100);
    }
}
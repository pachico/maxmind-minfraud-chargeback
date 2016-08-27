<?php

/**
 * This file is part of Pachico\MaxMind\MinFraudChargeback. (https://github.com/pachico/maxmind-minfraud-chargeback)
 *
 * @link https://github.com/pachico/maxmind-minfraud-chargeback for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Mariano F.co Benítez Mulet. (https://github.com/pachico/)
 * @license https://raw.githubusercontent.com/pachico/maxmind-minfraud-chargeback/master/LICENSE.md MIT
 */

namespace Pachico\MaxMind\MinFraudChargeback\Exception;

use Exception;

/**
 * @see http://dev.maxmind.com/minfraud/chargeback/
 */
class ExceptionAbstract extends Exception
{
    /**
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }

    /**
     * Possible values for fraud_score are ‘not_fraud’, ‘suspected_fraud’ and ‘known_fraud’.
     * Supplying any other value for fraud_score will trigger this error.
     */
    const FRAUD_SCORE_INVALID = 'FRAUD_SCORE_INVALID';

    /**
     * Your JSON could not be parsed. Try using a tool like jsonlint.com to check your JSON for errors.
     */
    const JSON_INVALID = 'JSON_INVALID';

    /**
     * You have supplied an invalid maxmind_id. This field is case sensitive.
     * Check your maxmind_id to ensure that it is 8 characters in length and made
     * up only of digits and upper case letters. This value must come from
     * the successful response to a previous minFraud request.
     */
    const MAXMIND_ID_INVALID = 'MAXMIND_ID_INVALID';

    /**
     * You have supplied an invalid minfraud_id. Check your minfraud_id to
     * ensure that it is a valid UUID as returned in the minFraud Score,
     * minFraud Insights, or minFraud Factors response.
     */
    const MINFRAUD_ID_INVALID = 'MINFRAUD_ID_INVALID';

    /**
     *  You have supplied an unknown parameter.
     * Check the keys in your JSON data to ensure that you have not misspelled
     * any of the field names or passed a field name which is not listed
     * in the available input fields.
     */
    const PARAMETER_UNKNOWN = 'PARAMETER_UNKNOWN';

    /**
     * You have not supplied a valid IPv4 or IPv6 address.
     */
    const IP_ADDRESS_INVALID = 'IP_ADDRESS_INVALID';

    /**
     * You have supplied an IP address which belongs to a reserved or private range.
     */
    const IP_ADDRESS_RESERVED = 'IP_ADDRESS_RESERVED';

    /**
     * You have supplied an invalid MaxMind user ID and/or license key in the Authorization header.
     */
    const AUTHORIZATION_INVALID = 'AUTHORIZATION_INVALID';

    /**
     * You have not supplied a MaxMind license key in the Authorization header.
     */
    const LICENSE_KEY_REQUIRED = 'LICENSE_KEY_REQUIRED';

    /**
     * You have not supplied a MaxMind user ID in the Authorization header.
     */
    const USER_ID_REQUIRED = 'USER_ID_REQUIRED';

    /**
     * There is a problem with the web service server. You can try this request again later.
     */
    const SERVICE_UNAVAILABLE = 'SERVICE_UNAVAILABLE';
}

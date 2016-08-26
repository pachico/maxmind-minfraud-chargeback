<?php

/**
 * This file is part of Pachico/MinFraudChargeback. (https://github.com/pachico/minfraud-chargeback)
 *
 * @link https://github.com/pachico/minfraud-chargeback for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Mariano F.co Benítez Mulet. (https://github.com/pachico/)
 * @license https://raw.githubusercontent.com/pachico/minfraud-chargeback/master/LICENSE.md MIT
 */

namespace Pachico\MinFraudChargeback\Auth;

use Webmozart\Assert\Assert;

/**
 *
 */
class Credential
{
    /**
     * @var string
     */
    protected $user;
    /**
     * @var string
     */
    protected $password;

    /**
     * @param string $user
     * @param string $password
     *
     * @throws InvalidArgumentExceptionç
     */
    public function __construct($user, $password)
    {
        Assert::stringNotEmpty($user);
        Assert::stringNotEmpty($password);

        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}

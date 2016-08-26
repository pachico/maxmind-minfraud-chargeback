<?php

namespace Pachico\MaxMind\MinFraudChargeback\Auth;

class CredentialTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Credential
     */
    protected $credential;

    /**
     * @return array
     */
    public function userPasswordProvider()
    {
        return [
            ['foo', 'bar'],
            ['FOO', 'BAR']
        ];
    }

    /**
     * @dataProvider userPasswordProvider
     *
     * @param string $user
     * @param string $password
     */
    public function testConstructor($user, $password)
    {
        // Arrange
        $this->credential = new Credential($user, $password);
        // Assert
        $this->assertSame($user, $this->credential->getUser());
        $this->assertSame($password, $this->credential->getPassword());
    }

    public function testInvalidUser()
    {
        // Arrange
        $this->setExpectedException('\InvalidArgumentException');
        // Act
        new Credential(123, 'password');
    }

    public function testInvalidPassword()
    {
        // Arrange
        $this->setExpectedException('\InvalidArgumentException');
        // Act
        new Credential('username', '');
    }
}

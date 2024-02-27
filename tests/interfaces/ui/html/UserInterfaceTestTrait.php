<?php

namespace Darling\RoadyUIUtilities\tests\interfaces\ui\html;

use \Darling\RoadyUIUtilities\interfaces\ui\html\UserInterface;
use \PHPUnit\Framework\Attributes\CoversClass;

/**
 * The UserInterfaceTestTrait defines common tests for
 * implementations of the UserInterface interface.
 *
 * @see UserInterface
 *
 */
#[CoversClass(UserInterface::class)]
trait UserInterfaceTestTrait
{

    /**
     * @var UserInterface $userInterface
     *                              An instance of a
     *                              UserInterface
     *                              implementation to test.
     */
    protected UserInterface $userInterface;

    /**
     * Set up an instance of a UserInterface implementation to test.
     *
     * This method must set the UserInterface implementation instance
     * to be tested via the setUserInterfaceTestInstance() method.
     *
     * This method may also be used to perform any additional setup
     * required by the implementation being tested.
     *
     * @return void
     *
     * @example
     *
     * ```
     * protected function setUp(): void
     * {
     *     $this->setUserInterfaceTestInstance(
     *         new \Darling\RoadyUIUtilities\classes\ui\html\UserInterface()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the UserInterface implementation instance to test.
     *
     * @return UserInterface
     *
     */
    protected function userInterfaceTestInstance(): UserInterface
    {
        return $this->userInterface;
    }

    /**
     * Set the UserInterface implementation instance to test.
     *
     * @param UserInterface $userInterfaceTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the UserInterface
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setUserInterfaceTestInstance(
        UserInterface $userInterfaceTestInstance
    ): void
    {
        $this->userInterface = $userInterfaceTestInstance;
    }

}


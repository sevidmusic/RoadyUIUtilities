<?php

namespace Darling\RoadyUIUtilities\tests\classes\ui\html;

use \Darling\RoadyUIUtilities\classes\ui\html\UserInterface;
use \Darling\RoadyUIUtilities\tests\RoadyUIUtilitiesTest;
use \Darling\RoadyUIUtilities\tests\interfaces\ui\html\UserInterfaceTestTrait;
use \PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(UserInterface::class)]
class UserInterfaceTest extends RoadyUIUtilitiesTest
{

    /**
     * The UserInterfaceTestTrait defines common tests for
     * implementations of the
     * Darling\RoadyUIUtilities\interfaces\ui\html\UserInterface
     * interface.
     *
     * @see UserInterfaceTestTrait
     *
     */
    use UserInterfaceTestTrait;

    public function setUp(): void
    {
        $this->setUserInterfaceTestInstance(
            new UserInterface(
                $this->pathToDirectoryOfRoadyTestModules(),
                $this->routeCollectionSorter(),
                $this->roadyModuleFileSystemPathDeterminator(),
            )
        );
    }
}


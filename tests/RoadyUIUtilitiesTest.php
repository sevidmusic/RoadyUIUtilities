<?php

namespace Darling\RoadyUIUtilities\tests;

use Darling\RoadyModuleUtilities\classes\configuration\ModuleRoutesJsonConfigurationReader;
use Darling\RoadyModuleUtilities\classes\determinators\ModuleCSSRouteDeterminator;
use Darling\RoadyModuleUtilities\classes\determinators\ModuleJSRouteDeterminator;
use Darling\RoadyModuleUtilities\classes\determinators\RoadyModuleFileSystemPathDeterminator;
use Darling\RoadyModuleUtilities\classes\directory\listings\ListingOfDirectoryOfRoadyModules;
use Darling\RoadyModuleUtilities\classes\determinators\ModuleOutputRouteDeterminator;
use Darling\RoadyRoutingUtilities\classes\requests\Request;
use \Darling\RoadyRoutingUtilities\classes\routers\Router as RouterInstance;
use \Darling\RoadyRoutingUtilities\classes\routers\Router;
use \Darling\RoadyRoutingUtilities\interfaces\responses\Response;
use \Darling\RoadyRoutingUtilities\classes\responses\ResponseInstance;
use \Darling\RoadyModuleUtilities\interfaces\paths\PathToDirectoryOfRoadyModules;
use \Darling\PHPTextTypes\classes\strings\Text as TextInstance;
use \Darling\PHPTextTypes\classes\strings\SafeText as SafeTextInstance;
use \Darling\PHPTextTypes\classes\collections\SafeTextCollection as SafeTextCollectionInstance;
use \Darling\RoadyModuleUtilities\classes\paths\PathToDirectoryOfRoadyModules as PathToDirectoryOfRoadyModulesInstance;
use \Darling\PHPFileSystemPaths\classes\paths\PathToExistingDirectory as PathToExistingDirectoryInstance;
use \Darling\PHPUnitTestUtilities\traits\PHPUnitConfigurationTests;
use \Darling\PHPUnitTestUtilities\traits\PHPUnitRandomValues;
use \Darling\PHPUnitTestUtilities\traits\PHPUnitTestMessages;
use \PHPUnit\Framework\Attributes\CoversNothing;
use \PHPUnit\Framework\TestCase;

/**
 * Defines common methods that may be useful to all
 * RoadyUIUtilities test classes.
 *
 * All RoadyUIUtilities test classes must extend from this class.
 *
 */
#[CoversNothing]
class RoadyUIUtilitiesTest extends TestCase
{
    use PHPUnitConfigurationTests;
    use PHPUnitTestMessages;
    use PHPUnitRandomValues;


    /**
     * Return a random url string or null.
     *
     * @return string|null
     *
     */
    public function randomUrlString(): string|null
    {
       $urlStrings = [
            null,
            '',
            'http://localhost:8080',
            'http://localhost:8080?request=hello-world',
            'http://localhost:8080?request=hello-universe',
            'http://localhost:8080?request=hello-multiverse',
            'http://localhost:8080?request=homepage',
            'http://localhost:8888',
            'http://localhost:8888?request=hello-world',
            'http://localhost:8888?request=hello-universe',
            'http://localhost:8888?request=hello-multiverse',
            'http://localhost:8888?request=homepage',
        ];
        return $urlStrings[array_rand($urlStrings)];
    }

    /**
     * Return the path to the directory of test modules that will
     * be used to test the Router.
     *
     * @return PathToDirectoryOfRoadyModules
     *
     */
    public function pathToDirectoryOfRoadyTestModules(): PathToDirectoryOfRoadyModules
    {
        $testModuleDirectoryPathString  = __DIR__ . DIRECTORY_SEPARATOR . 'modules';
        $testModuleDirectoryPathStringParts = explode(DIRECTORY_SEPARATOR, $testModuleDirectoryPathString);
        $arrayOfSafeText = [];
        foreach($testModuleDirectoryPathStringParts as $part) {
            if(!empty($part)) {
                $arrayOfSafeText[] = new SafeTextInstance(new TextInstance($part));
            }
        }
        return new PathToDirectoryOfRoadyModulesInstance(
            new PathToExistingDirectoryInstance(
                new SafeTextCollectionInstance(...$arrayOfSafeText))
        );
    }

    public function randomResponse(): Response
    {
        $router = new Router(
            new ListingOfDirectoryOfRoadyModules($this->pathToDirectoryOfRoadyTestModules()),
            new ModuleCSSRouteDeterminator(),
            new ModuleJSRouteDeterminator(),
            new ModuleOutputRouteDeterminator(),
            new RoadyModuleFileSystemPathDeterminator(),
            new ModuleRoutesJsonConfigurationReader(),
        );
        $request = new Request($this->randomUrlString());
        return $router->handleRequest($request);
    }

}

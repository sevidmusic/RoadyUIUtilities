<?php

namespace Darling\RoadyUIUtilities\classes\ui\html;

use \Darling\RoadyModuleUtilities\interfaces\determinators\RoadyModuleFileSystemPathDeterminator;
use \Darling\RoadyModuleUtilities\interfaces\paths\PathToDirectoryOfRoadyModules;
use \Darling\RoadyRoutes\interfaces\sorters\RouteCollectionSorter;
use \Darling\RoadyUIUtilities\interfaces\ui\html\UserInterface as UserInterfaceInterface;

class UserInterface implements UserInterfaceInterface
{

    public function __construct(
        private PathToDirectoryOfRoadyModules $pathToDirectoryOfRoadyModules,
        private RouteCollectionSorter $routeCollectionSorter,
        private RoadyModuleFileSystemPathDeterminator $roadyModuleFileSystemPathDeterminator,
    ) {}
}


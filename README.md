# RoadyUIUtilities

Provides classes for the [Roady](https://github.com/sevidmusic/roady)
`php` framework's User Interface.

# Installation

```bash
composer require darling/roady-ui-utilities
```

# Classes

### \Darling\RoadyUIUtilities\classes\ui\html\UserInterface

 A UserInterface can render output for a Response.

The UserInterface's defined under the
`Darling\RoadyUIUtilities\interfaces\ui\html` namespace
are intended to produce html for a web page based
on the Routes defined by a given Response.

The following is a snippet from the [Roady](https://github.com/sevidmusic/roady) `php` framework's
`index.php` file showing how a UserInterface is used in
practice.

```php
$currentRequest = new RequestInstance();
$roadyModuleFileSystemPathDeterminator =
    new RoadyModuleFileSystemPathDeterminatorInstance();

$router = new RouterInstance(
    new ListingOfDirectoryOfRoadyModulesInstance(
        RoadyAPI::pathToDirectoryOfRoadyModules()
    ),
    new ModuleCSSRouteDeterminatorInstance(),
    new ModuleJSRouteDeterminatorInstance(),
    new ModuleOutputRouteDeterminatorInstance(),
    $roadyModuleFileSystemPathDeterminator,
    new ModuleRoutesJsonConfigurationReaderInstance(),
);

$response = $router->handleRequest($currentRequest);

$roadyUI = new RoadyUI(
    RoadyAPI::pathToDirectoryOfRoadyModules(),
    new RouteCollectionSorterInstance(),
    $roadyModuleFileSystemPathDeterminator,
);

echo $roadyUI->render($response);
```


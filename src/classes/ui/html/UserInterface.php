<?php

namespace Darling\RoadyUIUtilities\classes\ui\html;

use Darling\PHPFileSystemPaths\interfaces\paths\PathToExistingFile;
use Darling\RoadyModuleUtilities\classes\paths\PathToRoadyModuleDirectory as PathToRoadyModuleDirectoryInstance;
use \Darling\RoadyModuleUtilities\interfaces\determinators\RoadyModuleFileSystemPathDeterminator;
use \Darling\RoadyModuleUtilities\interfaces\paths\PathToDirectoryOfRoadyModules;
use \Darling\RoadyRoutes\interfaces\sorters\RouteCollectionSorter;
use \Darling\RoadyRoutingUtilities\interfaces\responses\Response;
use \Darling\RoadyUIUtilities\interfaces\ui\html\UserInterface as UserInterfaceInterface;

class UserInterface implements UserInterfaceInterface
{

    public function __construct(
        private PathToDirectoryOfRoadyModules $pathToDirectoryOfRoadyModules,
        private RouteCollectionSorter $routeCollectionSorter,
        private RoadyModuleFileSystemPathDeterminator $roadyModuleFileSystemPathDeterminator,
    ) {}

    private const ROADY_UI_META_DESCRIPTION = 'roady-ui-meta-description';
    private const ROADY_UI_META_AUTHOR = 'roady-ui-meta-author';
    private const ROADY_UI_META_KEYWORDS = 'roady-ui-meta-keywords';
    private const ROADY_UI_CSS_STYLESHEET_LINK_TAGS = 'roady-ui-css-stylesheet-link-tags';
    private const ROADY_UI_FOOTER = 'roady-ui-footer';
    private const ROADY_UI_HEADER = 'roady-ui-header';
    private const ROADY_UI_JS_SCRIPT_TAGS_FOR_END_OF_HTML = 'roady-ui-js-script-tags-for-end-of-html';
    private const ROADY_UI_JS_SCRIPT_TAGS_FOR_HTML_HEAD = 'roady-ui-js-script-tags-for-html-head';
    private const ROADY_UI_MAIN_CONTENT = 'roady-ui-main-content';
    private const ROADY_UI_PAGE_TITLE_PLACEHOLDER = 'roady-ui-page-title-placeholder';
    private const ROADY_UI_PRE_HEADER = 'roady-ui-pre-header';

    /**
     * @var array<int, string> $availableNamedPositions
     */
    private array $availableNamedPositions = [
        self::ROADY_UI_META_DESCRIPTION,
        self::ROADY_UI_META_AUTHOR,
        self::ROADY_UI_META_KEYWORDS,
        self::ROADY_UI_CSS_STYLESHEET_LINK_TAGS,
        self::ROADY_UI_FOOTER,
        self::ROADY_UI_HEADER,
        self::ROADY_UI_JS_SCRIPT_TAGS_FOR_END_OF_HTML,
        self::ROADY_UI_JS_SCRIPT_TAGS_FOR_HTML_HEAD,
        self::ROADY_UI_MAIN_CONTENT,
        self::ROADY_UI_PAGE_TITLE_PLACEHOLDER,
        self::ROADY_UI_PRE_HEADER,
    ];

    /**
     * @var array<string, string> $renderedOutput
     */
    private array $renderedOutput = [];

    private const ROADY_UI_LAYOUT_STRING = <<<'EOT'
<!DOCTYPE html>

<html>

    <head>

        <title><roady-ui-page-title-placeholder></roady-ui-page-title-placeholder></title>

        <meta charset="UTF-8">

        <meta name="description" content="<roady-ui-meta-description></roady-ui-meta-description>">

        <meta name="keywords" content="<roady-ui-meta-keywords></roady-ui-meta-keywords>">

        <meta name="author" content="<roady-ui-meta-author></roady-ui-meta-author>">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <roady-ui-css-stylesheet-link-tags></roady-ui-css-stylesheet-link-tags>

        <roady-ui-js-script-tags-for-html-head></roady-ui-js-script-tags-for-html-head>

    </head>

    <body>

        <roady-ui-pre-header></roady-ui-pre-header>

        <header class="roady-ui-header">

            <roady-ui-header></roady-ui-header>

        </header>


        <main class="roady-ui-main-content">

            <roady-ui-main-content></roady-ui-main-content>

        </main>

        <footer class="roady-ui-footer">

            <roady-ui-footer></roady-ui-footer>

        </footer>


    </body>

</html>

<roady-ui-js-script-tags-for-end-of-html></roady-ui-js-script-tags-for-end-of-html>

<!-- Powered by Roady (https://github.com/sevidmusic/roady) -->
<!-- Current Request: ROADY-UI-CURRENT-REQUEST -->

EOT;

    public function render(Response $response): string
    {
        $uiLayoutString = self::ROADY_UI_LAYOUT_STRING;
        $sortedRoutes = $this->routeCollectionSorter
                             ->sortByNamedPosition(
                                 $response->routeCollection()
                             );
        $renderedOutput = [];
        foreach($sortedRoutes as $namedPosition => $routes) {
            foreach($routes as $position => $route) {
            #var_dump([$namedPosition, $route->relativePath()->__toString()]);
                $pathToRoadyModuleDirectory =
                    new PathToRoadyModuleDirectoryInstance(
                        $this->pathToDirectoryOfRoadyModules,
                        $route->moduleName()
                    );
                $pathToFile = $this->roadyModuleFileSystemPathDeterminator
                                   ->determinePathToFileInModuleDirectory(
                                       $pathToRoadyModuleDirectory,
                                       $route->relativePath()
                                   );
                $fileExtension = pathinfo(
                    $pathToFile,
                    PATHINFO_EXTENSION
                );
                $webPathToFile = $response->request()
                                          ->url()
                                          ->domain()
                                          ->__toString() .
                                          DIRECTORY_SEPARATOR .
                                          basename(
                                              $this->pathToDirectoryOfRoadyModules
                                              ->__toString()
                                          ) .
                                          DIRECTORY_SEPARATOR .
                                          $pathToRoadyModuleDirectory->name()
                                                                     ->__toString();
                $renderedOutput[$namedPosition][] = match($fileExtension) {
                    'css' =>
                    '        <!-- ' .
                        $namedPosition . ' position ' . $position  .
                    ' -->' .
                    PHP_EOL .
                    '        <link rel="stylesheet" href="'.
                        $webPathToFile .
                        DIRECTORY_SEPARATOR .
                        $route->relativePath()->__toString()  .
                        '">',
                    'js' =>
                    '        <!-- ' .
                        $namedPosition . ' position ' . $position  .
                    ' -->' .
                    PHP_EOL .
                    '        <script src="'.
                        $webPathToFile .
                        DIRECTORY_SEPARATOR .
                        $route->relativePath()->__toString()  .
                        '"></script>',
                    default => $this->determineOutput($pathToFile, $namedPosition, $position),
                };
            }
        }
        foreach(
            $this->availableNamedPositions as $availableNamedPosition
        ) {
            if(
                $availableNamedPosition !== self::ROADY_UI_PAGE_TITLE_PLACEHOLDER
                &&
                isset($renderedOutput[$availableNamedPosition])
            ) {
                $uiLayoutString = match(
                    $availableNamedPosition === self::ROADY_UI_CSS_STYLESHEET_LINK_TAGS
                    ||
                    $availableNamedPosition === self::ROADY_UI_JS_SCRIPT_TAGS_FOR_HTML_HEAD
                    ||
                    $availableNamedPosition === self::ROADY_UI_JS_SCRIPT_TAGS_FOR_END_OF_HTML
                ) {
                    true => str_replace(
                        '<' . $availableNamedPosition . '></' . $availableNamedPosition . '>',
                        implode(PHP_EOL, $renderedOutput[$availableNamedPosition]),
                        $uiLayoutString
                    ),
                    default => str_replace(
                        '<' . $availableNamedPosition . '></' . $availableNamedPosition . '>',
                        implode(
                            PHP_EOL,
                            $renderedOutput[$availableNamedPosition]
                        ),
                        $uiLayoutString
                    ),
                };
            }
            $uiLayoutString = $this->renderTitle($response, $uiLayoutString);
            $uiLayoutString = $this->removePositionIfUnused($availableNamedPosition, $uiLayoutString);
        }
        $uiLayoutString = $this->renderCurrentRequest($response, $uiLayoutString);
        return $uiLayoutString;
    }

    private function determineOutput(PathToExistingFile $pathToFile, string $namedPosition, string $position): string
    {
        $renderedOutputKey = sha1($pathToFile->__toString());
        if(!isset($this->renderedOutput[$renderedOutputKey])) {
            $this->renderedOutput[$renderedOutputKey] =
                match($namedPosition) {
                self::ROADY_UI_META_AUTHOR,
                self::ROADY_UI_META_DESCRIPTION,
                self::ROADY_UI_META_KEYWORDS => str_replace(
                    ["\r\n", "\r", "\n", PHP_EOL],
                    '',
                    trim(
                        match(str_contains($pathToFile->name()->__toString(), '.php')) {
                            true => $this->includePHPFile($pathToFile),
                            default => strval(file_get_contents( $pathToFile->__toString())),
                        }
                    )
                ),
                default => PHP_EOL .
                    '<!-- begin ' .
                    $namedPosition . ' position ' . $position  .
                    ' -->' .
                    PHP_EOL .
                    match(str_contains($pathToFile->name()->__toString(), '.php')) {
                        true => $this->includePHPFile($pathToFile),
                        default => strval(file_get_contents( $pathToFile->__toString())),
                    } .
                    PHP_EOL .
                    '<!-- end ' . $namedPosition . ' position ' . $position  . ' -->' . PHP_EOL
                };
        }
        return $this->renderedOutput[$renderedOutputKey];
    }

    private function includePHPFile(PathToExistingFile $pathToFile): string
    {
        $output = '<div class="roady-ui-error"><h2>Error</h2><p>Failed to load content for: ' . $pathToFile->__toString() . '</p></div>';
        ob_start();
        require_once($pathToFile->__toString());
        $renderedOutput = ob_get_contents();
        if(is_string($renderedOutput)) {
            $output = $renderedOutput;
        }
        ob_end_clean();
        return $output;
    }

    /**
     * Return a string that has a title rendered for the specified
     * Response in the specified string.
     *
     * @param Response $response The Response to render a title for.
     *
     * @param string $string The string to render the title in.
     *
     * @return string
     *
     */
    private function renderTitle(Response $response, string $string): string
    {
        return str_replace(
            '<' . self::ROADY_UI_PAGE_TITLE_PLACEHOLDER  . '></' . self::ROADY_UI_PAGE_TITLE_PLACEHOLDER . '>',
            $response->request()->url()->domain()->__toString() . ' | ' . ucwords(str_replace('-', ' ', $response->request()->name()->__toString())),
            $string,
        );
    }

    /**
     * Return a string that has specified named position stripped
     * from the specified string if it is unused.
     *
     * @param string $positionName The name of the position.
     *
     * @param string $string The string to remove the unused named
     *                       position from.
     *
     * @return string
     *
     */
    private function removePositionIfUnused(string $positionName, string $string): string
    {
        return str_replace(
            '<' . $positionName . '></' . $positionName . '>',
            '',
            $string,
        );

    }

    /**
     * Return a string that has a current Request's url string
     * rendered for the specified Response in the specified string.
     *
     * @param Response $response The relevant Response.
     *
     * @param string $string The string to render the current
     *                       Request's url string in.
     *
     * @return string
     *
     */
    private function renderCurrentRequest(Response $response, string $string): string
    {
        return str_replace(
            'ROADY-UI-CURRENT-REQUEST',
            $response->request()->url()->__toString(),
            $string,
        );
    }

}


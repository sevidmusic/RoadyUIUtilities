<?php

namespace Darling\RoadyUIUtilities\tests\interfaces\ui\html;

use \Darling\PHPFileSystemPaths\interfaces\paths\PathToExistingFile;
use \Darling\RoadyModuleUtilities\classes\determinators\RoadyModuleFileSystemPathDeterminator as RoadyModuleFileSystemPathDeterminatorInstance;
use \Darling\RoadyModuleUtilities\classes\paths\PathToRoadyModuleDirectory as PathToRoadyModuleDirectoryInstance;
use \Darling\RoadyModuleUtilities\interfaces\determinators\RoadyModuleFileSystemPathDeterminator;
use \Darling\RoadyModuleUtilities\interfaces\paths\PathToDirectoryOfRoadyModules;
use \Darling\RoadyRoutes\classes\sorters\RouteCollectionSorter as RouteCollectionSorterInstance;
use \Darling\RoadyRoutes\interfaces\sorters\RouteCollectionSorter;
use \Darling\RoadyRoutingUtilities\interfaces\responses\Response;
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
     * @var string $roady_ui_meta_description The name of the
     *                                        NamedPosition
     *                                        defined for
     *                                        description meta
     *                                        data in the
     *                                        UserInterface
     *                                        implementation
     *                                        being tested's
     *                                        output template.
     */
    private string $roady_ui_meta_description = 'roady-ui-meta-description';

    /**
     * @var string $roady_ui_meta_author The name of the NamedPosition
     *                                   defined for author meta
     *                                   data in the UserInterface
     *                                   implementation being tested's
     *                                   output template.
     */
    private string $roady_ui_meta_author = 'roady-ui-meta-author';

    /**
     * @var string $roady_ui_meta_keywords The name of the
     *                                     NamedPosition defined
     *                                     for keyword meta data
     *                                     in the UserInterface
     *                                     implementation being
     *                                     tested's output template.
     */
    private string $roady_ui_meta_keywords = 'roady-ui-meta-keywords';

    /**
     * @var string $roady_ui_css_stylesheet_link_tags The name of the
     *                                                NamedPosition
     *                                                defined for css
     *                                                stylesheet link
     *                                                tags in the
     *                                                UserInterface
     *                                                implementation
     *                                                being tested's
     *                                                output template.
     */
    private string $roady_ui_css_stylesheet_link_tags = 'roady-ui-css-stylesheet-link-tags';

    /**
     * @var string $roady_ui_footer The name of the NamedPosition
     *                              defined for the footer content
     *                              of the html body in the
     *                              UserInterface implementation
     *                              being tested's output template.
     */
    private string $roady_ui_footer = 'roady-ui-footer';

    /**
     * @var string $roady_ui_header The name of the NamedPosition
     *                              defined for the header content
     *                              of the html body in the
     *                              UserInterface implementation
     *                              being tested's output template.
     */
    private string $roady_ui_header = 'roady-ui-header';

    /**
     * @var string $roady_ui_js_script_tags_for_end_of_html
     *                                    The name of the
     *                                    NamedPosition defined
     *                                    for script tags that
     *                                    should be rendered at
     *                                    the end of the html
     *                                    output in the UserInterface
     *                                    implementation being
     *                                    tested's output template.
     */
    private string $roady_ui_js_script_tags_for_end_of_html = 'roady-ui-js-script-tags-for-end-of-html';

    /**
     * @var string $roady_ui_js_script_tags_for_html_head
     *                                    The name of the
     *                                    NamedPosition defined
     *                                    for script tags that
     *                                    should be rendered in
     *                                    the head of the html
     *                                    output in the UserInterface
     *                                    implementation being
     *                                    tested's output template.
     */
    private string $roady_ui_js_script_tags_for_html_head = 'roady-ui-js-script-tags-for-html-head';

    /**
     * @var string $roady_ui_main_content The name of the
     *                                    NamedPosition defined for
     *                                    the main content of the html
     *                                    body in the UserInterface
     *                                    implementation being
     *                                    tested's output template.
     */
    private string $roady_ui_main_content = 'roady-ui-main-content';

    /**
     * @var string $roady_ui_page_title_placeholder The name of the
     *                                        NamedPosition defined
     *                                        for title tags content
     *                                        in the UserInterface
     *                                        implementation being
     *                                        tested's output template.
     */
    private string $roady_ui_page_title_placeholder = 'roady-ui-page-title-placeholder';

    /**
     * @var string $roady_ui_pre_header The name of the NamedPosition
     *                                  defined for the pre-header
     *                                  content of the html body
     *                                  in the UserInterface
     *                                  implementation being tested's
     *                                  output template.

     */
    private string $roady_ui_pre_header = 'roady-ui-pre-header';

    /**
     * Return a RouteCollectionSorter instance to use for testing.
     *
     * @return RouteCollectionSorter
     *
     */
    private function routeCollectionSorter(): RouteCollectionSorter
    {
        return new RouteCollectionSorterInstance();
    }

    /**
     * Return a RoadyModuleFileSystemPathDeterminator instance to use
     * for testing.
     *
     * @return RoadyModuleFileSystemPathDeterminator
     *
     */
    private function roadyModuleFileSystemPathDeterminator(): RoadyModuleFileSystemPathDeterminator
    {
        return new RoadyModuleFileSystemPathDeterminatorInstance();
    }

    /**
     * Return an array of the names of the NamedPositions that
     * are expected to be defined by the UserInterface being
     * tested's output template.
     *
     * @return array<int, string>
     */
    protected function availableNamedPositions(): array
    {
        return [
            $this->roady_ui_meta_description,
            $this->roady_ui_meta_author,
            $this->roady_ui_meta_keywords,
            $this->roady_ui_css_stylesheet_link_tags,
            $this->roady_ui_footer,
            $this->roady_ui_header,
            $this->roady_ui_js_script_tags_for_end_of_html,
            $this->roady_ui_js_script_tags_for_html_head,
            $this->roady_ui_main_content,
            $this->roady_ui_page_title_placeholder,
            $this->roady_ui_pre_header,
        ];
    }

    /**
     * @var array<string, string> $renderedOutput
     */
    private array $renderedOutput = [];

    private string $roady_ui_layout_string = <<<'EOT'
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

    private function includePHPFile(PathToExistingFile $pathToFile): string
    {
        $output = '<div class="roady-ui-error">' .
            '<h2>Error</h2><p>Failed to load content for: ' . '</p>' .
            $pathToFile->__toString() .
            '</div>';
        ob_start();
        require_once($pathToFile->__toString());
        $renderedOutput = ob_get_contents();
        if(is_string($renderedOutput)) {
            $output = $renderedOutput;
        }
        ob_end_clean();
        return $output;
    }

    private function determineOutput(PathToExistingFile $pathToFile, string $namedPosition, string $position): string
    {
        $renderedOutputKey = sha1($pathToFile->__toString());
        if(!isset($this->renderedOutput[$renderedOutputKey])) {
            $this->renderedOutput[$renderedOutputKey] =
                match($namedPosition) {
                $this->roady_ui_meta_author,
                $this->roady_ui_meta_description,
                $this->roady_ui_meta_keywords => str_replace(
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

    public function expectedOutput(Response $response): string
    {
        $uiLayoutString = $this->roady_ui_layout_string;
        $sortedRoutes = $this->routeCollectionSorter()
                             ->sortByNamedPosition(
                                 $response->routeCollection()
                             );
        $renderedOutput = [];
        foreach($sortedRoutes as $namedPosition => $routes) {
            foreach($routes as $position => $route) {
                $pathToRoadyModuleDirectory =
                    new PathToRoadyModuleDirectoryInstance(
                        $this->pathToDirectoryOfRoadyTestModules(),
                        $route->moduleName()
                    );
                $pathToFile = $this->roadyModuleFileSystemPathDeterminator()
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
                                              $this->pathToDirectoryOfRoadyTestModules()
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
            $this->availableNamedPositions() as $availableNamedPosition
        ) {
            if(
                $availableNamedPosition !== $this->roady_ui_page_title_placeholder
                &&
                isset($renderedOutput[$availableNamedPosition])
            ) {
                $uiLayoutString = match(
                    $availableNamedPosition === $this->roady_ui_css_stylesheet_link_tags
                    ||
                    $availableNamedPosition === $this->roady_ui_js_script_tags_for_html_head
                    ||
                    $availableNamedPosition === $this->roady_ui_js_script_tags_for_end_of_html
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
            '<' . $this->roady_ui_page_title_placeholder  . '></' . $this->roady_ui_page_title_placeholder . '>',
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
            '<' . $positionName. '></' . $positionName. '>',
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

    /**
     * Test that the render() method returns the expected output
     * for the specified Response.
     *
     * @return void
     *
     */
    public function test_render_returns_the_expected_output(): void
    {
        $response = $this->randomResponse();
        $this->assertEquals(
            $this->expectedOutput($response),
            $this->userInterfaceTestInstance()->render($response),
            $this->testFailedMessage(
                $this->userInterfaceTestInstance(),
                'render',
                'returns the expected output',
            )
        );
    }

    abstract public function randomResponse(): Response;
    abstract public function pathToDirectoryOfRoadyTestModules(): PathToDirectoryOfRoadyModules;
    abstract public static function assertEquals(mixed $expected, mixed $actual, string $message = ''): void;
    abstract protected function testFailedMessage(object $testedInstance, string $testedMethod, string $expectation): string;

}


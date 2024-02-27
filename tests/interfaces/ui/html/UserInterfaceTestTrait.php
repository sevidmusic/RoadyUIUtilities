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

    protected function expectedOutput(): string
    {
        return '';
    }

}


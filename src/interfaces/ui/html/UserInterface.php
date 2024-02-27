<?php

namespace Darling\RoadyUIUtilities\interfaces\ui\html;

use \Darling\RoadyRoutingUtilities\interfaces\responses\Response;

/**
 * A UserInterface can render output for a Response.
 *
 * The UserInterface's defined under the
 * Darling\RoadyUIUtilities\interfaces\ui\html namespace
 * are intended to produce html for a web page based
 * on the Routes defined by a given Response.
 *
 */
interface UserInterface
{

    /**
     * Return a string constructed from the collective output of
     * all of the Routes defined for the specified Response.
     *
     * @param Response $response The Response to render output for.
     *
     * @return string
     *
     */
    public function render(Response $response): string;

}


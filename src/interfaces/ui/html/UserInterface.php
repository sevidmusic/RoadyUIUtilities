<?php

namespace Darling\RoadyUIUtilities\interfaces\ui\html;

use \Darling\RoadyRoutingUtilities\interfaces\responses\Response;

/**
 * A UserInterface can render output for a Response.
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


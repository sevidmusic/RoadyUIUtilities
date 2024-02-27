<?php

namespace Darling\RoadyUIUtilities\interfaces\ui\html;

use \Darling\RoadyRoutingUtilities\interfaces\responses\Response;


/**
 * Description of this interface.
 *
 */
interface UserInterface
{

    public function render(Response $response): string;

}


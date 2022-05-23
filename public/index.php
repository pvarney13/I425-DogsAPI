<?php
/**
 * Author: Piper Varney
 * Date: 5/22/22
 * File: index.php
 * Description: This is the front-controller file, the entry point to the slim app.
 *  It handles all requests by channeling requests through a single handler object.
 */
// Require application bootstrap
(require __DIR__ . '/../config/bootstrap.php')->run();
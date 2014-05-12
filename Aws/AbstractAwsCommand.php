<?php

/**
* Copyright 2014 Underground Elephant
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
* http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*
* @package aws-cli-bundle
* @copyright (c) 2014 Underground Elephant
* @license Apache License, Version 2.0
*/

namespace Uecode\Bundle\AwsCliBundle\Aws;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

/**
 * @author  Mauricio Walters <mwalters@undergroundelephant.com>
 */
abstract class AbstractAwsCommand extends ContainerAwareCommand
{
    const COMMAND_SUCCESS = 0;
    const COMMAND_FAILURE = 1;

    /**
     * Authenticate with AWS and instantiate client
     * 
     * @abstract
     */
    abstract protected function getClient();

    /**
     * Get AWS API credentials from parameters.yml
     *
     * @return array
     */
    protected function getCredentials()
    {
        return $this->getContainer()->getParameter('uecode.aws');
    }
}

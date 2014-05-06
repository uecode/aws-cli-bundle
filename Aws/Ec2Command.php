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

use Aws\Ec2\Ec2Client;

/**
 * Authenticates with AWS for use with EC2 commands
 * 
 * @author  Mauricio Walters <mwalters@undergroundelephant.com>
 */
class Ec2Command extends AbstractAwsCommand
{
    /**
     * Instantiates a new Ec2 Client
     * 
     * @return Ec2Client 
     */
    protected function getClient()
    {
        $credentials = $this->getCredentials();

        return Ec2Client::factory(
            array(
                'key'    => $credentials['aws_api_key'],
                'secret' => $credentials['aws_api_secret'],
                'region' => $credentials['aws_region'],
            )
        );
    }
}

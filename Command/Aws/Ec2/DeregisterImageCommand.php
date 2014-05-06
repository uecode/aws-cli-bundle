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

namespace Uecode\Bundle\AwsCliBundle\Command\Aws\Ec2;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Uecode\Bundle\AwsCliBundle\Aws\Ec2Command;

/**
 * Deregister Image command
 * 
 * @link http://docs.aws.amazon.com/aws-sdk-php/latest/class-Aws.Ec2.Ec2Client.html#_deregisterImage
 * @author  Mauricio Walters <mwalters@undergroundelephant.com>
 */
class DeregisterImageCommand extends Ec2Command
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('uecode:aws:ec2:deregisterimage')
            ->setDescription('Deregisters the specified AMI. After you deregister an AMI, it can\'t be used to launch new instances.')
            ->addArgument('ImageId', InputArgument::REQUIRED, 'The ID of the AMI')
            ->addOption('DryRun', 'dryrun', InputOption::VALUE_NONE, null)
            ->addOption('AmiName', 'aminame', InputOption::VALUE_NONE, 'Use AMI name instead if ID');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $options = array_merge($input->getArguments(), $input->getOptions());

        $client = $this->getClient();

        if ($options['AmiName']) {
            $name = $options['ImageId'];
            $image = $client->describeImages(
                ["Filters" => [["Name" => "name", "Values" => [$name]]]]
            );
            $imageId = $image['Images'][0]['ImageId'];
            $options['ImageId'] = $imageId;
        }

        $result = $client->deregisterImage($options);
    }
}

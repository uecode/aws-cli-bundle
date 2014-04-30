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
 * Create Image command
 * 
 * @link http://docs.aws.amazon.com/aws-sdk-php/latest/class-Aws.Ec2.Ec2Client.html#_createImage
 * @author  Mauricio Walters <mwalters@undergroundelephant.com>
 */
class CreateImageCommand extends Ec2Command
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('uecode:aws:ec2:createimage')
            ->setDescription('Creates an Amazon EBS-backed AMI from an Amazon EBS-backed instance that is either running or stopped.')
            ->addArgument('Name', InputArgument::REQUIRED, 'A name for the new image.')
            ->addArgument('InstanceId', InputArgument::REQUIRED, 'The ID of the instance')
            ->addArgument('Description', InputArgument::OPTIONAL, 'A description for the new image.')
            ->addOption('BlockDeviceMappings', 'mappings', InputOption::VALUE_OPTIONAL, 'Information about one or more block device mappings. Takes JSON')
            ->addOption('NoReboot', 'noreboot', InputOption::VALUE_NONE, 'Amazon EC2 will not shut down the instance before creating the image. Filesystem integrity is not guaranteed.')
            ->addOption('DryRun', 'dryrun', InputOption::VALUE_NONE, null);
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $options = array_merge($input->getArguments(), $input->getOptions());

        $options['BlockDeviceMappings'] = json_decode($options['BlockDeviceMappings']);

        $client = $this->getClient();

        $result = $client->createImage($options);

        $output->wirteln($result);
    }
}

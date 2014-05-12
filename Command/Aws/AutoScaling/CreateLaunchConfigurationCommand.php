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
 * @package       aws-cli-bundle
 * @copyright (c) 2014 Underground Elephant
 * @license       Apache License, Version 2.0
 */

namespace Uecode\Bundle\AwsCliBundle\Command\Aws\AutoScaling;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Uecode\Bundle\AwsCliBundle\Aws\AutoScalingCommand;

/**
 * Create Launch Configuration Command
 *
 * @link   http://docs.aws.amazon.com/aws-sdk-php/latest/class-Aws.AutoScaling.AutoScalingClient.html#_createLaunchConfiguration
 * @author Mauricio Walters <mwalters@undergroundelephant.com>
 */
class CreateLaunchConfigurationCommand extends AutoScalingCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('uecode:aws:autoscaling:createlaunchconfiguration')
            ->setDescription('Creates a new launch configuration.')
            ->AddArgument(
                'LaunchConfigurationName',
                InputArgument::REQUIRED,
                'The name of the launch configuration to create'
            )
            ->AddOption(
                'ImageId',
                null,
                InputOption::VALUE_REQUIRED,
                'Unique ID of the Amazon Machine Image (AMI) you want to use to launch your EC2 instances'
            )
            ->AddOption(
                'KeyName',
                null,
                InputOption::VALUE_REQUIRED,
                'The name of the Amazon EC2 key pair'
            )
            ->AddOption(
                'SecurityGroups',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'The security groups with which to associate Amazon EC2 or Amazon VPC instances.'
            )
            ->AddOption(
                'UserData',
                null,
                InputOption::VALUE_REQUIRED,
                'The user data to make available to the launched Amazon EC2 instances'
            )
            ->AddOption(
                'InstanceId',
                null,
                InputOption::VALUE_REQUIRED,
                'The ID of the Amazon EC2 instance you want to use to create the launch configuration'
            )
            ->AddOption(
                'InstanceType',
                null,
                InputOption::VALUE_REQUIRED,
                'The instance type of the Amazon EC2 instance'
            )
            ->AddOption(
                'KernelId',
                null,
                InputOption::VALUE_REQUIRED,
                'The ID of the kernel associated with the Amazon EC2 AMI'
            )
            ->AddOption(
                'RamdiskId',
                null,
                InputOption::VALUE_REQUIRED,
                'The ID of the RAM disk associated with the Amazon EC2 AMI'
            )
            ->AddOption(
                'BlockDeviceMappings',
                null,
                InputOption::VALUE_REQUIRED,
                'A list of mappings that specify how block devices are exposed to the instance. Takes JSON'
            )
            ->AddOption(
                'InstanceMonitoring',
                null,
                InputOption::VALUE_REQUIRED,
                'Enables detailed monitoring if it is disabled. true/false'
            )
            ->AddOption(
                'SpotPrice',
                null,
                InputOption::VALUE_REQUIRED,
                'The maximum hourly price to be paid for any Spot Instance launched to fulfill the request'
            );
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $options = array_merge($input->getArguments(), $input->getOptions());

        $options['BlockDeviceMappings'] = json_decode($options['BlockDeviceMappings']);
        if ($options['InstanceMonitoring'] == "true") {
            $options['InstanceMonitoring'] = ['Enabled' => true];
        } else {
            unset($options['InstanceMonitoring']);
        }

        $this->getClient()->createLaunchConfiguration($options);

        return self::COMMAND_SUCCESS;
    }
}

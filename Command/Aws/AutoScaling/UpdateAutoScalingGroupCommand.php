<?php

/**
 * Copyright 2014 Underground Elephant
 *t
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
 * Update AutoScaling Group Command
 *
 * @link   http://docs.aws.amazon.com/aws-sdk-php/latest/class-Aws.AutoScaling.AutoScalingClient.html#_updateAutoScalingGroup
 * @author Mauricio Walters <mwalters@undergroundelephant.com>
 */
class UpdateAutoScalingGroupCommand extends AutoScalingCommand {
    protected function configure()
    {
        $this
            ->setName('uecode:aws:autoscaling:updateautoscalinggroup')
            ->setDescription('Updates the configuration for the specified AutoScalingGroup')
            ->addArgument(
                'AutoScalingGroupName',
                InputArgument::REQUIRED,
                'The name of the Auto Scaling group'
            )
            ->addOption(
                'LaunchConfigurationName',
                null,
                InputOption::VALUE_REQUIRED,
                'The name of the launch configuration'
            )
            ->addOption(
                'MinSize',
                null,
                InputOption::VALUE_REQUIRED,
                'The minimum size of the Auto Scaling group'
            )
            ->addOption(
                'MaxSize',
                null,
                InputOption::VALUE_REQUIRED,
                'The maximum size of the Auto Scaling group'
            )
            ->addOption(
                'DesiredCapacity',
                null,
                InputOption::VALUE_REQUIRED,
                'The desired capacity for the Auto Scaling group'
            )
            ->addOption(
                'DefaultCooldown',
                null,
                InputOption::VALUE_REQUIRED,
                'The amount of time, in seconds, after a scaling activity completes
                before any further scaling activities can start'
            )
            ->addOption(
                'AvailabilityZones',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Availability Zones for the group'
            )
            ->addOption(
                'HealthCheckType',
                null,
                InputOption::VALUE_REQUIRED,
                'The type of health check for the instances in the Auto Scaling group'
            )
            ->addOption(
                'HealthCheckGracePeriod',
                null,
                InputOption::VALUE_REQUIRED,
                'The length of time that Auto Scaling waits before checking an instance\'s health status'
            )
            ->addOption(
                'PlacementGroup',
                null,
                InputOption::VALUE_REQUIRED,
                'The name of the cluster placement group, if applicable'
            )
            ->addOption(
                'VPCZoneIdentifier',
                null,
                InputOption::VALUE_REQUIRED,
                'The subnet identifier for the Amazon VPC connection, if applicable.
                You can specify several subnets in a comma-separated list'
            )
            ->addOption(
                'TerminationPolicies',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'A standalone termination policy or a list of termination policies
                used to select the instance to terminate'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $options = array_merge($input->getArguments(), $input->getOptions());

        var_dump($options);

        $this->getClient()->updateAutoScalingGroup($options);

        return self::COMMAND_SUCCESS;
    }
}

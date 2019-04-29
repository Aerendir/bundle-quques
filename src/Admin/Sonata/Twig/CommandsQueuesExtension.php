<?php

declare(strict_types=1);

/*
 * This file is part of the SHQCommandsQueuesBundle.
 *
 * Copyright Adamo Aerendir Crespi 2017.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author    Adamo Aerendir Crespi <hello@aerendir.me>
 * @copyright Copyright (C) 2017 Aerendir. All rights reserved.
 * @license   MIT License.
 */

namespace SerendipityHQ\Bundle\CommandsQueuesBundle\Admin\Sonata\Twig;

use Safe\Exceptions\StringsException;
use SerendipityHQ\Bundle\CommandsQueuesBundle\Entity\Job;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * {@inheritdoc}
 */
class CommandsQueuesExtension extends AbstractExtension
{
    /** @var UrlGeneratorInterface $generator */
    private $generator;

    /**
     * @param UrlGeneratorInterface $generator
     */
    public function __construct(UrlGeneratorInterface $generator)
    {
        $this->generator = $generator;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('commands_queues_get_id_option_value', [$this, 'getIdOptionValue']),
        ];
    }

    /**
     * @param Job $job
     *
     * @throws StringsException
     *
     * @return string|null
     */
    public function getIdOptionValue(Job $job): ?string
    {
        foreach ($job->getArguments() as $option) {
            if (0 === strpos($option, '--id=')) {
                $id  = str_replace('--id=', '', $option);
                $url = $this->generator->generate('admin_serendipityhq_commandsqueues_job_show', ['id' => $id], UrlGeneratorInterface::ABSOLUTE_PATH);

                return \Safe\sprintf('<a href="%s">#%s</a>', $url, $id);
            }
        }

        return null;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'commands_queues';
    }
}
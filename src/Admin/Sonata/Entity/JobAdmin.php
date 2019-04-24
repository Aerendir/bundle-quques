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

namespace SerendipityHQ\Bundle\CommandsQueuesBundle\Admin\Sonata\Entity;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * {@inheritdoc}
 */
class JobAdmin extends AbstractAdmin
{
    /**
     * {@inheritdoc}
     */
    protected $translationDomain = 'shq_commands_queues';

    /**
     * {@inheritdoc}
     */
    protected $baseRoutePattern = 'jobs';

    /**
     * {@inheritdoc}
     */
    protected $datagridValues = [
        // display the first page (default = 1)
        '_page' => 1,

        '_per_page' => 100,

        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',

        // name of the ordered field (default = the model's id field, if any)
        '_sort_by' => 'id',
    ];

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('id')
            ->add('command')
            ->add('dependencies');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('status')
            ->add('command')
            ->add('arguments')
            ->add('queue')
            ->add('exitCode')
            ->add('priority')
            ->add('createdAt', 'doctrine_orm_date_range')
            ->add('startedAt', 'doctrine_orm_date_range')
            ->add('closedAt', 'doctrine_orm_date_range')
            ->add('executeAfterTime', 'doctrine_orm_date_range');

        /*
        $datagridMapper->add('status', 'doctrine_orm_choice',[], ChoiceType::class, [
            'operator_type' => HiddenType::class,
            'field_options' => [
                'choices' => [
                    'New' => Job::STATUS_NEW,
                    'Aborted' => Job::STATUS_ABORTED,
                ]
            ],
        ]);
        */
    }

    /**
     * {@inheritdoc}
     */
    protected function configureRoutes(RouteCollection $collection): void
    {
        $collection
            ->remove('create')
            ->remove('batch')
            ->remove('delete')
            ->remove('edit')
            ->remove('export');
    }
}

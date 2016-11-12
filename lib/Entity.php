<?php
/* ===========================================================================
 * Copyright 2013-2016 The Opis Project
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================================ */

namespace Opis\Database;

use Opis\Database\ORM\DataMapper;
use Opis\Database\ORM\EntityMapper;

abstract class Entity
{
    private $args;
    private $dataMapper;

    final public function __construct(EntityManager $entityManager,
                                      EntityMapper $entityMapper,
                                      array $columns = [],
                                      bool $isReadOnly = false,
                                      bool $isNew = false)
    {
        $this->args = [$entityManager, $entityMapper, $columns, $isReadOnly, $isNew];
    }

    protected function orm(): DataMapper
    {
        if($this->dataMapper === null){
            $this->dataMapper = new DataMapper(...$this->args);
        }

        return $this->dataMapper;
    }
}
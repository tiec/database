<?php
/* ===========================================================================
 * Copyright 2018-2020 Zindex Software
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

namespace Opis\Database\ORM\Internal;

use Opis\Database\EntityManager;

abstract class Relation
{
    protected string $entityClass;
    protected ?ForeignKey $foreignKey;

    /** @var callable|null $queryCallback */
    protected $queryCallback = null;

    /**
     * EntityRelation constructor.
     * @param string $entityClass
     * @param ForeignKey|null $foreignKey
     */
    public function __construct(string $entityClass, ?ForeignKey $foreignKey = null)
    {
        $this->entityClass = $entityClass;
        $this->foreignKey = $foreignKey;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function query(callable $callback): static
    {
        $this->queryCallback = $callback;
        return $this;
    }

    /**
     * @param EntityManager $manager
     * @param EntityMapper $owner
     * @param array $options
     * @return LazyLoader
     */
    abstract public function getLazyLoader(EntityManager $manager, EntityMapper $owner, array $options): LazyLoader;

    /**
     * @param DataMapper $data
     * @param callable|null $callback
     * @return mixed
     */
    abstract public function getResult(DataMapper $data, ?callable $callback = null): mixed;
}
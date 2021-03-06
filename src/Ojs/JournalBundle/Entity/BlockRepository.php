<?php

namespace Ojs\JournalBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Ojs\JournalBundle\Entity\Journal;

/**
 * BlockRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BlockRepository extends EntityRepository
{
    public function journalBlocks(Journal $journal)
    {
        return $this->findBy(
            [
                'journal' => $journal,
            ],
            [
                'blockOrder' => 'asc',
            ]
        );
    }
}

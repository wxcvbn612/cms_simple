<?php

namespace App\Repository;

use App\Entity\LandingPageContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LandingPageContent>
 */
class LandingPageContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LandingPageContent::class);
    }

    public function getContent(): LandingPageContent
    {
        $content = $this->find(1);

        if ($content === null) {
            $content = new LandingPageContent();

            $em = $this->getEntityManager();
            $em->persist($content);
            $em->flush();
        }

        return $content;
    }
}

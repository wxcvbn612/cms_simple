<?php

namespace App\Repository;

use App\Entity\SiteSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SiteSettings>
 */
class SiteSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SiteSettings::class);
    }

    public function getSettings(): SiteSettings
    {
        $settings = $this->find(1);

        if ($settings === null) {
            $settings = new SiteSettings();
            $settings->setSiteName('Mon Site');
            $settings->setAdminEmail('admin@example.com');
            $settings->setDefaultLocale('fr');

            $em = $this->getEntityManager();
            $em->persist($settings);
            $em->flush();
        }

        return $settings;
    }
}

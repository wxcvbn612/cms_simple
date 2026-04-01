<?php

namespace App\Service;

use App\Entity\SiteSettings;
use App\Repository\SiteSettingsRepository;

/**
 * Twig global: {{ settings.siteName }}, {{ settings.phone }}, etc.
 * Lazy-loads SiteSettings id=1 and proxies all getters/issers.
 */
class SiteSettingsService
{
    private ?SiteSettings $settings = null;

    public function __construct(
        private readonly SiteSettingsRepository $repository
    ) {}

    public function getSettings(): SiteSettings
    {
        if ($this->settings === null) {
            $this->settings = $this->repository->getSettings();
        }
        return $this->settings;
    }

    /** Allows {{ settings.siteName }}, {{ settings.phone }}, etc. in Twig */
    public function __get(string $name): mixed
    {
        $entity = $this->getSettings();

        foreach (['get', 'is', 'has'] as $prefix) {
            $method = $prefix . ucfirst($name);
            if (method_exists($entity, $method)) {
                return $entity->$method();
            }
        }

        return null;
    }

    public function __isset(string $name): bool
    {
        return true;
    }

    /** Allows calling service methods that delegate to entity */
    public function __call(string $name, array $args): mixed
    {
        return $this->getSettings()->$name(...$args);
    }
}

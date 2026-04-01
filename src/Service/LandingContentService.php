<?php

namespace App\Service;

use App\Entity\LandingPageContent;
use App\Repository\LandingPageContentRepository;

/**
 * Twig global: {{ lp.colorPrimary }}, {{ lp.heroTitle }}, etc.
 * Lazy-loads LandingPageContent id=1 and proxies all getters/issers.
 */
class LandingContentService
{
    private ?LandingPageContent $content = null;

    public function __construct(
        private readonly LandingPageContentRepository $repository
    ) {}

    public function getContent(): LandingPageContent
    {
        if ($this->content === null) {
            $this->content = $this->repository->getContent();
        }
        return $this->content;
    }

    /** Allows {{ lp.colorPrimary }}, {{ lp.heroTitle }}, etc. in Twig */
    public function __get(string $name): mixed
    {
        $entity = $this->getContent();

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
        return $this->getContent()->$name(...$args);
    }
}

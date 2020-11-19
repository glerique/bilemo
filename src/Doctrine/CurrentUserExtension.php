<?php 

namespace App\Doctrine;

use Doctrine\ORM\QueryBuilder;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use Symfony\Component\Security\Core\Security;
use App\Entity\Client;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use App\Entity\User;

class CurrentUserExtension implements QueryCollectionExtensionInterface
{
    private $security;
    private $auth;

    public function __construct(Security $security, AuthorizationCheckerInterface $checker)
    {
        $this->security = $security;
        $this->auth = $checker;
    }

    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass)
    {
        
        $user = $this->security->getUser();

        if (
            ($resourceClass === User::class )
            &&
            !$this->auth->isGranted('ROLE_ADMIN')
            &&
            $user instanceof Client
        ) {
            $rootAlias = $queryBuilder->getRootAliases()[0];

            if ($resourceClass === User::class) {
                $queryBuilder->andWhere("$rootAlias.client = :user");
            } 

            $queryBuilder->setParameter("user", $user);
        }
    }

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?string $operationName = null)
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    
}
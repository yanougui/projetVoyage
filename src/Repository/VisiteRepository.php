<?php

namespace App\Repository;

use App\Entity\Visite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Visite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visite[]    findAll()
 * @method Visite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visite::class);
    }

    // /**
    //  * @return Visite[] Returns an array of Visite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Visite
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * Retoune toutes les visites trièes sur un champ
     * @param type $champ
     * @param type $ordre
     * @return Visite[]
     */
    public function findAllOrderBy($champ, $ordre): array{
        return $this->createQueryBuilder('v')
                ->orderBy('v.'.$champ, $ordre)
                ->getQuery()
                ->getResult();
    }
    /**
     * Enregistrement dont un champ est égal à une valeur
     * ou tous les enregistrements si la valeur est vide
     * @param type $champ 
     * @param type $valeur
     * @return Visite[] 
     */
    public function findByEqualValue($champ, $valeur):array {
        if($valeur == ""){
            return $this->createQueryBuilder('v')//alias de la table
                ->orderBy('v.'.$champ,'ASC')
                ->getQuery()
                ->getResult();
        }else{
            return $this->createQueryBuilder('v')//alias de la table
                ->where('v.'.$champ.'=:valeur')
                ->setParameter('valeur',$valeur)
                ->orderBy('v.datecreation','DESC')
                ->getQuery()
                ->getResult();
        }
    }
    /**
     * Retourne les n visites les plus recentes
     * @param type $nb
     * @return Visite[]
     */
    public function findAllLasted($nb):array{
        return $this->createQueryBuilder('v')
                ->orderBy('v.datecreation','DESC')
                ->setMaxResults($nb)
                ->getQuery()
                ->getResult();
    }
}


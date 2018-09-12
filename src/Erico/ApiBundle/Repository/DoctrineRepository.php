<?php
namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;

class DoctrineRepository extends EntityRepository
{
        public function myFindAll()
        {
            $queryBuilder = $this->createQueryBuilder('d');


            //on recupere la query a partir du queryBuilder
            $query = $queryBuilder->getQuery();

            //on recupere les resultats a partir de la query
            $results = $query->getResult();

            //on retourne ces resultats
            return $results;
        }


        public function findById($id)
        {

          $query = $this->_em->createQuery(
              'SELECT d.titreDocument,d.nomAuteur,d.specialite, d.datePublication FROM ApiBundle:Doctrine d WHERE d.id = :idc ORDER BY d.datePublication DESC' );
         $query->setParameter('idc', $id);
          /*$query->setFirstResult($first);
          $query->setMaxResults($limit);// est l'équivalent de LIMIT en DQL */
          $resultats = $query->getResult();
          
          
          return $resultats;  
        }
        

        public function findAll()
        {
            $query = $this->_em->createQuery(
                'SELECT d.titreDocument,d.nomAuteur,d.specialite, d.datePublication FROM ApiBundle:Doctrine d ORDER BY d.datePublication ' );
           // $query->setParameter('id', $id);
            /*$query->setFirstResult($first);
            $query->setMaxResults($limit);// est l'équivalent de LIMIT en DQL */
            $resultats = $query->getResult();
            
            
            return $resultats;  
        }

        

}
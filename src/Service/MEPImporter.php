<?php

namespace App\Service;

use App\Entity\MEP;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\ORM\EntityManagerInterface;

class MEPImporter
{
    private $httpClient;
    private $entityManager;

    public function __construct(HttpClientInterface $httpClient, EntityManagerInterface $entityManager)
    {
        $this->httpClient = $httpClient;
        $this->entityManager = $entityManager;
    }

    public function importMEPs(): void
    {
        // Fetch MEP data from the source URL
        $response = $this->httpClient->request('GET', 'https://www.europarl.europa.eu/meps/en/full-list/xml/a');
        $xmlData = $response->getContent();

        // Parse XML data and create MEP entities
        $xml = simplexml_load_string($xmlData);
        foreach ($xml->children() as $mepData) {
            $mep = new MEP();
            // Populate MEP entity with data from XML
            $mep->setFullName((string) $mepData->fullName);
            $mep->setCountry((string) $mepData->country);
            $mep->setPoliticalGroup((string) $mepData->politicalGroup);
            $mep->setId((int) $mepData->id);
            $mep->setnationalPoliticalGroup((int) $mepData->nationalPoliticalGroup);

            // Persist MEP entity to the database (using EntityManager)
            $this->entityManager->persist($mep);
        }

        $this->entityManager->flush(); // Flush changes to the DB
    }
}

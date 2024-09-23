<?php

namespace App\DataFixtures;

use App\Entity\Fit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->loadFits($manager);
    }
    
    private function loadFits(ObjectManager $manager)
    {
        foreach ($this->getFitsData() as [$style, $colors, $created, $price]) {
            $fit = new Fit();
            $fit->setStyle($style);
            $fit->setColors($colors);
            $fit->setCreated(new \DateTime($created));
            $fit->setPrice($price);
            
            $manager->persist($fit);
        }
        
        $manager->flush();  // Persist all changes at once
    }
    
    private function getFitsData(): \Generator
    {
        // Fit data = [style, colors, created date, price]
        yield ['Casual', ['white', 'black'], 'now', 100];
        yield ['Old money', ['gray', 'navy'], 'now', 200];
        yield ['Sporty', ['red', 'black'], 'yesterday', 150];
        yield ['Formal', ['black', 'white'], 'now', 300];
        yield ['Summer', ['yellow', 'white'], '-2 days', 120];
    }
}

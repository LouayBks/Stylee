<?php

namespace App\DataFixtures;

use App\Entity\Fit;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->loadFits($manager);
        $this->loadUsers($manager);
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
    
    private function loadUsers(ObjectManager $manager)
    {
        foreach ($this->getUsersData() as [$first_name, $last_name, $email, $pwd, $nation]) {
            $user = new User();
            $user->setFirstName($first_name);
            $user->setLastName($last_name);
            $user->setEmail(($email));
            $user->setPwd($pwd);
            $user->setNation($nation);
            
            $manager->persist($user);
        }
        
        $manager->flush();  // Persist all changes at once
    }
    
    private function getUsersData(): \Generator
    {
        // User data = [first_name, last_name, email, password, nationality]
        yield ['John', 'Doe', 'john.doe@example.com', 'password123', 'USA'];
        yield ['Test', 'Test', 'testh@test.com', 'test', 'UK'];
        yield ['Alex', 'Johnson', 'alex.johnson@example.com', 'passAlex2024', 'Canada'];
        yield ['Bruce', 'Wayne', 'bruce@gotham.com', 'money', 'USA'];
        yield ['Chen', 'Wei', 'chen.wei@example.com', 'chenPass456', 'China'];
    }
}

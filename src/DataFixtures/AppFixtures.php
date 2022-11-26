<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Users;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Entity\FluxActualites;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    /**public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }**/

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr-FR');
        // $product = new Product();
        $user = new Users();

        $user->setEmail('user@test.com')
            ->setNom($faker->firstName())
            ->setPrenom($faker->lastName())
            ->setAdresse($faker->text())
            ->setNumTel($faker->text());

        $plaintextPassword = 123456789;
        //$hashedPassword = $passwordHasher->hashPassword(
          //  $user,
            //$plaintextPassword
        //);
        
        $user->setPassword($plaintextPassword);
        $manager->persist($user);


        for ($i=0; $i < 10 ; $i++) { 
            $fluactualite  =  new FluxActualites();

            $fluactualite->setTitre($faker->words(3, true))
                        ->setDate($faker->dateTimeBetween('-6 month', 'now'))
                        ->setContenu($faker->text())
                        ->setUsers($user);
            $manager->persist($fluactualite);
        }
        

        for ($i=0; $i < 10 ; $i++) { 
            $categorie  =  new Categories();

            $categorie->setNom($faker->word())
                        ->setUsers($user)
                        ->setDescription($faker->words(10, true));

            $manager->persist($categorie);
        }

        for ($i=0; $i < 10 ; $i++) { 
            $articles  =  new Articles();

            $articles->setNom($faker->word())
                        ->setDate($faker->dateTimeBetween('-6 month', 'now'))
                        ->setTaille($faker->text())
                        ->setUsers($user)
                        ->setOrigine($faker->text())
                        ->setEtat($faker->text())
                        ->setDescription($faker->text())
                        ->setEnVente($faker->boolean())
                        ->setFile('./images/shoes/1.jpg')
                        ->setPrix($faker->numberBetween(0, 100000000));

            $manager->persist($articles);
        }


        // $manager->persist($product);

        $manager->flush();
    }
}

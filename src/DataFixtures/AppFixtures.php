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

        $user->setEmail('user@test1.com')
            ->setNom($faker->firstName())
            ->setPrenom($faker->lastName())
            ->setAdresse($faker->text())
            ->setRoles(['ROLE_VENDEUR'])
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
        

        for ($j=0; $j < 10 ; $j++) { 
            $categorie  =  new Categories();

            $categorie->setNom($faker->word())
                        ->setUsers($user)
                        ->setDescription($faker->words(10, true));

                        for ($i=0; $i < 8 ; $i++) { 
                            $articles  =  new Articles();
                
                            $articles->setNom($faker->word())
                                        ->setDate($faker->dateTimeBetween('-6 month', 'now'))
                                        ->setTaille($faker->text())
                                        ->setUsers($user)
                                        ->setOrigine($faker->text())
                                        ->setEtat($faker->text())
                                        ->setDescription($faker->text())
                                        ->setQuantite($faker->numberBetween(0, 200))
                                        ->setEnVente($faker->boolean())
                                        ->setFile('./images/shoes/3.jpg')
                                        ->setPrix($faker->numberBetween(5, 200)*1000);
                
                            $manager->persist($articles);
                        }
                
                        for ($i=0; $i < 2 ; $i++) { 
                            $articles  =  new Articles();
                
                            $articles->setNom($faker->word())
                                        ->setDate($faker->dateTimeBetween('-6 month', 'now'))
                                        ->setTaille($faker->text())
                                        ->setUsers($user)
                                        ->setOrigine($faker->text())
                                        ->setEtat($faker->text())
                                        ->setDescription($faker->text())
                                        ->setQuantite($faker->numberBetween(0, 200))
                                        ->setEnVente($faker->boolean())
                                        ->setFile('./images/shoes/1.jpg')
                                        ->setPrix($faker->numberBetween(5, 200)*1000);
                
                            $manager->persist($articles);
                        }

            $manager->persist($categorie);
        }


        // $manager->persist($product);

        $manager->flush();
    }
}

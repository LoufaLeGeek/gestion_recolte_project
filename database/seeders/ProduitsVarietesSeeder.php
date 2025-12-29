<?php

namespace Database\Seeders;

use App\Models\Produit;
use App\Models\Varietee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProduitsVarietesSeeder extends Seeder
{
    /**
     * Exécuter le seeder.
     */
    public function run(): void
    {
        // Liste des produits agricoles avec leurs variétés
        $produitsAvecVarietes = [
            [
                'nom' => 'Tomate',
                'description' => 'Fruit rouge utilisé en cuisine, riche en lycopène.',
                'varietes' => [
                    ['nom' => 'Roma', 'caracteristiques' => 'Chair ferme, idéale pour sauces et conserves'],
                    ['nom' => 'Cerise', 'caracteristiques' => 'Petite taille, saveur sucrée, parfaite en salade'],
                    ['nom' => 'Cœur de Bœuf', 'caracteristiques' => 'Grosse taille, chair charnue, peu de graines'],
                    ['nom' => 'Green Zebra', 'caracteristiques' => 'Peau verte rayée, saveur acidulée'],
                    ['nom' => 'Noire de Crimée', 'caracteristiques' => 'Peau pourpre-noir, saveur douce et riche'],
                ]
            ],
            [
                'nom' => 'Pomme de terre',
                'description' => 'Tubercule comestible, base de nombreuses recettes.',
                'varietes' => [
                    ['nom' => 'Charlotte', 'caracteristiques' => 'Chair ferme, excellente pour les salades'],
                    ['nom' => 'Bintje', 'caracteristiques' => 'Polyvalente, idéale pour frites et purées'],
                    ['nom' => 'Ratte', 'caracteristiques' => 'Petite taille, chair fine, goût de châtaigne'],
                    ['nom' => 'Agata', 'caracteristiques' => 'Peau fine, chair tendre, cuisson rapide'],
                    ['nom' => 'Mona Lisa', 'caracteristiques' => 'Rendement élevé, bonne conservation'],
                ]
            ],
            [
                'nom' => 'Carotte',
                'description' => 'Légume racine orange, riche en bêta-carotène.',
                'varietes' => [
                    ['nom' => 'Nantaise', 'caracteristiques' => 'Longue et droite, saveur sucrée'],
                    ['nom' => 'Chantenay', 'caracteristiques' => 'Courte et trapue, idéale pour les sols lourds'],
                    ['nom' => 'Berlicum', 'caracteristiques' => 'Gros calibre, bonne conservation'],
                    ['nom' => 'Touchon', 'caracteristiques' => 'Précoce, adaptée aux récoltes printanières'],
                    ['nom' => 'Purple Haze', 'caracteristiques' => 'Peau violette, cœur orange'],
                ]
            ],
            [
                'nom' => 'Salade',
                'description' => 'Légume feuille consommé principalement cru.',
                'varietes' => [
                    ['nom' => 'Laitue Batavia', 'caracteristiques' => 'Feuilles craquantes, résistante à la chaleur'],
                    ['nom' => 'Feuille de Chêne', 'caracteristiques' => 'Feuilles découpées, tendres'],
                    ['nom' => 'Romaine', 'caracteristiques' => 'Longues feuilles dressées, croquantes'],
                    ['nom' => 'Iceberg', 'caracteristiques' => 'Pomme serrée, très croquante'],
                    ['nom' => 'Rouge Grenobloise', 'caracteristiques' => 'Feuilles rouges frisées'],
                ]
            ],
            [
                'nom' => 'Oignon',
                'description' => 'Bulbe utilisé comme condiment et légume.',
                'varietes' => [
                    ['nom' => 'Jaune Paille', 'caracteristiques' => 'Classique, bonne conservation'],
                    ['nom' => 'Rouge de Florence', 'caracteristiques' => 'Saveur douce, idéal cru'],
                    ['nom' => 'Blanc de Paris', 'caracteristiques' => 'Précoce, consommé frais'],
                    ['nom' => 'Cébette', 'caracteristiques' => 'Petit oignon vert, tige comestible'],
                    ['nom' => 'Oignon Grelot', 'caracteristiques' => 'Petite taille, pour pickles'],
                ]
            ],
            [
                'nom' => 'Courgette',
                'description' => 'Fruit de la famille des cucurbitacées, récolté jeune.',
                'varietes' => [
                    ['nom' => 'Ronde de Nice', 'caracteristiques' => 'Forme ronde, farcie excellente'],
                    ['nom' => 'Grisette de Provence', 'caracteristiques' => 'Peau gris-vert, chair fine'],
                    ['nom' => 'Gold Rush', 'caracteristiques' => 'Couleur jaune doré, très productive'],
                    ['nom' => 'Black Beauty', 'caracteristiques' => 'Peau vert foncé, forme élancée'],
                    ['nom' => 'Trompette', 'caracteristiques' => 'Forme originale, goût de noisette'],
                ]
            ],
            [
                'nom' => 'Poivron',
                'description' => 'Fruit de différentes couleurs, utilisé comme légume.',
                'varietes' => [
                    ['nom' => 'Doux des Landes', 'caracteristiques' => 'Carré, chair épaisse, très doux'],
                    ['nom' => 'Corno di Toro', 'caracteristiques' => 'Forme de corne, saveur fruitée'],
                    ['nom' => 'California Wonder', 'caracteristiques' => 'Carré, passe du vert au rouge'],
                    ['nom' => 'Petit Marseillais', 'caracteristiques' => 'Petite taille, idéal pour farcir'],
                    ['nom' => 'Poivron Banana', 'caracteristiques' => 'Long et jaune, saveur douce'],
                ]
            ],
            [
                'nom' => 'Aubergine',
                'description' => 'Fruit violet utilisé comme légume en cuisine.',
                'varietes' => [
                    ['nom' => 'Violette de Florence', 'caracteristiques' => 'Forme allongée, peau violet vif'],
                    ['nom' => 'Ronde de Valence', 'caracteristiques' => 'Forme ronde, idéale pour farcir'],
                    ['nom' => 'Blanche', 'caracteristiques' => 'Peau blanche, chair moins amère'],
                    ['nom' => 'Listada de Gandia', 'caracteristiques' => 'Peau violette rayée de blanc'],
                    ['nom' => 'Japanese Long', 'caracteristiques' => 'Longue et fine, peau fine'],
                ]
            ],
            [
                'nom' => 'Concombre',
                'description' => 'Fruit allongé de la famille des cucurbitacées.',
                'varietes' => [
                    ['nom' => 'Marketmore', 'caracteristiques' => 'Peau vert foncé, peu amère'],
                    ['nom' => 'Lemon', 'caracteristiques' => 'Forme ronde, couleur jaune citron'],
                    ['nom' => 'Arménien', 'caracteristiques' => 'Très long, peau fine ridée'],
                    ['nom' => 'Cornichon', 'caracteristiques' => 'Petite taille, pour la conserve'],
                    ['nom' => 'Suyo Long', 'caracteristiques' => 'Extrêmement long, peau épineuse'],
                ]
            ],
            [
                'nom' => 'Haricot vert',
                'description' => 'Gousse immature du haricot, consommée comme légume.',
                'varietes' => [
                    ['nom' => 'Fin de Bagnols', 'caracteristiques' => 'Très fin, sans fil, tendre'],
                    ['nom' => 'Contender', 'caracteristiques' => 'Productif, gousse ronde'],
                    ['nom' => 'Mangetout', 'caracteristiques' => 'Gousse plate, sans parchemin'],
                    ['nom' => 'Rocquencourt', 'caracteristiques' => 'Nain, gousse ronde verte'],
                    ['nom' => 'Beurre de Rocquencourt', 'caracteristiques' => 'Gousse jaune, saveur délicate'],
                ]
            ],
            [
                'nom' => 'Épinard',
                'description' => 'Légume feuille riche en fer et vitamines.',
                'varietes' => [
                    ['nom' => 'Géant d\'Hiver', 'caracteristiques' => 'Feuilles larges, résistant au froid'],
                    ['nom' => 'Matador', 'caracteristiques' => 'Précoce, peu sensible à la montée'],
                    ['nom' => 'Monstrueux de Viroflay', 'caracteristiques' => 'Feuilles très grandes, tendres'],
                    ['nom' => 'Butterflay', 'caracteristiques' => 'Feuilles épaisses, croissance rapide'],
                    ['nom' => 'Bloomsdale', 'caracteristiques' => 'Feuilles crispées, saveur prononcée'],
                ]
            ],
            [
                'nom' => 'Chou',
                'description' => 'Légume de la famille des brassicacées.',
                'varietes' => [
                    ['nom' => 'Chou de Milan', 'caracteristiques' => 'Feuilles cloquées, résistant au froid'],
                    ['nom' => 'Chou cabus', 'caracteristiques' => 'Feuilles lisses, pomme serrée'],
                    ['nom' => 'Chou rouge', 'caracteristiques' => 'Couleur pourpre, pour salades et cuisson'],
                    ['nom' => 'Chou de Bruxelles', 'caracteristiques' => 'Petits choux sur la tige'],
                    ['nom' => 'Chou kale', 'caracteristiques' => 'Feuilles frisées, très nutritif'],
                ]
            ],
            [
                'nom' => 'Brocoli',
                'description' => 'Légume fleur de la famille des choux.',
                'varietes' => [
                    ['nom' => 'Calabrais', 'caracteristiques' => 'Grosse tête verte, classique'],
                    ['nom' => 'Romanesco', 'caracteristiques' => 'Forme fractale, couleur vert pomme'],
                    ['nom' => 'Purple Sprouting', 'caracteristiques' => 'Petites pousses violettes'],
                    ['nom' => 'Belstar', 'caracteristiques' => 'Tête bleu-vert, production abondante'],
                    ['nom' => 'Arcadia', 'caracteristiques' => 'Résistant au froid, bonne conservation'],
                ]
            ],
            [
                'nom' => 'Chou-fleur',
                'description' => 'Inflorescence blanche consommée comme légume.',
                'varietes' => [
                    ['nom' => 'Blanc précoce', 'caracteristiques' => 'Récolte estivale, pomme blanche'],
                    ['nom' => 'Violet de Sicile', 'caracteristiques' => 'Couleur violette, riche en antioxydants'],
                    ['nom' => 'Romanesco', 'caracteristiques' => 'Vert pomme, forme spiralée'],
                    ['nom' => 'Cheddar', 'caracteristiques' => 'Couleur orange, riche en bêta-carotène'],
                    ['nom' => 'Verde di Macerata', 'caracteristiques' => 'Vert pâle, saveur douce'],
                ]
            ],
            [
                'nom' => 'Navet',
                'description' => 'Racine consommée comme légume, souvent printanière.',
                'varietes' => [
                    ['nom' => 'Navet de Milan', 'caracteristiques' => 'Rond, plat, couleur rouge et blanc'],
                    ['nom' => 'Nancy', 'caracteristiques' => 'Allongé, chair blanche tendre'],
                    ['nom' => 'Boule d\'Or', 'caracteristiques' => 'Rond, chair jaune, saveur douce'],
                    ['nom' => 'Noir de Pardailhan', 'caracteristiques' => 'Peau noire, chair blanche sucrée'],
                    ['nom' => 'Tokyo Cross', 'caracteristiques' => 'Petit, rond, croissance rapide'],
                ]
            ],
            [
                'nom' => 'Radis',
                'description' => 'Petite racine croquante et piquante.',
                'varietes' => [
                    ['nom' => 'Rond écarlate', 'caracteristiques' => 'Classique, rond et rouge'],
                    ['nom' => 'Flamboyant', 'caracteristiques' => 'Allongé, rouge vif'],
                    ['nom' => 'Radis noir', 'caracteristiques' => 'Gros, peau noire, chair blanche'],
                    ['nom' => 'Daikon', 'caracteristiques' => 'Long et blanc, doux'],
                    ['nom' => 'Watermelon', 'caracteristiques' => 'Peau blanche, chair rose'],
                ]
            ],
            [
                'nom' => 'Betterave',
                'description' => 'Racine rouge utilisée cuite ou crue.',
                'varietes' => [
                    ['nom' => 'Detroit', 'caracteristiques' => 'Ronde, rouge foncé, très productive'],
                    ['nom' => 'Crapaudine', 'caracteristiques' => 'Forme allongée, saveur sucrée'],
                    ['nom' => 'Chioggia', 'caracteristiques' => 'Chair cerclée de rose et blanc'],
                    ['nom' => 'Golden', 'caracteristiques' => 'Couleur jaune-orange, ne tache pas'],
                    ['nom' => 'Bull\'s Blood', 'caracteristiques' => 'Feuilles rouges comestibles'],
                ]
            ],
            [
                'nom' => 'Fraise',
                'description' => 'Petit fruit rouge parfumé.',
                'varietes' => [
                    ['nom' => 'Gariguette', 'caracteristiques' => 'Allongée, très parfumée, précoce'],
                    ['nom' => 'Charlotte', 'caracteristiques' => 'Ronde, rouge brillant, remontante'],
                    ['nom' => 'Mara des Bois', 'caracteristiques' => 'Goût de fraise des bois'],
                    ['nom' => 'Ciflorette', 'caracteristiques' => 'Conique, rouge vif, sucrée'],
                    ['nom' => 'Seascape', 'caracteristiques' => 'Grosse, ferme, bonne conservation'],
                ]
            ],
            [
                'nom' => 'Framboise',
                'description' => 'Petit fruit rouge fragile et parfumé.',
                'varietes' => [
                    ['nom' => 'Meeker', 'caracteristiques' => 'Fruit moyen, rouge foncé, productif'],
                    ['nom' => 'Heritage', 'caracteristiques' => 'Remontante, production automnale'],
                    ['nom' => 'Tulameen', 'caracteristiques' => 'Gros fruit, ferme, excellente saveur'],
                    ['nom' => 'Glen Ample', 'caracteristiques' => 'Sans épines, très productif'],
                    ['nom' => 'Fallgold', 'caracteristiques' => 'Jaune doré, saveur douce'],
                ]
            ],
            [
                'nom' => 'Pomme',
                'description' => 'Fruit à pépins de l\'arbre du même nom.',
                'varietes' => [
                    ['nom' => 'Golden Delicious', 'caracteristiques' => 'Jaune, sucrée, polyvalente'],
                    ['nom' => 'Granny Smith', 'caracteristiques' => 'Verte, acidulée, bonne à cuire'],
                    ['nom' => 'Gala', 'caracteristiques' => 'Rouge et jaune, croquante, sucrée'],
                    ['nom' => 'Fuji', 'caracteristiques' => 'Rouge, très sucrée, croquante'],
                    ['nom' => 'Reinette', 'caracteristiques' => 'Vert-jaune, saveur légèrement acidulée'],
                ]
            ],
            [
                'nom' => 'Poire',
                'description' => 'Fruit à la chair fondante et sucrée.',
                'varietes' => [
                    ['nom' => 'Williams', 'caracteristiques' => 'Jaune, très parfumée, chair fondante'],
                    ['nom' => 'Conference', 'caracteristiques' => 'Allongée, ferme, bonne conservation'],
                    ['nom' => 'Comice', 'caracteristiques' => 'Ronde, très juteuse et sucrée'],
                    ['nom' => 'Passe-Crassane', 'caracteristiques' => 'Grosse, peau rugueuse, hivernale'],
                    ['nom' => 'Beurré Hardy', 'caracteristiques' => 'Peau vert-brun, chair fine'],
                ]
            ],
            [
                'nom' => 'Cerise',
                'description' => 'Petit fruit à noyau de couleur rouge.',
                'varietes' => [
                    ['nom' => 'Burlat', 'caracteristiques' => 'Précoce, gros fruit rouge foncé'],
                    ['nom' => 'Reverchon', 'caracteristiques' => 'Ferme, sucrée, bonne conservation'],
                    ['nom' => 'Bigarreau', 'caracteristiques' => 'Chair ferme et croquante'],
                    ['nom' => 'Montmorency', 'caracteristiques' => 'Acidulée, pour les confitures'],
                    ['nom' => 'Summit', 'caracteristiques' => 'Gros fruit, rouge brillant'],
                ]
            ],
            [
                'nom' => 'Pêche',
                'description' => 'Fruit à noyau velouté et juteux.',
                'varietes' => [
                    ['nom' => 'Grosse Mignonne', 'caracteristiques' => 'Grosse, chair blanche fondante'],
                    ['nom' => 'Sanguine', 'caracteristiques' => 'Chair rouge, saveur particulière'],
                    ['nom' => 'Bénédicte', 'caracteristiques' => 'Jaune, ferme, bonne conservation'],
                    ['nom' => 'Amsden', 'caracteristiques' => 'Précoce, chair blanche'],
                    ['nom' => 'Redhaven', 'caracteristiques' => 'Standard américain, très productive'],
                ]
            ],
            [
                'nom' => 'Abricot',
                'description' => 'Fruit orange à noyau, sucré et parfumé.',
                'varietes' => [
                    ['nom' => 'Rouge du Roussillon', 'caracteristiques' => 'Couleur rouge orangé, très parfumé'],
                    ['nom' => 'Bergeron', 'caracteristiques' => 'Gros, chair ferme, pour conserver'],
                    ['nom' => 'Polonais', 'caracteristiques' => 'Précoce, petit, très sucré'],
                    ['nom' => 'Orangered', 'caracteristiques' => 'Rouge vif, gros calibre'],
                    ['nom' => 'Goldrich', 'caracteristiques' => 'Ferme, bonne tenue à la cuisson'],
                ]
            ],
            [
                'nom' => 'Melon',
                'description' => 'Fruit de la famille des cucurbitacées, à chair orangée.',
                'varietes' => [
                    ['nom' => 'Charentais', 'caracteristiques' => 'Petit, très parfumé, chair orange'],
                    ['nom' => 'Galia', 'caracteristiques' => 'Peau réticulée, chair vert pâle'],
                    ['nom' => 'Canari', 'caracteristiques' => 'Peau jaune, chair blanche'],
                    ['nom' => 'Piel de Sapo', 'caracteristiques' => 'Peau verte tachetée, chair sucrée'],
                    ['nom' => 'Ananas d\'Amérique', 'caracteristiques' => 'Chair orangée, saveur d\'ananas'],
                ]
            ],
            [
                'nom' => 'Pastèque',
                'description' => 'Gros fruit à chair rouge et juteuse.',
                'varietes' => [
                    ['nom' => 'Sugar Baby', 'caracteristiques' => 'Petite taille, peau vert foncé'],
                    ['nom' => 'Crimson Sweet', 'caracteristiques' => 'Rayée, chair rouge sucrée'],
                    ['nom' => 'Yellow Doll', 'caracteristiques' => 'Chair jaune, très sucrée'],
                    ['nom' => 'Moon and Stars', 'caracteristiques' => 'Peau verte avec taches jaunes'],
                    ['nom' => 'Black Diamond', 'caracteristiques' => 'Peau très foncée, gros fruit'],
                ]
            ],
            [
                'nom' => 'Raisin',
                'description' => 'Fruit de la vigne, en grappes.',
                'varietes' => [
                    ['nom' => 'Chasselas', 'caracteristiques' => 'Blanc, grains dorés, saveur fine'],
                    ['nom' => 'Muscat de Hambourg', 'caracteristiques' => 'Noir, très parfumé'],
                    ['nom' => 'Alphonse Lavallée', 'caracteristiques' => 'Noir, gros grains'],
                    ['nom' => 'Italia', 'caracteristiques' => 'Blanc, gros grains croquants'],
                    ['nom' => 'Cardinal', 'caracteristiques' => 'Rouge, précoce, gros grains'],
                ]
            ],
            [
                'nom' => 'Kiwi',
                'description' => 'Fruit brun et velu à chair verte.',
                'varietes' => [
                    ['nom' => 'Hayward', 'caracteristiques' => 'Standard, gros fruit, bonne conservation'],
                    ['nom' => 'Soreli', 'caracteristiques' => 'Précoce, chair jaune'],
                    ['nom' => 'Jenny', 'caracteristiques' => 'Autofertile, petit calibre'],
                    ['nom' => 'Bruno', 'caracteristiques' => 'Fruit allongé, très productif'],
                    ['nom' => 'Abbot', 'caracteristiques' => 'Précoce, bonne qualité gustative'],
                ]
            ],
            [
                'nom' => 'Figue',
                'description' => 'Fruit charnu du figuier, doux et sucré.',
                'varietes' => [
                    ['nom' => 'Violette de Solliès', 'caracteristiques' => 'Peau violette, chair rouge'],
                    ['nom' => 'Blanche d\'Argenteuil', 'caracteristiques' => 'Peau verte, chair rose'],
                    ['nom' => 'Noire de Caromb', 'caracteristiques' => 'Noire, très sucrée'],
                    ['nom' => 'Goutte d\'Or', 'caracteristiques' => 'Jaune, mielleuse'],
                    ['nom' => 'Dalmatie', 'caracteristiques' => 'Grosse, peau verte, chair rouge'],
                ]
            ],
            [
                'nom' => 'Mûre',
                'description' => 'Fruit de la ronce, noir et sucré.',
                'varietes' => [
                    ['nom' => 'Thornfree', 'caracteristiques' => 'Sans épines, gros fruits'],
                    ['nom' => 'Chester', 'caracteristiques' => 'Sans épines, très productive'],
                    ['nom' => 'Loch Ness', 'caracteristiques' => 'Sans épines, longue période de récolte'],
                    ['nom' => 'Triple Crown', 'caracteristiques' => 'Sans épines, gros fruits sucrés'],
                    ['nom' => 'Navaho', 'caracteristiques' => 'Érigée, autofertile'],
                ]
            ],
            [
                'nom' => 'Myrtille',
                'description' => 'Petite baie bleue, riche en antioxydants.',
                'varietes' => [
                    ['nom' => 'Bluecrop', 'caracteristiques' => 'Standard, gros fruits, productive'],
                    ['nom' => 'Duke', 'caracteristiques' => 'Précoce, ferme, bonne conservation'],
                    ['nom' => 'Patriot', 'caracteristiques' => 'Résistante au froid, gros fruits'],
                    ['nom' => 'Chandler', 'caracteristiques' => 'Très gros fruits, maturation échelonnée'],
                    ['nom' => 'Pink Lemonade', 'caracteristiques' => 'Fruits roses, saveur douce'],
                ]
            ],
        ];

        // Vérifier si on a déjà des produits
        if (Produit::count() > 0) {
            $this->command->info('Des produits existent déjà. Pour réinitialiser, utilisez: php artisan migrate:fresh --seed');
            return;
        }

        $this->command->info('Création des produits et variétés...');
        $bar = $this->command->getOutput()->createProgressBar(count($produitsAvecVarietes));

        foreach ($produitsAvecVarietes as $produitData) {
            // Créer le produit
            $produit = Produit::create([
                'nom_produit' => $produitData['nom'],
                'description_produit' => $produitData['description'],
                'created_at' => now()->subDays(rand(1, 365)), // Dates aléatoires dans l'année
            ]);

            // Créer les variétés pour ce produit
            foreach ($produitData['varietes'] as $varieteData) {
                Varietee::create([
                    'nom_varietee' => $varieteData['nom'],
                    'caracteristique_varietee' => $varieteData['caracteristiques'],
                    'produit_id' => $produit->id,
                    'created_at' => $produit->created_at->addDays(rand(1, 30)),
                ]);
            }

            $bar->advance();
        }

        $bar->finish();
        $this->command->newLine(2);

        $produitCount = Produit::count();
        $varieteCount = Varietee::count();

        $this->command->info("✅ {$produitCount} produits créés avec {$varieteCount} variétés au total.");
        $this->command->info('Chaque produit a 5 variétés associées.');
    }
}

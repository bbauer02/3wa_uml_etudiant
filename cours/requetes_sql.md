* Liste des Guildes disponibles

```sql
SELECT * FROM `guild`
```
Cette requête sélectionne toutes les colonnes de la table `guild` et récupère toutes les lignes, affichant ainsi toutes les données contenues dans cette table.

* Liste des Guildes comportant au moins 2 joueurs

```sql
SELECT g.guild_id, g.name, COUNT(p.player_id) AS player_count
FROM guild g
JOIN player p ON g.guild_id = p.guild_id
GROUP BY g.guild_id, g.name
HAVING COUNT(p.player_id) >= 2;

```
Cette requête utilise une jointure entre les tables `guild` et `player` pour associer les joueurs à leur guilde. Ensuite, nous regroupons les résultats par l'ID de guilde et le nom de la guilde à l'aide de la clause GROUP BY. La clause HAVING est utilisée pour filtrer uniquement les guildes ayant un nombre de joueurs supérieur ou égal à 2. La colonne "player_count" représente le nombre de joueurs dans chaque guilde.

* Liste des Guildes dont le nom commence par la lettre A.

```sql
SELECT guild_id, name
FROM guild
WHERE name LIKE 'A%';
```
Cette requête sélectionne les colonnes `guild_id` et `name` de la table `guild` en filtrant les résultats pour inclure uniquement les guildes dont le nom commence par la lettre 'A' en utilisant la clause WHERE et l'opérateur LIKE avec le motif 'A%'.

* Liste des joueurs dont la classe est Warlock

```sql
SELECT player_id, name
FROM player
WHERE class = 'Warlock';
```

 Cette requête sélectionne les colonnes "player_id" et `name` de la table `player` en filtrant les résultats pour inclure uniquement les joueurs dont la classe est égale à "Warlock" en utilisant la clause WHERE avec l'opérateur d'égalité (=).


* Liste des joueurs qui n'ont pas de guilde

```sql
SELECT player_id, name
FROM player
WHERE guild_id IS NULL;
```
 Cette requête sélectionne les colonnes "player_id" et `name` de la table `player` en filtrant les résultats pour inclure uniquement les joueurs qui n'ont pas de guilde. Cela est réalisé en utilisant la clause WHERE avec la condition "guild_id IS NULL".

* Liste des Guildes ainsi que le nombre de joueurs en faisant parti

```sql
SELECT g.guild_id, g.name, COUNT(p.player_id) AS player_count
FROM guild g
LEFT JOIN player p ON g.guild_id = p.guild_id
GROUP BY g.guild_id, g.name;
```

 Cette requête  utilise une jointure LEFT JOIN entre les tables `guild` et `player` pour récupérer toutes les guildes, même celles qui n'ont aucun joueur. En utilisant COUNT(p.player_id) avec GROUP BY, nous obtenons le nombre de joueurs pour chaque guilde.

 Cette requête retourne les ID et les noms des guildes, ainsi que le nombre de joueurs (player_count) pour chaque guilde. Elle inclut également les guildes qui n'ont pas de joueurs, car elle utilise une jointure LEFT JOIN.


* Nombre de personnage par class

```sql
SELECT class, COUNT(*) AS character_count
FROM player
GROUP BY class;
```

 Cette requête sélectionne la colonne `class` de la table `player` et utilise la fonction d'agrégation COUNT(*) pour compter le nombre de personnages pour chaque classe. La clause GROUP BY est utilisée pour regrouper les résultats par classe.


* Liste des joueurs avec le plus de point de vie

```sql
SELECT player_id, name, health
FROM player
ORDER BY health DESC
LIMIT 1;
```

 Cette requête sélectionne les colonnes "player_id", `name` et `health` de la table `player`. En utilisant la clause ORDER BY avec "health DESC", elle trie les résultats en ordre décroissant des points de vie (health). Enfin, la clause LIMIT 1 est utilisée pour limiter les résultats à une seule ligne, correspondant au joueur ayant le plus de points de vie.

ou 

```sql
SELECT player_id, name, health
FROM player
WHERE health = (SELECT MAX(health) FROM player);
```
 Cette requête sélectionne les colonnes "player_id", `name` et `health` de la table `player`. En utilisant une sous-requête avec "SELECT MAX(health) FROM player", elle compare les valeurs de la colonne `health` avec la valeur maximale des points de vie dans la table `player`. La condition WHERE "health = (SELECT MAX(health) FROM player)" est utilisée pour filtrer les résultats et ne récupérer que les joueurs ayant le maximum de points de vie.

* Liste des groupes ainsi que le nombre de joueurs en faisant partie.

```sql
SELECT p.party_id, COUNT(pl.player_id) AS player_count
FROM party p
LEFT JOIN player pl ON p.party_id = pl.party_id
GROUP BY p.party_id;

```
Cette requête utilise une jointure LEFT JOIN entre les tables `party` et `player` pour associer les joueurs à leurs groupes (parties). En utilisant COUNT(pl.player_id), nous comptons le nombre de joueurs (player_id) pour chaque groupe. La clause GROUP BY est utilisée pour regrouper les résultats par ID de groupe (party_id).

La requête retourne les ID de groupe (party_id) et le nombre de joueurs (player_count) pour chaque groupe, y compris les groupes qui n'ont aucun joueur en raison de la jointure LEFT JOIN.

* Liste des items présent dans l'inventaire du joueur 10 ainsi que son nom et sa guilde

```sql
FROM inventory inv
JOIN item i ON inv.item_id = i.item_id
JOIN player p ON inv.character_id = p.player_id
LEFT JOIN guild g ON p.guild_id = g.guild_id
WHERE inv.character_id = 10;
```

Cette requête effectue une jointure entre les tables `inventory`, `item`, `player` et utilise une jointure gauche (LEFT JOIN) avec la table `guild`. Elle associe les items de l'inventaire du joueur avec l'ID 10 en utilisant les identifiants correspondants. Les colonnes sélectionnées incluent l'ID de l'item (item_id), son nom (name), l'ID du joueur (player_id), le nom du joueur (player_name), l'ID de la guilde (guild_id) et le nom de la guilde (guild_name). La condition WHERE limite les résultats au joueur avec l'ID 10.


* Liste des joueurs possédant un item de qualité Artifact.

```sql
SELECT p.player_id, p.name
FROM player p
JOIN inventory inv ON p.player_id = inv.character_id
JOIN item i ON inv.item_id = i.item_id
JOIN itemquality iq ON i.itemQuality_id = iq.itemQuality_id
WHERE iq.label = 'Artifact';
```
Cette requête effectue une série de jointures pour associer les joueurs à leurs items et vérifier la qualité de ces items. Elle sélectionne les colonnes "player_id" et `name` de la table `player` pour les joueurs dont les items ont la qualité "Artifact" (en utilisant la colonne "label" de la table "itemquality").

La requête retourne les ID et les noms des joueurs qui possèdent des items de qualité "Artifact".

* Liste des armures de qualité Rare

```sql
SELECT item_id, name
FROM item
JOIN itemcategory ON item.itemCategory_id = itemcategory.itemCategory_id
JOIN itemquality ON item.itemQuality_id = itemquality.itemQuality_id
WHERE itemcategory.label = 'Armor' AND itemquality.label = 'Rare';
```
Cette requête sélectionne les colonnes "item_id" et `name` de la table `item` pour les items qui appartiennent à la catégorie "Armor" (en utilisant la colonne "label" de la table "itemcategory") et ont la qualité "Rare" (en utilisant la colonne "label" de la table "itemquality").

La requête retourne les ID et les noms des items qui satisfont les critères de catégorie "Armor" et de qualité "Rare".

* Liste des mobs lootant des artifacts.

```sql
SELECT m.mob_id, m.name
FROM mob m
JOIN tableloot tl ON m.mob_id = tl.mob_id
JOIN item i ON tl.item_id = i.item_id
JOIN itemquality iq ON i.itemQuality_id = iq.itemQuality_id
WHERE iq.label = 'Artifact';
```
Cette requête effectue des jointures pour associer les mobs à leurs loots (tableloot), vérifier la qualité des items (itemquality) et sélectionner les mobs dont les items ont la qualité "Artifact" (en utilisant la colonne "label" de la table "itemquality").

La requête retourne les ID et les noms des mobs qui lootent des items de qualité "Artifact".

* Liste des mobs par ordre de puissance : + de PV, + de rage + de mana et elite

```sql
SELECT mob_id, name, health, rage, mana, isElite
FROM mob
ORDER BY health DESC, rage DESC, mana DESC, isElite DESC;
```
Cette requête retourne les ID des mobs (mob_id), leurs noms (name), leurs points de vie (health), leur rage (rage), leur mana (mana) et leur statut élite (isElite). Les résultats sont triés en ordre décroissant des points de vie, de la rage, du mana et du statut élite.

Elle sélectionne les colonnes "mob_id", `name`, `health`, "rage", "mana" et "isElite" de la table "mob". En utilisant la clause ORDER BY, elle trie les résultats en ordre décroissant des points de vie (health), de la rage (rage), du mana (mana) et du statut élite (isElite).


* Liste des joueurs dont le nombre d'objet dans son inventaire est supérieur à la valeur de la capacité de l'inventaire

```sql
SELECT p.player_id, p.name, COUNT(inv.item_id) AS item_count, inv.capacity
FROM player p
JOIN inventory inv ON p.player_id = inv.character_id
GROUP BY p.player_id, p.name, inv.capacity
HAVING COUNT(inv.item_id) > inv.capacity;
```
Cette requête effectue une jointure entre les tables `player` et `inventory` en utilisant l'ID du joueur (player_id) pour associer les joueurs à leur inventaire. La clause GROUP BY est utilisée pour regrouper les résultats par joueur et capacité de l'inventaire. Ensuite, la clause HAVING est utilisée pour filtrer les joueurs dont le nombre d'objets dans l'inventaire (COUNT(inv.item_id)) est supérieur à la capacité de l'inventaire (inv.capacity).

La requête retourne les colonnes "player_id", `name`, "item_count" (nombre d'objets dans l'inventaire) et "capacity" (capacité de l'inventaire) pour les joueurs dont le nombre d'objets dans l'inventaire est supérieur à la capacité de l'inventaire.


* Liste des joueurs les plus puissants : la puissance est calculée en faisant : la somme des caract. et des bonus des items présents dans l'inventaire.

```sql
SELECT p.player_id, p.name, SUM(i.bonusDamage + i.bonusHp + i.bonusRage + i.bonusProtection) AS total_power
FROM player p
JOIN inventory inv ON p.player_id = inv.character_id
JOIN item i ON inv.item_id = i.item_id
GROUP BY p.player_id, p.name
ORDER BY total_power DESC;
```

ette requête effectue des jointures entre les tables `player`, `inventory` et `item` en utilisant les identifiants correspondants. Elle utilise la fonction d'agrégation SUM() pour calculer la somme des caractéristiques et des bonus (bonusDamage, bonusHp, bonusRage, bonusProtection) de tous les items présents dans l'inventaire de chaque joueur. La clause GROUP BY est utilisée pour regrouper les résultats par joueur. Enfin, la clause ORDER BY est utilisée pour trier les résultats en ordre décroissant de la puissance totale (total_power).

La requête retourne les colonnes "player_id", `name` et "total_power" (puissance totale calculée) pour les joueurs, triés du plus puissant au moins puissant.

* Afficher les joueurs avec leur caractéristiques mis à jour avec les bonus des objets de l'inventaire.

```sql
SELECT p.player_id, p.name,
    (p.health + COALESCE(SUM(i.bonusHp), 0)) AS updated_health,
    (p.rage + COALESCE(SUM(i.bonusRage), 0)) AS updated_rage,
    (p.damage + COALESCE(SUM(i.bonusDamage), 0)) AS updated_damage,
    (p.protection + COALESCE(SUM(i.bonusProtection), 0)) AS updated_protection
FROM player p
LEFT JOIN inventory inv ON p.player_id = inv.character_id
LEFT JOIN item i ON inv.item_id = i.item_id
GROUP BY p.player_id, p.name, p.health, p.mana, p.rage;

```
Cette requête effectue une jointure LEFT JOIN entre les tables `player`, `inventory` et `item` en utilisant les identifiants correspondants. Elle utilise la fonction d'agrégation SUM() pour calculer la somme des bonus des objets (bonusHp, bonusRage, bonusDamage, bonus Protection) de l'inventaire de chaque joueur. Les valeurs mises à jour des caractéristiques (health, rage, damage, protection) sont obtenues en ajoutant les valeurs des caractéristiques de base du joueur avec les bonus des objets correspondants. La fonction COALESCE() est utilisée pour gérer les cas où un joueur n'a pas d'objet dans son inventaire (retourne 0 si la somme est NULL).

La requête retourne les colonnes "player_id", `name`, "updated_health" (santé mise à jour), "updated_rage" (rage mis à jour) , updated_damage, updated_protection pour chaque joueur. Les caractéristiques sont mises à jour en fonction des bonus des objets de leur inventaire.

* Proposer une modification de la BDD pour permettre d'équiper du matériel présent dans l'inventaire.

* Ajouter des données dans la ou les tables créées .
* Afficher les joueurs avec leur caractéristiques mis à jour avec les bonus des objets équipés..

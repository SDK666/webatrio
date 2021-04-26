# Écrire les chaînes XPath permettant de :

1) Retourner tous les éléments book
2) Retourner tous les éléments title ayant comme parent un élément book avec un attribut type
égal à roman
3) Retourner le nombre d'éléments book ayant un attribut type égal à bd
4) Que renvoie la requête XPath suivante : /library/library/ancestor-or-self::library

## éléments 'book'
``` $x("/library/book") ```

## éléments 'title' de 'book' = 'roman'
``` $x("//title/@parent[type='roman']") ```

## nombre 'book' = 'bd'
``` count(//book[type='bd']) ```

## /library/library/ancestor-or-self::library
<library>
	<library>
		<book type="roman">
			<title>toto5</title>
			<author>titi</author>
		</book>
	</library>
</library>

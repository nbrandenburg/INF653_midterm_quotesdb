CREATE TABLE `authors` (
    `id` int(13) NOT NULL AUTO_INCREMENT,
    `author` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO `authors`(`id`, `author`) VALUES
(1, 'Bob Marley'),
(2, 'Eleanor Roosevelt'),
(3, 'Mark Twain'),
(4, 'Pablo Picasso'), 
(5, 'Dolly Parton'), 
(6, 'Friedrich Nietzsche'),
(7, 'Winston Churchill'),
(8, 'Groucho Marx'),
(9, 'Abraham Lincoln'),
(10, 'Isaac Asimov'),
(11, 'Victor Hugo'),
(12, 'George Carlin'),
(13, 'Orson Welles');

CREATE TABLE `categories` (
    `id` int(7) NOT NULL AUTO_INCREMENT,
    `category` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'Wisdom'),
(2, 'Music'), 
(3, 'Art'),
(4, 'Food'), 
(5, 'Pets'),
(6, 'Funny'),
(7, 'Science');

CREATE TABLE `quotes` (
    `id` int(25) NOT NULL AUTO_INCREMENT,
    `quote` varchar(255) NOT NULL,
    `author_id` int(13) NOT NULL,
    `category_id` int(7) NOT NULL,
    PRIMARY KEY (`id`)
);

ALTER TABLE `quotes` 
    ADD CONSTRAINT fk_author_id
    FOREIGN KEY (`author_id`)
    REFERENCES `authors`(`id`);

ALTER TABLE `quotes` 
    ADD CONSTRAINT fk_category_id
    FOREIGN KEY (`category_id`)
    REFERENCES `categories`(`id`);

INSERT INTO `quotes` (`id`, `quote`, `author_id`, `category_id`) VALUES
(1, "Don't gain the world and lose your soul; wisdom is better than silver or gold.", 1, 1),
(2, "Great minds discuss ideas; average minds discuss events; small minds discuss people.", 2, 1),
(3, "The only way to keep your health is to eat what you don't want, drink what you don't like, and do what you'd rather not.", 3, 4),
(4, "Every single diet I ever fell off of was because of potatoes and gravy of some sort.", 5, 4), 
(5, "The purpose of art is washing the dust of daily life off our souls.", 4, 3),
(6, "Without music, life would be a mistake.", 6, 2), 
(7, "I am fond of pigs. Dogs look up to us. Cats look down on us. Pigs treat us as equals.", 7, 5),
(8, "Outside of a dog, a book is a man's best friend. Inside of a dog it's too dark to read.", 8, 5),
(9, "No matter how much cats fight, there always seem to be plenty of kittens.", 9, 5),
(10, "People who think they know everything are a great annoyance to those of us who do.", 10, 1),
(11, "I refuse to join any club that would have me as a member.", 8, 6),
(12, "The essence of all beautiful art, all great art, is gratitude.", 6, 3),
(13, "Without tradition, art is a flock fo sheep without a shepherd. Without innovation, it is a corpse.", 7, 3),
(14, "One good thing about music, when it hits you, you feel no pain.", 1, 2), 
(15, "Music expresses that which cannot be said and on which it is impossible to be silent.", 11, 2), 
(16, "May the forces of evil become confused on the way to your house.", 12, 6),
(17, "Don't sweat the petty things and don't pet the sweaty things.", 12, 6), 
(18, "What kills a skunk is the publicity it gives itself.", 9, 1),
(19, "No man has a good enough memory to be a successful liar.", 9, 1),
(20, "I love Velveeta cheese.", 5, 4), 
(21, "Buy land, they're not making it anymore.", 3, 1),
(22, "It's not the size of the dog in the fight; it's the size of the fight in the dog.", 3, 5),
(23, "My doctor told me to stop having intimate dinners for four. Unless there are three other people.", 13, 4),
(24, "The true delight is in the finding out rather than in the knowing.", 10, 7),
(25, "There is a single light of science, and to brighten it anywhere is to brighten it everywhere.", 10, 7);
DROP TABLE IF EXISTS User;
CREATE TABLE User(
    idUser integer PRIMARY KEY AUTOINCREMENT,
    profilePic varchar DEFAULT '../populate_db/default_profile.jpg',
    nome varchar NOT NULL,
    username varchar UNIQUE NOT NULL,
    email varchar UNIQUE NOT NULL,
    isAdmin integer CHECK (isAdmin in (1,0)) DEFAULT 0,
    userPassword varchar
);


DROP TABLE IF EXISTS Book;
CREATE TABLE Book(
    idBook integer PRIMARY KEY AUTOINCREMENT,
    imagePath varchar,
    seller varchar,
    nome varchar,
    price DECIMAL(5,2) CHECK (price > 0),
    genre varchar,                                      -- comma separated genres
    author varchar,
    publisher varchar,
    condition varchar,
    publicationDate date,
    isTradeable integer CHECK (isTradeable in (1,0)),
    isAvailable integer CHECK (isAvailable in (2,1,0)), -- 2 -> sold, 1 -> available, 0 -> unavailable
    FOREIGN KEY (seller) REFERENCES User(username)
);

DROP TABLE IF EXISTS Cart;
CREATE TABLE Cart(
    buyer integer,
    bookToBuy integer,
    PRIMARY KEY (buyer, bookToBuy),
    FOREIGN KEY (buyer) REFERENCES User(idUser),
    FOREIGN KEY (bookToBuy) REFERENCES Book(idBook)
    ON UPDATE CASCADE
);

DROP TABLE IF EXISTS Wishlist;
CREATE TABLE Wishlist(
    buyer integer,
    bookToBuy integer,
    PRIMARY KEY (buyer, bookToBuy),
    FOREIGN KEY (buyer) REFERENCES User(idUser),
    FOREIGN KEY (bookToBuy) REFERENCES Book(idBook)
    ON UPDATE CASCADE
);

DROP TABLE IF EXISTS Genres;
CREATE TABLE Genres(
    idGenre integer PRIMARY KEY AUTOINCREMENT,
    valor varchar UNIQUE,
    nome varchar UNIQUE
);

DROP TABLE IF EXISTS SubGenres;
CREATE TABLE SubGenres(
    idSubGenre integer PRIMARY KEY AUTOINCREMENT,
    nome varchar UNIQUE,
    valor varchar UNIQUE
);

/*
DROP TABLE IF EXISTS Trade;
CREATE TABLE Trade(
    idTrade integer PRIMARY KEY AUTOINCREMENT,
    tradeDate date,
    tradeStatus varchar,
    bookToTrade integer,
    proposedBook integer,
    FOREIGN KEY (bookToTrade) REFERENCES Book(idBook),
    FOREIGN KEY (proposedBook) REFERENCES Book(idBook)
);

If only I had more time :(

*/

DROP TABLE IF EXISTS Comments;
CREATE TABLE comments(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user TEXT NOT NULL,
    idBook INTEGER NOT NULL,
    comment TEXT NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    FOREIGN KEY (idBook) REFERENCES Book(idBook)
);

DROP TABLE IF EXISTS Replies;
CREATE TABLE replies(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user TEXT NOT NULL,
    idComment INTEGER NOT NULL,
    reply TEXT NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    FOREIGN KEY (idComment) REFERENCES comments(id)
);

-- Inserting data

insert into User (nome, username, email, userPassword) 
values('Diogo', 'calamberr', 'up202205295@up.pt', '$2y$10$FrEEdSkCzrG8kGm68UDFZe57.XgunlxtI9FY.tQT25qNv/aMObeuu');

insert into User (nome, username, email, userPassword) 
values('Gabriel', 'maggyu', 'up202208939@up.pt', '$2y$10$17vgyw.b/tWmIGrfL67gBeDcLZZBadMVDLKsYT4At9MTQn8hhQwgG');

insert into User (nome, username, email, userPassword) 
values('Restivo', 'OlhOs_Lindos', 'restivo@gmail.com', '$2y$10$kIAS6Y6ftAJRekMTWajMyOqIjup28tPSuaLBKG8t.EsiQfzH4Jvuu');

insert into User (nome, username, email, isAdmin, userPassword)
values('Admin', 'admin', 'admin@gmail.com', 1, '$2y$10$1VC9DF.f06uNzzl3annBEu7spZlobvnDLtcHppxh6g0VJzErtIkOm');



insert into Book (imagePath, seller, nome, price, genre, author, publisher, condition, publicationDate, isTradeable, isAvailable)
values('../populate_db/default_cover.jpg', 'calamberr', 'Harry Potter', 39.99, 'Fiction,Romance', 'JK Rowling', 'Presença', 'New', '2024-10-07', 1, 1);

insert into Book (imagePath, seller, nome, price, genre, author, publisher, condition, publicationDate, isTradeable, isAvailable)
values('../populate_db/default_cover.jpg', 'maggyu', 'Titanic', 19.99, 'Romance', 'DiCaprio', 'Paramount', 'Used', '2024-10-07', 1, 1);

insert into Book (imagePath, seller, nome, price, genre, author, publisher, condition, publicationDate, isTradeable, isAvailable)
values('../populate_db/default_cover.jpg', 'OlhOs_Lindos', 'The Great Gatsby', 15.99, 'Fiction', 'F. Scott Fitzgerald', 'Scribner', 'Used', '2022-03-15', 0, 1);

insert into Book (imagePath, seller, nome, price, genre, author, publisher, condition, publicationDate, isTradeable, isAvailable)
values('../populate_db/default_cover.jpg', 'calamberr', 'To Kill a Mockingbird', 25.99, 'Fiction', 'Harper Lee', 'J.B. Lippincott & Co.', 'New', '2024-10-07', 1, 1);

insert into Book (imagePath, seller, nome, price, genre, author, publisher, condition, publicationDate, isTradeable, isAvailable)
values('../populate_db/default_cover.jpg', 'maggyu', '1984', 19.99, 'Fiction', 'George Orwell', 'Secker & Warburg', 'Used', '2024-10-07', 1, 1);

insert into Book (imagePath, seller, nome, price, genre, author, publisher, condition, publicationDate, isTradeable, isAvailable)
values('../populate_db/default_cover.jpg', 'OlhOs_Lindos', 'The Catcher in the Rye', 15.99, 'Fiction', 'J.D. Salinger', 'Little, Brown and Company', 'Used', '2022-03-15', 0, 1);

insert into Book (imagePath, seller, nome, price, genre, author, publisher, condition, publicationDate, isTradeable, isAvailable)
values('../populate_db/default_cover.jpg', 'calamberr', 'The Hobbit', 30.99, 'Fantasy,Action', 'J.R.R. Tolkien', 'George Allen & Unwin', 'New', '2024-10-07', 1, 1);

insert into Book (imagePath, seller, nome, price, genre, author, publisher, condition, publicationDate, isTradeable, isAvailable)
values('../populate_db/default_cover.jpg', 'maggyu', 'Moby-Dick', 20.99, 'Fiction,Action', 'Herman Melville', 'Harper & Brothers', 'Used', '2024-10-07', 1, 1);

insert into Book (imagePath, seller, nome, price, genre, author, publisher, condition, publicationDate, isTradeable, isAvailable)
values('../populate_db/default_cover.jpg', 'OlhOs_Lindos', 'Scream', 15.99, 'Fiction,Horror', 'J.D. Salinger', 'Little, Brown and Company', 'Used', '2022-03-15', 0, 1);



insert into Genres (nome, valor)
values('All', '');

insert into Genres (nome, valor)
values('Action', 'action');

insert into Genres (nome, valor)
values('Romance', 'romance');

insert into Genres (nome, valor)
values('Fantasy', 'fantasy');

insert into Genres (nome, valor)
values('Biography', 'biography');

insert into Genres (nome, valor)
values('Comedy', 'comedy');



insert into SubGenres (nome, valor)
values('None', '');

insert into SubGenres (nome, valor)
values('Adventure', 'adventure');

insert into SubGenres (nome, valor)
values('Drama', 'drama');

insert into SubGenres (nome, valor)
values('Mystery', 'mystery');

insert into SubGenres (nome, valor)
values('Thriller', 'thriller');

insert into SubGenres (nome, valor)
values('Sci-fi', 'sci-fi');


/*
insert into Trade (tradeDate, tradeStatus, bookToTrade ,proposedBook) 
values('2024-10-07', 'accepted', 02, 01);

insert into Trade (tradeDate, tradeStatus, bookToTrade, proposedBook)
values('2024-07-30', 'denied', 03, 04);
*/



insert into Cart (buyer, bookToBuy) 
values(01, 03);

insert into Cart (buyer, bookToBuy)
values(02, 04);

insert into Cart (buyer, bookToBuy)
values(03, 01);

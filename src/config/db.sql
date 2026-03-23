
CREATE DATABASE IF NOT EXISTS ProjetHotel;
USE ProjetHotel; 

-- ============================================================
-- Tables principales
-- ============================================================

CREATE TABLE Client (
    id_client   INT PRIMARY KEY AUTO_INCREMENT,
    nom         VARCHAR(50)  NOT NULL,
    prenom      VARCHAR(50)  NOT NULL,
    email       VARCHAR(191) NOT NULL UNIQUE,
    mdp         VARCHAR(255) NOT NULL
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

CREATE TABLE Chambre (
    id_chambre  INT PRIMARY KEY AUTO_INCREMENT,
    name        VARCHAR(50)  NOT NULL,
    description TEXT,
    image       VARCHAR(255),
    options     VARCHAR(255),
    prix        DECIMAL(10,2) NOT NULL,
    occupe      BOOLEAN DEFAULT FALSE,
    categorie   VARCHAR(50)
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

CREATE TABLE Salle (
    id_salle    INT PRIMARY KEY AUTO_INCREMENT,
    name        VARCHAR(50) NOT NULL,
    description TEXT,
    image       VARCHAR(255),
    type        VARCHAR(50),
    options     VARCHAR(255)
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

CREATE TABLE Piscine (
    id_piscine  INT PRIMARY KEY AUTO_INCREMENT,
    name        VARCHAR(100) NOT NULL,
    description TEXT,
    image       VARCHAR(255),
    ouverture   TIME,
    fermeture   TIME,
    nettoyage   DATE
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

CREATE TABLE Restaurant (
    id_restaurant   INT PRIMARY KEY AUTO_INCREMENT,
    name            VARCHAR(50) NOT NULL
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

CREATE TABLE Bar (
    id_bar  INT PRIMARY KEY AUTO_INCREMENT,
    name    VARCHAR(50) NOT NULL
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

CREATE TABLE Menu (
    id_menu     INT PRIMARY KEY AUTO_INCREMENT,
    name        VARCHAR(50) NOT NULL,
    description VARCHAR(255),
    image       VARCHAR(255),
    prix_un     FLOAT NOT NULL
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

CREATE TABLE Boisson (
    id_boisson  INT PRIMARY KEY AUTO_INCREMENT,
    name        VARCHAR(50) NOT NULL,
    description VARCHAR(255),
    image       VARCHAR(255),
    prix_un     FLOAT NOT NULL
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

CREATE TABLE Facture (
    id_facture      INT PRIMARY KEY AUTO_INCREMENT,
    num_reference   INT NOT NULL,
    date            DATE NOT NULL,
    total_ttc       FLOAT NOT NULL
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

-- ============================================================
-- Tables de liaison
-- ============================================================

CREATE TABLE Client_Facture (
    id_client   INT NOT NULL,
    id_facture  INT NOT NULL,
    PRIMARY KEY (id_client, id_facture),
    FOREIGN KEY (id_client)  REFERENCES Client(id_client)   ON DELETE CASCADE,
    FOREIGN KEY (id_facture) REFERENCES Facture(id_facture) ON DELETE CASCADE
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

CREATE TABLE Client_Chambre (
    id                      INT PRIMARY KEY AUTO_INCREMENT,
    id_client               INT NOT NULL,
    id_chambre              INT NOT NULL,
    date_debut_reservation  DATE NOT NULL,
    date_fin_reservation    DATE NOT NULL,
    num_reservation         INT NOT NULL,
    status                  VARCHAR(50) DEFAULT 'en attente',
    FOREIGN KEY (id_client)  REFERENCES Client(id_client)   ON DELETE CASCADE,
    FOREIGN KEY (id_chambre) REFERENCES Chambre(id_chambre) ON DELETE CASCADE
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

CREATE TABLE Client_Salle (
    id                      INT PRIMARY KEY AUTO_INCREMENT,
    id_client               INT NOT NULL,
    id_salle                INT NOT NULL,
    date_debut_reservation  DATE NOT NULL,
    date_fin_reservation    DATE NOT NULL,
    num_reservation         INT NOT NULL,
    status                  VARCHAR(50) DEFAULT 'en attente',
    FOREIGN KEY (id_client) REFERENCES Client(id_client) ON DELETE CASCADE,
    FOREIGN KEY (id_salle)  REFERENCES Salle(id_salle)   ON DELETE CASCADE
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

CREATE TABLE Client_Piscine (
    id                      INT PRIMARY KEY AUTO_INCREMENT,
    id_client               INT NOT NULL,
    id_piscine              INT NOT NULL,
    date_debut_reservation  DATE NOT NULL,
    date_fin_reservation    DATE NOT NULL,
    num_reservation         INT NOT NULL,
    status                  VARCHAR(50) DEFAULT 'en attente',
    FOREIGN KEY (id_client)  REFERENCES Client(id_client)   ON DELETE CASCADE,
    FOREIGN KEY (id_piscine) REFERENCES Piscine(id_piscine) ON DELETE CASCADE
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

CREATE TABLE Client_Menu (
    id          INT PRIMARY KEY AUTO_INCREMENT,
    id_client   INT NOT NULL,
    id_menu     INT NOT NULL,
    quantite    INT NOT NULL DEFAULT 1,
    date        DATE NOT NULL,
    FOREIGN KEY (id_client) REFERENCES Client(id_client) ON DELETE CASCADE,
    FOREIGN KEY (id_menu)   REFERENCES Menu(id_menu)     ON DELETE CASCADE
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

CREATE TABLE Client_Boisson (
    id          INT PRIMARY KEY AUTO_INCREMENT,
    id_client   INT NOT NULL,
    id_boisson  INT NOT NULL,
    quantite    INT NOT NULL DEFAULT 1,
    date        DATE NOT NULL,
    FOREIGN KEY (id_client)  REFERENCES Client(id_client)   ON DELETE CASCADE,
    FOREIGN KEY (id_boisson) REFERENCES Boisson(id_boisson) ON DELETE CASCADE
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

CREATE TABLE Restaurant_Menu (
    id_restaurant   INT NOT NULL,
    id_menu         INT NOT NULL,
    PRIMARY KEY (id_restaurant, id_menu),
    FOREIGN KEY (id_restaurant) REFERENCES Restaurant(id_restaurant) ON DELETE CASCADE,
    FOREIGN KEY (id_menu)       REFERENCES Menu(id_menu)             ON DELETE CASCADE
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

CREATE TABLE Bar_Boisson (
    id_bar          INT NOT NULL,
    id_boisson      INT NOT NULL,
    quantite_stock  INT NOT NULL DEFAULT 0,
    PRIMARY KEY (id_bar, id_boisson),
    FOREIGN KEY (id_bar)     REFERENCES Bar(id_bar)          ON DELETE CASCADE,
    FOREIGN KEY (id_boisson) REFERENCES Boisson(id_boisson)  ON DELETE CASCADE
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

CREATE TABLE User (
    id_user     INT PRIMARY KEY AUTO_INCREMENT,
    username    VARCHAR(50)  NOT NULL UNIQUE,
    password    VARCHAR(255) NOT NULL,
    role        VARCHAR(20)  NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;



USE ProjetHotel;

-- ============================================================
-- Clients
-- ============================================================
INSERT INTO Client (nom, prenom, email, mdp) VALUES
('Dupont',    'Jean',    'jean.dupont@gmail.com',    '$2y$10$abcdefghijklmnopqrstuuVwXyZ0123456789abcdefghijklmnopq'),
('Martin',    'Sophie',  'sophie.martin@gmail.com',  '$2y$10$abcdefghijklmnopqrstuuVwXyZ0123456789abcdefghijklmnopq'),
('Leroy',     'Pierre',  'pierre.leroy@gmail.com',   '$2y$10$abcdefghijklmnopqrstuuVwXyZ0123456789abcdefghijklmnopq'),
('Bernard',   'Claire',  'claire.bernard@gmail.com', '$2y$10$abcdefghijklmnopqrstuuVwXyZ0123456789abcdefghijklmnopq'),
('Moreau',    'Lucas',   'lucas.moreau@gmail.com',   '$2y$10$abcdefghijklmnopqrstuuVwXyZ0123456789abcdefghijklmnopq');

-- ============================================================
-- Chambres
-- ============================================================
INSERT INTO Chambre (name, description, image, options, prix, occupe, categorie) VALUES
('Chambre Standard 101',  'Chambre confortable avec vue sur le jardin',       'chambre101.jpg', 'TV, WiFi, Climatisation',              85.00,  FALSE, 'Standard'),
('Chambre Standard 102',  'Chambre lumineuse avec lit double',                'chambre102.jpg', 'TV, WiFi, Coffre-fort',                85.00,  TRUE,  'Standard'),
('Chambre Supérieure 201','Grande chambre avec balcon et vue sur la mer',     'chambre201.jpg', 'TV, WiFi, Climatisation, Balcon',      130.00, FALSE, 'Supérieure'),
('Chambre Supérieure 202','Chambre élégante avec baignoire',                  'chambre202.jpg', 'TV, WiFi, Baignoire, Minibar',         140.00, TRUE,  'Supérieure'),
('Suite Deluxe 301',      'Suite luxueuse avec salon séparé et jacuzzi',      'suite301.jpg',   'TV, WiFi, Jacuzzi, Minibar, Balcon',   250.00, FALSE, 'Suite'),
('Suite Prestige 302',    'Suite prestige avec vue panoramique sur la mer',   'suite302.jpg',   'TV, WiFi, Jacuzzi, Minibar, Terrasse', 350.00, FALSE, 'Suite');

-- ============================================================
-- Salles
-- ============================================================
INSERT INTO Salle (name, description, image, type, options) VALUES
('Salle Versailles', 'Grande salle de conférence pour 100 personnes',  'salle1.jpg', 'Conférence',  'Projecteur, Micro, Climatisation, WiFi'),
('Salle Provence',   'Salle de réunion moderne pour 20 personnes',     'salle2.jpg', 'Réunion',     'Écran, Tableau blanc, WiFi'),
('Salle Riviera',    'Salle de banquet pour 200 personnes',            'salle3.jpg', 'Banquet',     'Scène, Sono, Éclairage, Climatisation'),
('Salle Lumière',    'Salle de séminaire avec équipements high-tech',  'salle4.jpg', 'Séminaire',   'Vidéoprojecteur, Micro, WiFi, Tableau');

-- ============================================================
-- Piscines
-- ============================================================
INSERT INTO Piscine (name, description, image, ouverture, fermeture, nettoyage) VALUES
('Piscine Extérieure',  'Grande piscine extérieure chauffée avec transats',  'piscine1.jpg', '08:00:00', '20:00:00', '2025-06-01'),
('Piscine Intérieure',  'Piscine couverte disponible toute l\'année',        'piscine2.jpg', '07:00:00', '22:00:00', '2025-05-15'),
('Piscine Enfants',     'Piscine peu profonde dédiée aux enfants',           'piscine3.jpg', '09:00:00', '19:00:00', '2025-06-10');

-- ============================================================
-- Restaurants
-- ============================================================
INSERT INTO Restaurant (name) VALUES
('Le Grand Bleu'),
('La Terrasse'),
('L\'Orangerie');

-- ============================================================
-- Bars
-- ============================================================
INSERT INTO Bar (name) VALUES
('Bar le Sunset'),
('Bar la Plage'),
('Bar Rooftop');

-- ============================================================
-- Menus
-- ============================================================
INSERT INTO Menu (name, description, image, prix_un) VALUES
('Entrée du jour',         'Salade niçoise avec thon et œufs',              'menu1.jpg', 12.50),
('Plat du jour',           'Filet de bœuf sauce bordelaise avec légumes',   'menu2.jpg', 28.00),
('Menu Gastronomique',     'Entrée + plat + dessert du chef',               'menu3.jpg', 55.00),
('Plateau de fromages',    'Sélection de fromages affinés',                 'menu4.jpg', 14.00),
('Dessert maison',         'Tarte tatin avec crème fraîche',                'menu5.jpg',  9.50),
('Menu Végétarien',        'Risotto aux champignons et parmesan',           'menu6.jpg', 22.00);

-- ============================================================
-- Boissons
-- ============================================================
INSERT INTO Boisson (name, description, image, prix_un) VALUES
('Eau minérale 50cl',   'Eau minérale naturelle',                    'eau.jpg',       3.00),
('Coca-Cola 33cl',      'Boisson gazeuse',                           'coca.jpg',      4.50),
('Vin rouge Bordeaux',  'Bordeaux rouge AOP 2019',                   'vin_rouge.jpg', 8.00),
('Vin blanc Chablis',   'Chablis premier cru 2020',                  'vin_blanc.jpg', 9.00),
('Mojito',              'Rhum, citron vert, menthe, sucre de canne', 'mojito.jpg',   11.00),
('Bière Heineken',      'Bière blonde pression 25cl',                'biere.jpg',     6.00),
('Jus d\'orange frais', 'Jus d\'orange pressé à la minute',          'jus.jpg',       5.50);

-- ============================================================
-- Factures
-- ============================================================
INSERT INTO Facture (num_reference, date, total_ttc) VALUES
(1001, '2025-05-10', 170.00),
(1002, '2025-05-12', 280.00),
(1003, '2025-05-15', 500.00),
(1004, '2025-05-18',  95.50),
(1005, '2025-05-20', 350.00);

-- ============================================================
-- Liaisons Client - Facture
-- ============================================================
INSERT INTO Client_Facture (id_client, id_facture) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- ============================================================
-- Réservations Chambres
-- ============================================================
INSERT INTO Client_Chambre (id_client, id_chambre, date_debut_reservation, date_fin_reservation, num_reservation, status) VALUES
(1, 1, '2025-06-01', '2025-06-05', 2001, 'confirmée'),
(2, 2, '2025-06-03', '2025-06-07', 2002, 'confirmée'),
(3, 4, '2025-06-10', '2025-06-14', 2003, 'en attente'),
(4, 5, '2025-06-15', '2025-06-20', 2004, 'confirmée'),
(5, 6, '2025-06-18', '2025-06-25', 2005, 'annulée');

-- ============================================================
-- Réservations Salles
-- ============================================================
INSERT INTO Client_Salle (id_client, id_salle, date_debut_reservation, date_fin_reservation, num_reservation, status) VALUES
(1, 1, '2025-06-05', '2025-06-05', 3001, 'confirmée'),
(2, 2, '2025-06-08', '2025-06-08', 3002, 'confirmée'),
(3, 3, '2025-06-12', '2025-06-12', 3003, 'en attente');

-- ============================================================
-- Réservations Piscine
-- ============================================================
INSERT INTO Client_Piscine (id_client, id_piscine, date_debut_reservation, date_fin_reservation, num_reservation, status) VALUES
(1, 1, '2025-06-02', '2025-06-04', 4001, 'confirmée'),
(2, 2, '2025-06-05', '2025-06-07', 4002, 'confirmée'),
(4, 1, '2025-06-16', '2025-06-19', 4003, 'confirmée');

-- ============================================================
-- Commandes Menus
-- ============================================================
INSERT INTO Client_Menu (id_client, id_menu, quantite, date) VALUES
(1, 3, 2, '2025-06-01'),
(2, 1, 1, '2025-06-03'),
(2, 2, 1, '2025-06-03'),
(3, 6, 2, '2025-06-10'),
(4, 3, 4, '2025-06-15'),
(5, 5, 3, '2025-06-18');

-- ============================================================
-- Commandes Boissons
-- ============================================================
INSERT INTO Client_Boisson (id_client, id_boisson, quantite, date) VALUES
(1, 3, 1, '2025-06-01'),
(1, 1, 2, '2025-06-01'),
(2, 5, 2, '2025-06-03'),
(3, 4, 1, '2025-06-10'),
(4, 6, 4, '2025-06-15'),
(5, 2, 2, '2025-06-18');

-- ============================================================
-- Liaisons Restaurant - Menu
-- ============================================================
INSERT INTO Restaurant_Menu (id_restaurant, id_menu) VALUES
(1, 1), (1, 2), (1, 3),
(2, 4), (2, 5),
(3, 6), (3, 1);

-- ============================================================
-- Stock Bar - Boisson
-- ============================================================
INSERT INTO Bar_Boisson (id_bar, id_boisson, quantite_stock) VALUES
(1, 1, 100), (1, 2, 50), (1, 5, 30), (1, 6, 80),
(2, 1, 80),  (2, 3, 40), (2, 4, 35), (2, 7, 60),
(3, 2, 60),  (3, 5, 25), (3, 6, 45), (3, 7, 70);

INSERT INTO User (username, password, role) VALUES
('admin',    '1234', 'admin'),
('receptionniste', '1234', 'staff');
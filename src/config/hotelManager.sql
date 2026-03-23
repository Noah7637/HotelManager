-- ============================================================
-- Base de données générée à partir du MCD
-- ============================================================

-- Active le support des grands index (requis pour utf8mb4 + VARCHAR)
SET GLOBAL innodb_large_prefix = ON;
SET GLOBAL innodb_file_format = Barracuda;
SET GLOBAL innodb_file_per_table = ON;

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

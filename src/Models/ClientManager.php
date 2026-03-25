<?php

namespace MVC\Models;

use MVC\Models\Client;

class ClientManager
{

    private $bdd;

    // Initialisation de la connexion à la base de données
    public function __construct()
    {
        $this->bdd = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    // Retourne l'instance de la connexion
    public function getBdd()
    {
        return $this->bdd;
    }

    // Récupération de tous les clients
    public function getAll()
    {
        $stmt = $this->bdd->query("SELECT * FROM client");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "MVC\Models\Client");

        return $stmt->fetchAll();
    }

    // Création d'un nouveau client en base de données
    public function create()
    {
        try {
        $stmt = $this->bdd->prepare("INSERT INTO client (nom, prenom, email, mdp) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            password_hash($_POST['mdp'], PASSWORD_BCRYPT)

        ]);
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                throw new \RuntimeException('Cette adresse e-mail est déjà utilisée.');
            }
        }
    }

    // Récupération du détail d'un client
    public function show($id)
    {
        $stmt = $this->bdd->prepare("SELECT
    c.id_client,
    c.nom,
    c.prenom,
    c.email,

    -- Réservations chambres
    cc.num_reservation      AS chambre_num_reservation,
    ch.name                 AS chambre_nom,
    ch.categorie            AS chambre_categorie,
    ch.prix                 AS chambre_prix,
    cc.date_debut_reservation AS chambre_date_debut,
    cc.date_fin_reservation   AS chambre_date_fin,
    cc.status               AS chambre_status,

    -- Réservations salles
    cs.num_reservation      AS salle_num_reservation,
    s.name                  AS salle_nom,
    s.type                  AS salle_type,
    cs.date_debut_reservation AS salle_date_debut,
    cs.date_fin_reservation   AS salle_date_fin,
    cs.status               AS salle_status,

    -- Réservations piscine
    cp.num_reservation      AS piscine_num_reservation,
    p.name                  AS piscine_nom,
    cp.date_debut_reservation AS piscine_date_debut,
    cp.date_fin_reservation   AS piscine_date_fin,
    cp.status               AS piscine_status,

    -- Commandes menus
    cm.date                 AS menu_date,
    m.name                  AS menu_nom,
    m.prix_un               AS menu_prix_unitaire,
    cm.quantite             AS menu_quantite,
    (m.prix_un * cm.quantite) AS menu_total,

    -- Commandes boissons
    cb.date                 AS boisson_date,
    b.name                  AS boisson_nom,
    b.prix_un               AS boisson_prix_unitaire,
    cb.quantite             AS boisson_quantite,
    (b.prix_un * cb.quantite) AS boisson_total,

    -- Factures
    f.num_reference         AS facture_reference,
    f.date                  AS facture_date,
    f.total_ttc             AS facture_total

FROM Client c

LEFT JOIN Client_Chambre  cc ON cc.id_client  = c.id_client
LEFT JOIN Chambre          ch ON ch.id_chambre = cc.id_chambre

LEFT JOIN Client_Salle    cs ON cs.id_client  = c.id_client
LEFT JOIN Salle            s  ON s.id_salle    = cs.id_salle

LEFT JOIN Client_Piscine  cp ON cp.id_client  = c.id_client
LEFT JOIN Piscine          p  ON p.id_piscine  = cp.id_piscine

LEFT JOIN Client_Menu     cm ON cm.id_client  = c.id_client
LEFT JOIN Menu             m  ON m.id_menu     = cm.id_menu

LEFT JOIN Client_Boisson  cb ON cb.id_client  = c.id_client
LEFT JOIN Boisson          b  ON b.id_boisson  = cb.id_boisson

LEFT JOIN Client_Facture  cf ON cf.id_client  = c.id_client
LEFT JOIN Facture          f  ON f.id_facture  = cf.id_facture

WHERE c.id_client = ?;");

        $stmt->execute([$id]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "MVC\Models\Restaurant");

        return $stmt->fetchAll();
    }

    // Suppression d'un client par son id
    public function delete($id)
    {
        $stmt = $this->bdd->prepare("DELETE FROM client WHERE id_client = ?");

        return $stmt->execute([$id]);
    }
}
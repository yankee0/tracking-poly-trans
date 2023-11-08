<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Livraisons;
use CodeIgniter\API\ResponseTrait;

class Api extends BaseController
{
    use ResponseTrait;
    public function track(string $tc = '%')
    {
        $tc = strtoupper($tc);
        $data = (new Livraisons())
            ->select('
                livraisons.id,
                livraisons.etat,
                fact_liv_lignes.conteneur,
                fact_liv_lignes.type,
                zones.nom AS zone,
                fact_liv_lieux.adresse,
                fact_liv_lieux.carburant,
                clients.nom AS nom_client,
                clients.tel AS tel_client,
                clients.email AS email_client,
                livraisons.created_at AS date_enregistrement,
                fact_liv.paiement,
                fact_liv.date_pg,
                fact_liv.pregate,
                fact_liv.bl,
                fact_liv.id as facture,
                fact_liv.compagnie,
                chauffeurs.nom AS ch_aller,
                chauffeurs.tel AS ch_tel,
                chauffeur2.nom AS ch_retour,
                camions.im AS cam_aller,
                camion2.im AS cam_retour,
                chauffeurs.id AS ch_aller_id,
                chauffeur2.id AS ch_retour_id,
                camions.id AS cam_aller_id,
                camion2.id AS cam_retour_id,
                livraisons.commentaire,
                livraisons.date_aller,
                livraisons.date_retour,
                livraisons.motif,
                livraisons.id as liv,
            ')
            ->join('chauffeurs', 'chauffeurs.id = livraisons.ch_aller', 'left')
            ->join('chauffeurs AS chauffeur2', 'chauffeur2.id = livraisons.ch_retour', 'left')
            ->join('camions', 'camions.id = livraisons.cam_aller', 'left')
            ->join('camions AS camion2', 'camion2.id = livraisons.cam_retour', 'left')
            ->join('fact_liv_lignes', 'fact_liv_lignes.id = id_fact_ligne', 'left')
            ->join('fact_liv_lieux', 'fact_liv_lignes.id_lieu = fact_liv_lieux.id', 'left')
            ->join('zones', 'zones.id = fact_liv_lieux.id_zone', 'left')
            ->join('fact_liv', 'fact_liv.id = fact_liv_lieux.id_fact', 'left')
            ->join('clients', 'clients.id = fact_liv.id_client', 'left')
            ->where('fact_liv.annulation', 'NON')
            ->where('fact_liv_lignes.conteneur', $tc)
            ->orWhere('fact_liv.bl', $tc)
            ->orderBy('fact_liv_lignes.conteneur', 'ASC')
            ->find();

        return $this->respond($data);
    }
}

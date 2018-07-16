<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

// DEBUT GET -------------------------------------------------------------------------
// Utilisateur
$app->get('/login/[{login}/{password}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM utilisateurs WHERE login=:login AND mdpUtilisateur=:password");
    $sth->bindParam("login", $args['login']);
    $sth->bindParam("password", $args['password']);
    $sth->execute();
    $utilisateur = $sth->fetchObject();
    return $this->response->withJson($utilisateur);
});

// PARTIE COMPOSANT
$app->get('/composants', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM composants");
    $sth->execute();
    $composants = $sth->fetchAll();
    return $this->response->withJson($composants);
});

$app->get('/composants/[{id}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM composants WHERE idComposant=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $composant = $sth->fetchObject();
    return $this->response->withJson($composant);
});

$app->post('/composants', function ($request, $response) {
    $input = $request->getParsedBody();
    $sql = "INSERT INTO `composants`(`nomComposant`, `idGamme`, `idFournisseur`, `prixComposant`) 
            VALUES (:nomComposant, :idGamme, :idFournisseur, :prixComposant);";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("nomComposant", $input['nomComposant']);
    $sth->bindParam("idGamme", $input['idGamme']);
    $sth->bindParam("idFournisseur", $input['idFournisseur']);
    $sth->bindParam("prixComposant", $input['prixComposant']);
    $sth->execute();
    return $this->response->withJson($input);
});

$app->delete('/composants/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("DELETE FROM `composants` WHERE idComposant=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    return $this->response->write('Supprimé');
});

$app->put('/composants/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE `composants` SET `nomComposant`= :nomComposant,
                                SET `idGamme`= :idGamme,
                                SET `idFournisseur`= :idFournisseur,
                                SET `prixComposant`= :prixComposant,
                                WHERE `idComposant`= :id";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("nomComposant", $input['nomComposant']);
    $sth->bindParam("idGamme", $input['idGamme']);
    $sth->bindParam("idFournisseur", $input['idFournisseur']);
    $sth->bindParam("prixComposant", $input['prixComposant']);
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    return $this->response->withJson($input);
});

// PARTIE DEVIS
$app->get('/devis', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM devis");
    $sth->execute();
    $devis = $sth->fetchAll();
    return $this->response->withJson($devis);
});

$app->get('/devis/[{id}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM devis WHERE idDevis=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $devis = $sth->fetchObject();
    return $this->response->withJson($devis);
});

$app->post('/devis', function ($request, $response) {
    $input = $request->getParsedBody();
    $sql = "INSERT INTO `devis`(`nomDevis`, `idClient`, `dateDevis`, `etatDevis`, `prixDevis`, `paiementDevis`) 
            VALUES (:nomDevis, :idClient, :dateDevis, :etatDevis, :prixDevis, :paiementDevis);";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("nomDevis", $input['nomDevis']);
    $sth->bindParam("idClient", $input['idClient']);
    $sth->bindParam("dateDevis", $input['dateDevis']);
    $sth->bindParam("etatDevis", $input['etatDevis']);
    $sth->bindParam("prixDevis", $input['prixDevis']);
    $sth->bindParam("paiementDevis", $input['paiementDevis']);
    $sth->execute();
    return $this->response->withJson($input);
});

$app->delete('/devis/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("DELETE FROM `devis` WHERE idDevis=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    return $this->response->write('Supprimé');
});

$app->put('/devis', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE `composants` SET `nomDevis`= :nomDevis,
                                SET `idClient`= :idClient,
                                SET `dateDevis`= :dateDevis,
                                SET `etatDevis`= :etatDevis,
                                SET `prixDevis`= :prixDevis,
                                SET `paiementDevis`= :paiementDevis,
                                WHERE `idDevis`=:id";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("nomDevis", $input['nomDevis']);
    $sth->bindParam("idClient", $input['idClient']);
    $sth->bindParam("dateDevis", $input['dateDevis']);
    $sth->bindParam("etatDevis", $input['etatDevis']);
    $sth->bindParam("prixDevis", $input['prixDevis']);
    $sth->bindParam("paiementDevis", $input['paiementDevis']);
    $sth->bindParam("id", $input['idDevis']);
    $sth->execute();
    return $this->response->write('modifié');
});

// PARTIE CLIENT
$app->get('/clients', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM clients");
    $sth->execute();
    $clients = $sth->fetchAll();
    return $this->response->withJson($clients);
});

$app->get('/clients/[{id}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM clients WHERE idClient=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $client = $sth->fetchObject();
    return $this->response->withJson($client);
});

$app->post('/clients', function ($request, $response) {
    $input = $request->getParsedBody();
    $sql = "INSERT INTO `clients`(`nomClient`, `prenomClient`, `adrRueClient`, `adrCpClient`, `adrVilleClient`, `telClient`, `emailClient`) 
            VALUES (:nomClient, :prenomClient, :adrRueClient, :adrCpClient, :adrVilleClient, :telClient, :emailClient);";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("nomClient", $input['nomClient']);
    $sth->bindParam("prenomClient", $input['prenomClient']);
    $sth->bindParam("adrRueClient", $input['adrRueClient']);
    $sth->bindParam("adrCpClient", $input['adrCpClient']);
    $sth->bindParam("adrVilleClient", $input['adrVilleClient']);
    $sth->bindParam("telClient", $input['telClient']);
    $sth->bindParam("emailClient", $input['emailClient']);
    $sth->execute();
    return $this->response->withJson($input);
});

$app->put('/clients', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE `clients` SET `nomClient`= :nomClient,
                             SET `prenomClient`= :prenomClient,
                             SET `adrRueClient`= :adrRueClient,
                             SET `adrCpClient`= :adrCpClient,
                             SET `adrVilleClient`= :adrVilleClient,
                             SET `telClient`= :telClient,
                             SET `emailClient`= :emailClient,
                             WHERE `idClient`=:id";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("nomClient", $input['nomClient']);
    $sth->bindParam("prenomClient", $input['prenomClient']);
    $sth->bindParam("adrRueClient", $input['adrRueClient']);
    $sth->bindParam("adrCpClient", $input['adrCpClient']);
    $sth->bindParam("adrVilleClient", $input['adrVilleClient']);
    $sth->bindParam("telClient", $input['telClient']);
    $sth->bindParam("emailClient", $input['emailClient']);
    $sth->bindParam("id", $input['idClient']);
    $sth->execute();
    return $this->response->write('modifié');
});

// PARTIE FOURNISSEUR
$app->get('/fournisseurs', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM fournisseurs");
    $sth->execute();
    $fournisseurs = $sth->fetchAll();
    return $this->response->withJson($fournisseurs);
});

$app->get('/fournisseurs/[{id}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM fournisseurs WHERE idFournisseurs=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $fournisseur = $sth->fetchObject();
    return $this->response->withJson($fournisseur);
});

$app->post('/fournisseurs', function ($request, $response) {
    $input = $request->getParsedBody();
    $sql = "INSERT INTO `fournisseurs`(`nomFournisseur`) 
    VALUES (:nomFournisseur);";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("nomFournisseur", $input['nomFournisseur']);
    $sth->execute();
    return $this->response->withJson($input);
});

// PARTIE GAMME
$app->get('/gammes', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM gammes");
    $sth->execute();
    $gammes = $sth->fetchAll();
    return $this->response->withJson($gammes);
});

$app->get('/gammes/[{id}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM gammes WHERE idGamme=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $fournisseur = $sth->fetchObject();
    return $this->response->withJson($fournisseur);
});
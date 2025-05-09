<!DOCTYPE html>
<html lang="fr">
<head>
    <title>WTC | API Documentation</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="{{asset('assets/documentation/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/icon.png')}}">
    <link href="{{asset('assets/documentation/css/custom.css')}}" rel="stylesheet"/>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <button class="btn btn-outline-primary toggle-menu me-2">
            ☰
        </button>
        <a class="navbar-brand ms-5" href="#"><img src="{{asset('assets/img/Logo.png')}}" width="40"> API Docs</a>
    </div>
</nav>

<!-- Overlay for mobile -->
<div class="overlay"></div>

<!-- Sidebar -->
<div class="sidebar mt-3">
    <h4 class="px-3">Docs API</h4>
    <nav class="nav flex-column px-3">
        <a class="nav-link" href="#intro">Introduction</a>
        <a class="nav-link" href="#webhooks">Webhooks</a>
        <a class="nav-link" href="#apikeys">API Keys</a>
        <a class="nav-link" href="#auth">Authentification</a>
        <a class="nav-link" href="#countries">Countries</a>
        <a class="nav-link" href="#cities">Cities</a>
        <a class="nav-link" href="#banks">Banks</a>
        <a class="nav-link nav-link-toggle">Senders ▾</a>
        <div class="submenu">
            <a class="nav-link" href="#get-senders">GET /api/senders</a>
            <a class="nav-link" href="#post-senders">POST /api/senders</a>
        </div>
        <a class="nav-link nav-link-toggle">Beneficiaries ▾</a>
        <div class="submenu">
            <a class="nav-link" href="#get-beneficiaries">GET /api/beneficiaries</a>
            <a class="nav-link" href="#post-beneficiaries">POST /api/beneficiaries</a>
        </div>
        <a class="nav-link nav-link-toggle">Transferts ▾</a>
        <div class="submenu">
            <a class="nav-link" href="#get-transfer">GET /api/transactions</a>
            <a class="nav-link" href="#post-transfer-bank">POST /api/transactions/bank</a>
            <a class="nav-link" href="#post-transfer-mobile">POST /api/transactions/bank</a>
            <a class="nav-link" href="#get-transfer-status">GET /api/transactions/status/:transaction_id</a>
        </div>
    </nav>
</div>

<!-- Main Content -->
<div class="content mt-5">
    <section id="intro">
        <h2><span class="h4 text-danger">I-1</span> Introduction</h2>
        <p>Bienvenue dans l’API d’envoi d’argent. Cette API permet aux développeurs d’intégrer facilement des fonctionnalités de transfert de fonds dans leurs applications web ou mobiles. Elle prend en charge l’envoi d’argent entre utilisateurs, les paiements vers des comptes bancaires ou des portefeuilles mobiles, et fournit un suivi en temps réel des transactions.

        </p><p> L’API est sécurisée, rapide et conçue pour répondre aux besoins des plateformes fintech, des services de paiement et des applications de commerce en ligne. Elle s’intègre facilement à votre infrastructure existante grâce à une architecture RESTful, une authentification basée sur les tokens, et une documentation claire.</p>
   <h4><span class="h4 text-danger">I-2</span> Restriction d’adresses IP dans l’API</h4>
        <p>Cette fonctionnalité permet de limiter l'accès à l’API uniquement à certaines adresses IP autorisées, renforçant ainsi la sécurité</p>
        <ul>
            <li>
                Les requêtes provenant d’une IP non autorisée reçoivent un code HTTP 403 Forbidden
            </li>
            <li>Les IP autorisées peuvent accéder normalement aux endpoints protégés</li>
        </ul>
        <h5><span class="h4 text-danger">I-3</span> Reponse de l erreur </h5>
    <pre>
{
  "data": {
    "ip": "127.0.0.1"
  },
  "message": "Access denied. Unauthorized IP address."
}
    </pre>
    </section>
    <section id="webhooks" class="mt-5">
        <h2><span class="h4 text-danger">II-1</span> Webhooks</h2>
        <p>
            L’API prend en charge l’envoi automatique de notifications par webhook à chaque mise à jour critique du statut d’une transaction.
            Cela permet aux systèmes partenaires d’être notifiés en temps réel, sans avoir à interroger en boucle l’API (polling).
        </p>
        <h4><span class="h4 text-danger">II-2</span> Quand un webhook est-il déclenché ?</h4>
        <p>Un webhook est déclenché à chaque changement de statut d’une transaction, notamment :</p>
        <pre>
pending → processing
processing → success
processing → failed
success → refunded (le cas échéant)
        </pre>
        <h4><span class="h4 text-danger">II-3</span> Format de la requête webhook</h4>
        <p>En-têtes :</p>
        <pre>
Content-Type: application/json
X-Signature: {HMAC-SHA256 du payload signé avec la clé secrète}

        </pre>
        <p>Payload JSON envoyé :</p>
        <pre>
{
  "transaction_id": "TXN-123456",
  "status": "success",
  "amount": 250.00,
  "currency": "USD",
  "timestamp": "2025-01-09T01:42:54+00:00"
}

        </pre>
        <h4><span class="h4 text-danger">II-4</span> Sécurité</h4>
        <p>Chaque webhook est signé avec un HMAC SHA256 dans le header X-Signature, généré à l’aide d’une clé secrète partagée. Le destinataire doit vérifier cette signature pour garantir l’intégrité de la notification.</p>
        <pre>$expectedSignature = hash_hmac('sha256', $payload, $secret);
</pre>
    </section>
    <section id="apikeys" class="mt-5">
        <h2><span class="h4 text-danger">III-1</span> Récupération de la clé API (private_key,secret_key) pour l’environnement Sandbox</h2>
        <p>Pour interagir avec notre API en mode test (sandbox), chaque développeur doit disposer d’une clé API dédiée, générée via son compte développeur.
            Cette clé permet d’effectuer des appels simulés sans déclencher de transactions réelles.</p>
      <h4>  🧭 Étapes pour obtenir la clé API Sandbox</h4>

        <h5>Créer un compte développeur</h5>
        <ul>
            <li>Accédez à https://xxxxxxxxxxxxxx.com/register</li>
            <li>Remplissez les informations demandées (email, nom, mot de passe)</li>
            <li> Confirmez votre email via le lien reçu</li>
        </ul>
        <h5>Recuperer ses identifiants</h5>
        <p> Dans le menu "Accounts , copier vos identifiants"</p>
        <img src="{{asset('assets/img/sandboxj.png')}}" class="img-rounded">
       <p>La clé vous sera affichée une seule fois : copiez-la et stockez-la en lieu sûr</p>
        <H4> Environnement sandbox</H4>
        <ul>
            <li>Tous les appels dans le sandbox sont simulés</li>
            <li>Aucun transfert d’argent réel n’est effectué</li>
            <li>Les statuts de transaction sont automatisés ou contrôlables via les endpoints de test</li>
        </ul>





    </section>
    <section id="auth" class="mt-5">
        <h2><span class="h4 text-danger">III-1</span> Authentification</h2>
        <p>L'API utilise un token JWT dans l'en-tête <code>Authorization</code>.</p>
        <pre>Authorization: Bearer &lt;votre_access_token&gt;</pre>
        <h2 class="mt-5"><span class="text-primary">GET</span> /api/login</h2>
        <h4 class="mt-3"><span class="h4 text-danger">III-2</span>🎯 Authentifie un utilisateur avec ses identifiants</h4>
        <p>Ce endpoint permet à un utilisateur de se connecter en envoyant son email et son mot de passe.
            En cas de succès, un token d’accès est renvoyé pour les appels API futurs..</p>
        <h4>Corps JSON attendu :</h4>
        <pre>{
"private_key":"wtc_private_sandbox25042557g2tpjdwdkt8swj596r7r987jro",
"secret_key":"wtc_secret_sandbox250425571rp0e31y0eqklo2q0uwkfw5plu"
}</pre>
        <button class="btn btn-outline-primary mb-2" data-bs-toggle="collapse" data-bs-target="#authenticate">
            Voir la Réponse
        </button>
        <div class="collapse" id="authenticate">
            <h6>Requête :</h6>
            <pre>POST /api/login</pre>
            <h6>Réponse :</h6>
            <pre>{
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJ3dGNfYXBpIiwic3ViIjoxLCJpYXQiOjE3NDYxODg2NTIsImV4cCI6MTc0NjE5MjI1Mn0.SIrzfmIwcuI4JDQkjzUoWBJ0-WMOaUQKwVVA5ydaVLLk8ZWF42F90ROSSpDf0w5uT7qQLuk6phpcu7XQSFRDz9_3Jpr-qM9ErW9tiuO7l3evpzjxSmlLt8E4s3HRAS9GrGmVIqkEGDQEyLtAFZqX-3AZQJCkl05lYBkD-YjbF0hX1HC84Enx6iF5E2Bzzjq9Em4xcs1638FJt5R5p9IKnsZr2Ww7MY4iTqdDjn99lfOZpo86uvgOnZvSrPpAoPSnDceJ3ZQkwRU4ohqSALkUW4PZsPS9k-0BqJE1BJiqGXj3XVnNnemHGCmUso72jBEX03AaD2CoZS13g-qXQGPk5w",
  "token_type": "bearer",
  "expires_in": 3600
}</pre>
        </div>
    </section>
    <section id="countries" class="mt-5">
        <h2><span class="text-primary">GET</span> /api/countries</h2>
        <p>permet de récupérer la liste des pays disponibles pour l’envoi ou la réception d’argent via la plateforme.</p>
        <p> Il est utile pour alimenter des menus déroulants ou valider les destinations autorisées dans votre application</p>

        <button class="btn btn-outline-primary mb-2" data-bs-toggle="collapse" data-bs-target="#countries_response">
            Voir exemple
        </button>
        <div class="collapse" id="countries_response">
            <h6>Requête :</h6>
            <pre>GET /api/countries</pre>
            <h6>Réponse :</h6>
            <pre>{
  "message": "senders get successful",
  "status": "success",
  "data": [
    {
      "name": "Cameroun",
      "code_iso": "CM",
      "currency": "XAF"
    },
    {
      "name": "Congo",
      "code_iso": "CG",
      "currency": "XAF"
    },
    {
      "name": "Congo RDC",
      "code_iso": "CD",
      "currency": "XAF"
    },
    {
      "name": "Senegal",
      "code_iso": "SN",
      "currency": "XOF"
    },
     ...           }</pre>
        </div>

    </section>
    <section id="cities" class="mt-5">
        <h2><span class="text-primary">GET</span> /api/cities?codeiso2={country_code}</h2>
        <p>permet d’obtenir la liste des villes disponibles pour un pays donné, identifié par son code ISO à deux lettres.
            </p>
        <p>Il est généralement utilisé pour filtrer les zones de destination lors de l’envoi d’argent.</p>
        <h4>Paramètres de requête :</h4>
        <ul>
            <li><strong>codeiso (obligatoire)</strong>  : Code ISO alpha-2 du pays (ex. : CM pour le Cameroun, CI pour la Côte d’Ivoire)</li>
        </ul>
        <button class="btn btn-outline-primary mb-2" data-bs-toggle="collapse" data-bs-target="#cities_response">
            Voir exemple
        </button>
        <div class="collapse" id="cities_response">
            <h6>Requête :</h6>
            <h4>Champs :</h4>
            <ul>
              <li>name : Nom de la ville (string)</li>
              <li> country : Pays auquel appartient la ville (string)</li>

            </ul>
            <pre>GET /api/cities?codeiso=CM</pre>
            <h6>Réponse :</h6>
            <pre>
                {
  "message": "cities get successful",
  "status": "success",
  "data": [
    {
      "name": "Douala",
      "country": "Cameroun"
    },
    {
      "name": "Yaoundé",
      "country": "Cameroun"
    },
    {
      "name": "Bamenda",
      "country": "Cameroun"
    },
    {
      "name": "Bafoussam",
      "country": "Cameroun"
    },
     ... }      </pre>
            <h4>Code de réponse HTTP :</h4>
            <ul>
              <li> 200 OK : Liste des villes retournée avec succès</li>

                <li> 400 Bad Request : Paramètre codeiso manquant ou invalide</li>

                <li>  404 Not Found : Aucun pays ou aucune ville trouvée pour ce code ISO</li>
            </ul>
        </div>
    </section>
    <section id="banks" class="mt-5">
        <h2><span class="text-primary">GET</span> /api/banks?codeiso={country_code}</h2>
        <p>Ce endpoint permet d’obtenir la liste des banques disponibles dans un pays donné, identifié par son code ISO. </p>
        <p>Il est essentiel pour que l’utilisateur sélectionne la banque du bénéficiaire lors d’un transfert d’argent vers un compte bancaire.</p>
        <ul>
            <li><strong>codeiso (obligatoire)</strong>– Code ISO alpha-2 du pays (ex. : CM pour le Cameroun, CI pour la Côte d’Ivoire)</li>
        </ul>
        <button class="btn btn-outline-primary mb-2" data-bs-toggle="collapse" data-bs-target="#banks_response">
            Voir exemple
        </button>
        <div class="collapse" id="banks_response">
            <h6>Requête :</h6>
            <pre>GET /api/banks?codeiso=CM</pre>
            <h6>Réponse :</h6>
            <pre>
                {
  "message": "cities get successful",
  "status": "success",
  "data": [
    {
     "name": "BICEC",
      "country": "Cameroun"
    },
    {
      "name": "Société Générale Cameroun",
      "country": "Cameroun"
    },
    {
     "name": "UBA Cameroun",
      "country": "Cameroun"
    },
     ... }      </pre>
         <h4>  Codes de réponse HTTP :</h4>
            <ul>
                <li> 200 OK : Liste des banques retournée avec succès</li>
                <li>400 Bad Request : Paramètre codeiso manquant ou invalide</li>
                <li>404 Not Found : Aucune banque trouvée pour ce pays</li>
            </ul>


        </div>
    </section>
    <section id="get-senders" class="mt-5">
        <h2><span class="text-primary">GET</span> /api/senders</h2>
        <p>Ce endpoint permet de récupérer la liste des expéditeurs enregistrés sur la plateforme.</p>
        <p> Il est utilisé pour afficher les informations des clients initiant des transferts d’argent, ou pour effectuer des opérations liées à la gestion de leurs transactions..</p>
        <ul>

        </ul>
        <button class="btn btn-outline-primary mb-2" data-bs-toggle="collapse" data-bs-target="#senders_response">
            Voir exemple
        </button>
        <div class="collapse" id="senders_response">
            <h6>Requête :</h6>
            <pre>GET /api/senders</pre>
            <h6>Réponse :</h6>
            <pre>{
  "message": "senders get successful",
  "status": "success",
  "data": [
    {
      "first_name": "kouamo",
      "last_name": "Dieudonne",
      "email": "info@agensic.com",
      "phone": "237675066919",
      "code": "25042521022068963666512",
      "occupation": "mecanicien",
      "civility": "Maried",
      "gender": "M",
      "document_type": "PP",
      "document_expired": "2025-05-10",
      "document_number": "5879454555"
    },
    {
      "first_name": "reine edith",
      "last_name": "jeanne d arc",
      "email": "contact@agensic.com",
      "phone": "687958",
      "code": "25042816714400768238381",
      "occupation": "mecanicien",
      "civility": "Single",
      "gender": "F",
      "document_type": "CNI",
      "document_expired": "2025-05-11",
      "document_number": "5879454555"
    },
    {
      "first_name": "John most",
      "last_name": "Yves",
      "email": "johm@gmail.com",
      "phone": "675066919",
      "code": "25050209346105716102273",
      "occupation": "Mecanicien",
      "civility": "Single",
      "gender": "M",
      "document_type": "PP",
      "document_expired": "2025-02-18",
      "document_number": "8957452144"
    },]}</pre>

            <h4>Codes HTTP possibles :</h4>
            <ul>
                <li>200 OK : Liste des expéditeurs retournée avec succès</li>
                <li>204 No Content : Aucun expéditeur ne correspond aux critères</li>
                <li>400 Bad Request : Paramètre invalide dans la requête</li>
                <li>401 Unauthorized : Jeton d’accès manquant ou invalide</li>
            </ul>
        </div>
    </section>
    <section id="post-senders" class="mt-5">
        <h2><span class="text-success">POST</span> /api/senders</h2>
        <p>Ce endpoint permet d’enregistrer un nouvel expéditeur sur la plateforme. </p>
        <p>Les informations fournies sont utilisées pour authentifier l'utilisateur, l'associer à des transactions, et garantir la conformité réglementaire (KYC).</p>
        <h6>Corps JSON attendu :</h6>
        <pre>{
  "first_name":"John most",
  "last_name":"Yves",
  "phone":"675066919",
  "email":"joh9@gmail.com",
  "city":"Douala",
  "address":"Bilongue",
  "date_birth":"2010-06-14",
  "num_document":"895741452",
  "type_document":"PP",
  "country_code":"CM",
  "gender":"M",
  "civility":"Single",
  "occupation":"Mecanicien",
  "expired_document":"2025-02-18"
}</pre>
        <button class="btn btn-outline-success mb-2" data-bs-toggle="collapse" data-bs-target="#sender_create_response">
            Voir réponse
        </button>
        <div class="collapse" id="sender_create_response">
            <h6>Réponse :</h6>
            <pre>{
  "message": "transaction created successful",
  "status": "success",
  "data": {
    "first_name": "John most",
    "last_name": "Yves",
    "email": "joh9@gmail.com",
    "phone": "675066919",
    "code": "25050226123240290514621",
    "occupation": "Mecanicien",
    "civility": "Single",
    "gender": "M",
    "document_type": "PP",
    "document_expired": "2025-02-18",
    "document_number": "895741452"
  }
}</pre>
            <h4>Codes de réponse possibles :</h4>
            <ul>
                <li>  201 Created : Expéditeur créé avec succès</li>
                <li>400 Bad Request : Données invalides ou manquantes</li>
                <li>409 Conflict : Expéditeur avec ce numéro/email déjà existant</li>
                <li>500 Internal Server Error : Erreur serveur lors de l’enregistrement</li>
            </ul>

        </div>
    </section>
    <section id="get-beneficiaries" class="mt-5">
        <h2><span class="text-primary">GET</span> /api/beneficiaries</h2>
        <p>Ce endpoint permet de récupérer la liste des bénéficiaires enregistrés pour un expéditeur spécifique.
            </p><p>Il est couramment utilisé pour préremplir les informations lors d’un envoi d’argent ou gérer les contacts favoris d’un utilisateur.</p>
        <ul>

        </ul>
        <button class="btn btn-outline-primary mb-2" data-bs-toggle="collapse" data-bs-target="#beneficiaries_response">
            Voir exemple
        </button>
        <div class="collapse" id="beneficiaries_response">
            <h6>Requête :</h6>
            <pre>GET /api/beneficiaries</pre>
            <h6>Réponse :</h6>
            <pre>{
  "message": "senders get successful",
  "status": "success",
  "data": [
    {
      "first_name": "emanuel kamao",
      "last_name": "fumba",
      "email": "contact@guens-education.com",
      "phone": "23796854415",
      "code": "25042553551393640666986",
      "occupation": "",
      "civility": "Maried",
      "gender": "M",
      "document_type": "PP",
      "document_expired": "2025-05-11",
      "document_number": "5879454555"
    },..
  ]
}</pre>
           <h4>Codes de réponse HTTP :</h4>
            <ul>
                <li> 200 OK : Liste retournée avec succès</li>
                <li>204 No Content : Aucun bénéficiaire trouvé</li>
                <li>400 Bad Request : Paramètre manquant ou invalide</li>
                <li>404 Not Found : Endpoint non trouvé</li>
            </ul>
        </div>
    </section>
    <section id="post-beneficiaries" class="mt-5">
        <h2><span class="text-success">POST</span> /api/beneficiaries</h2>
        <p>Ce endpoint permet d’enregistrer un nouveau bénéficiaire vers lequel un expéditeur pourra envoyer de l’argent.</p>
        <p> Le bénéficiaire peut être lié à un compte bancaire, un portefeuille mobile ou un point de retrait..</p>
        <h6>Corps JSON attendu :</h6>
        <pre>{
  "first_name":"John most",
  "last_name":"Yves",
  "phone":"675066919",
  "email":"joh9@gmail.com",
  "city":"Douala",
  "address":"Bilongue",
  "date_birth":"2010-06-14",
  "num_document":"895741452",
  "type_document":"PP",
  "country_code":"CM",
  "gender":"M",
  "civility":"Single",
  "occupation":"Mecanicien",
  "expired_document":"2025-02-18"
}</pre>
        <button class="btn btn-outline-success mb-2" data-bs-toggle="collapse" data-bs-target="#beneficiaries_create_response">
            Voir réponse
        </button>
        <div class="collapse" id="beneficiaries_create_response">
            <h6>Réponse :</h6>
            <pre>{
  "message": "beneficiary created successful",
  "status": "success",
  "data": {
    "first_name": "John most",
    "last_name": "Yves",
    "email": "joh9@gmail.com",
    "phone": "675066919",
    "code": "25050209787110801662101",
    "occupation": "Mecanicien",
    "civility": "Single",
    "gender": "M",
    "document_type": "PP",
    "document_expired": "2025-02-18",
    "document_number": "895741452"
  }
}</pre>
           <h4>Codes de réponse HTTP :</h4>
            <ul>
                <li>201 Created : Bénéficiaire créé avec succès</li>
                <li>400 Bad Request : Données manquantes ou format invalide</li>
                <li>404 Not Found : Expéditeur non trouvé</li>
                <li>409 Conflict : Bénéficiaire déjà existant pour ce numéro ou ce compte</li>
                <li> 500 Internal Server Error : Erreur serveur</li>
            </ul>

        </div>
    </section>
    <section id="get-transfer" class="mt-5">
        <h2><span class="text-primary">GET</span> /api/transactions</h2>
        <p>Ce endpoint permet de récupérer la liste des transactions effectuées par un expéditeur.</p>
        <p> Il prend en charge des filtres pour rechercher par statut, type, date ou bénéficiaire, facilitant ainsi le suivi des envois d’argent.</p>
       <h4>Paramètres de requête (query) :</h4>
        <pre>
        | Paramètre        | Type   | Description                                                                    |
        | ---------------- | ------ | ------------------------------------------------------------------------------ |
        | `sender_id`      | string | (obligatoire) Identifiant de l’expéditeur                                      |
        | `status`         | string | (optionnel) Filtrer par statut (`pending`, `completed`, `failed`, `cancelled`) |
        | `type`           | string | (optionnel) Type de transaction (`bank`, `mobile_money`, `cash_pickup`)        |
        | `start_date`     | string | (optionnel) Date de début au format `YYYY-MM-DD`                               |
        | `end_date`       | string | (optionnel) Date de fin au format `YYYY-MM-DD`                                 |
        | `beneficiary_id` | string | (optionnel) Filtrer les transactions envoyées à un bénéficiaire spécifique     |
        </pre>


        <button class="btn btn-outline-primary mb-2" data-bs-toggle="collapse" data-bs-target="#beneficiaries_response">
            Voir exemple
        </button>
        <div class="collapse" id="beneficiaries_response">
            <h6>Requête :</h6>
            <pre>GET /api/transactions</pre>
            <h6>Réponse :</h6>
            <pre>{
  "message": "senders get successful",
  "status": "success",
  "data": [
    {
      "first_name": "emanuel kamao",
      "last_name": "fumba",
      "email": "contact@guens-education.com",
      "phone": "23796854415",
      "code": "25042553551393640666986",
      "occupation": "",
      "civility": "Maried",
      "gender": "M",
      "document_type": "PP",
      "document_expired": "2025-05-11",
      "document_number": "5879454555"
    },..
  ]
}</pre>
        </div>
    </section>
    <section id="post-transfer-bank" class="mt-5">
        <h2><span class="text-success">POST</span> /api/transactions/bank</h2>
        <p>Ce endpoint permet de créer une transaction bancaire en transférant des fonds d’un expéditeur vers un bénéficiaire disposant d’un compte bancaire.
            </p><p>Il vérifie les informations du client, le solde, applique les frais, et génère une référence de transaction.</p>
        <h6>Corps JSON attendu :</h6>
        <pre>{"country_code":"FR",
"bank":"BANQUE POPULAIRE VAL DE FRANCE",
"sender_code":"25042521022068963666512",
"beneficiary_code":"25042553551393640666986",
"city":"Paris",
"amount":"80000",
"raison_transaction":"Business Profits to Parents",
"origin_fond":"Donation",
"iban":"xxxxxxxxxxxxxxxxxxxxxxx",
"relation":"Brother",
"accountNumber":"xxxxxxxxxxxxxxxxxxxxxxxx",
"swift_code":"xxxxxxxxxxxxxxxxxxxxxxxx",
"callback_url":"https://xxxx/webhook"
}</pre>
        <p class="text-danger text-ellipsis">Remplacer iban par :</p>
        <ul>
            <li><span class="text-primary">routing_number</span> pour US,CA</li>
            <li><span class="text-primary">ifsc_code</span> pour IN</li>
        </ul>
        <button class="btn btn-outline-success mb-2 mt-2" data-bs-toggle="collapse" data-bs-target="#beneficiaries_create_response">
            Voir réponse
        </button>
        <div class="collapse" id="beneficiaries_create_response">
            <h6>Réponse :</h6>
            <pre>{
  "message": "transaction created successful",
  "status": "success",
  "data": {
    "transaction_id": "25050816264901015287708",
    "fees": 3600,
    "amount": 1000
  }
}</pre>
        </div>
       <h4>Champs de réponse :</h4>
        <ul>
            <li>transaction_id : Identifiant unique de la transaction</li>
            <li>status : Statut initial (pending, processing, completed, failed)</li>
            <li>fees : Frais appliqués</li>
            <li>total_debited : Montant total débité à l’expéditeur (montant + frais)</li>
            <li>created_at : Date de création de la transaction</li>
            <li>message : Message de confirmation</li>
        </ul>
        <h4> Codes de réponse HTTP :</h4>
        <ul>
            <li>201 Created : Transaction créée avec succès</li>
            <li>400 Bad Request : Données manquantes ou invalides</li>
            <li>404 Not Found : Expéditeur ou bénéficiaire introuvable</li>
            <li>402 Payment Required : Solde insuffisant ou autorisation refusée</li>
            <li>500 Internal Server Error : Erreur serveur lors du traitement</li>
        </ul>


    </section>
    <section id="post-transfer-mobile" class="mt-5">
        <h2><span class="text-success">POST</span> /api/transactions/mobil</h2>
        <p>Ce endpoint permet de créer une transaction Mobile en transférant des fonds d’un expéditeur vers un bénéficiaire disposant d’un compte mobil money.
        </p><p>Il vérifie les informations du client, le solde, applique les frais, et génère une référence de transaction.</p>
        <h6>Corps JSON attendu :</h6>
        <pre>{"country_code":"CM",
"gateway":"OM",
"sender_code":"25042521022068963666512",
"beneficiary_code":"25042553551393640666986",
"city":"Paris",
"amount":"80000",
"raison_transaction":"Business Profits to Parents",
"origin_fond":"Donation",
"relation":"Brother",
"accountNumber":"237675066919",
"callback_url":"https://xxxx/webhook"
}</pre>
        <button class="btn btn-outline-success mb-2" data-bs-toggle="collapse" data-bs-target="#beneficiaries_create_response">
            Voir réponse
        </button>
        <div class="collapse" id="beneficiaries_create_response">
            <h6>Réponse :</h6>
            <pre>{
  "message": "transaction created successful",
  "status": "success",
  "data": {
    "transaction_id": "25050816264901015287708",
    "fees": 3600,
    "amount": 1000
  }
}</pre>
        </div>
        <h4>Champs de réponse :</h4>
        <ul>
            <li> transaction_id : Identifiant unique de la transaction</li>
            <li>status : Statut initial (pending, processing, completed, failed)</li>
            <li> fees : Frais appliqués</li>
            <li>total_debited : Montant total débité à l’expéditeur (montant + frais)</li>
            <li>created_at : Date de création de la transaction</li>
            <li> message : Message de confirmation</li>
        </ul>
        <h4> Codes de réponse HTTP :</h4>
        <ul>
            <li>201 Created : Transaction créée avec succès</li>
            <li>400 Bad Request : Données manquantes ou invalides</li>
            <li>404 Not Found : Expéditeur ou bénéficiaire introuvable</li>
            <li>402 Payment Required : Solde insuffisant ou autorisation refusée</li>
            <li>500 Internal Server Error : Erreur serveur lors du traitement</li>
        </ul>
    </section>
    <section id="get-transfer-status" class="mt-5">
        <h2><span class="text-primary">GET</span> /api/transactions/{transaction_id}</h2>
        <p>Ce endpoint permet de récupérer le statut actuel d’une transaction donnée à l’aide de son identifiant unique.</p>
        <p> Il est utile pour les utilisateurs finaux ou les agents afin de suivre l’évolution d’un envoi (bancaire, mobile ou en espèces).</p>

        <h4>Paramètres de requête (query) :</h4>
        <pre>*transaction_id (obligatoire) : L’identifiant unique de la transaction à suivre.
        </pre>


        <button class="btn btn-outline-primary mb-2" data-bs-toggle="collapse" data-bs-target="#beneficiaries_response">
            Voir exemple
        </button>
        <div class="collapse" id="beneficiaries_response">
            <h6>Requête :</h6>
            <pre>GET /api/transactions/status/25050816264901015287708</pre>
            <h6>Réponse :</h6>
            <pre>{
  "message": "transaction successful",
  "status": "success",
  "data": {
    "transaction_id": "25050816264901015287708",
    "status": "success",
    "relation": "Brother",
    "origin_fond": "Donation",
    "motif_send": "Business Profits to Parents",
    "amount_send": 1000,
    "country": "FRANCE",
    "currency": "EUR",
    "amount_debit": 83600,
    "bank": "BANQUE POPULAIRE VAL DE FRANCE",
    "accountNumber": "011623852957",
    "sender": {
      "first_name": "kouamo",
      "last_name": "Dieudonne",
      "email": "info@agensic.com",
      "phone": "237675066919",
      "code": "25042521022068963666512",
      "occupation": "mecanicien",
      "civility": "Maried",
      "gender": "M",
      "document_type": "PP",
      "document_expired": "2025-05-10",
      "document_number": "5879454555"
    },
    "beneficiary": {
      "first_name": "emanuel kamao",
      "last_name": "fumba",
      "email": "contact@guens-education.com",
      "phone": "23796854415",
      "code": "25042553551393640666986",
      "occupation": "",
      "civility": "Maried",
      "gender": "M",
      "document_type": "PP",
      "document_expired": "2025-05-11",
      "document_number": "5879454555"
    }
  }
}</pre>
          <h4> Codes de réponse HTTP :</h4>
            <ul>
                <li>200 OK : Statut retourné avec succès</li>
                <li>404 Not Found : Aucune transaction trouvée avec cet identifiant</li>
                <li>400 Bad Request : Identifiant mal formé ou invalide</li>
                <li>500 Internal Server Error : Erreur inattendue du serveur</li>
            </ul>
        </div>
    </section>
</div>
<script src="{{asset('assets/documentation/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/documentation/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/documentation/js/custom.js')}}"></script>
</body>
</html>

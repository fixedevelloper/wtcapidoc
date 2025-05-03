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
        </div>
    </nav>
</div>

<!-- Main Content -->
<div class="content mt-5">
    <section id="intro">
        <h2>Introduction</h2>
        <p>Bienvenue dans la documentation de notre API REST. Vous trouverez ici les détails de chaque endpoint
            disponible.</p>
    </section>

    <section id="auth" class="mt-5">
        <h2>Authentification</h2>
        <p>L'API utilise un token JWT dans l'en-tête <code>Authorization</code>.</p>
        <pre>Authorization: Bearer &lt;votre_access_token&gt;</pre>
        <button class="btn btn-outline-primary mb-2" data-bs-toggle="collapse" data-bs-target="#authenticate">
            Voir exemple
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
        <p>Récupère la liste des pays.</p>

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
        <p>Récupère la liste des villes par pays.</p>
        <ul>
            <li><strong>code</strong> (obligatoire) – code ISO2 du pays</li>
        </ul>
        <button class="btn btn-outline-primary mb-2" data-bs-toggle="collapse" data-bs-target="#cities_response">
            Voir exemple
        </button>
        <div class="collapse" id="cities_response">
            <h6>Requête :</h6>
            <pre>GET /api/cities?codeiso2=Cm</pre>
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
        </div>
    </section>
    <section id="banks" class="mt-5">
        <h2><span class="text-primary">GET</span> /api/banks?codeiso2={country_code}</h2>
        <p>Récupère la liste des banks et operateurs mobile par pays.</p>
        <ul>
            <li><strong>code</strong> (obligatoire) – code ISO2 du pays</li>
        </ul>
        <button class="btn btn-outline-primary mb-2" data-bs-toggle="collapse" data-bs-target="#banks_response">
            Voir exemple
        </button>
        <div class="collapse" id="banks_response">
            <h6>Requête :</h6>
            <pre>GET /api/cities?codeiso2=Cm</pre>
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
        </div>
    </section>
    <section id="get-senders" class="mt-5">
        <h2><span class="text-primary">GET</span> /api/senders</h2>
        <p>Récupère la liste des expediteurs.</p>
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
        </div>
    </section>
    <section id="post-senders" class="mt-5">
        <h2><span class="text-success">POST</span> /api/senders</h2>
        <p>Crée un nouvel expediteur.</p>
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
        </div>
    </section>
    <section id="get-beneficiaries" class="mt-5">
        <h2><span class="text-primary">GET</span> /api/beneficiaries</h2>
        <p>Récupère la liste des beneficiares.</p>
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
        </div>
    </section>
    <section id="post-beneficiaries" class="mt-5">
        <h2><span class="text-success">POST</span> /api/beneficiaries</h2>
        <p>Crée un nouvel beneficiare.</p>
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
        </div>
    </section>
    <section id="get-transfer" class="mt-5">
        <h2><span class="text-primary">GET</span> /api/transactions</h2>
        <p>Récupère la liste des transactions.</p>
        <ul>

        </ul>
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
        <p>Crée un nouvel beneficiare.</p>
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
        </div>
    </section>
    <section id="post-transfer-mobile" class="mt-5">
        <h2><span class="text-success">POST</span> /api/transactions/mobil</h2>
        <p>Crée une nouvelle transaction.</p>
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
        </div>
    </section>
</div>
<script src="{{asset('assets/documentation/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/documentation/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/documentation/js/custom.js')}}"></script>
</body>
</html>

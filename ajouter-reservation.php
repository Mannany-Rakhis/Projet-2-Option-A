<?php
require_once 'config.php';

$message = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $service = $_POST['service'];
    $disponibilite = $_POST['disponibilite'];

    try {

        $sql = "INSERT INTO reservations
        (
            date_rdv,
            heure_rdv,
            nom_client,
            email_client,
            telephone,
            statut,
            Id_disponibilites,
            Id_services
        )

        VALUES
        (
            :date_rdv,
            :heure_rdv,
            :nom_client,
            :email_client,
            :telephone,
            :statut,
            :Id_disponibilites,
            :Id_services
        )";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([

            ':date_rdv' => $date,
            ':heure_rdv' => $heure,
            ':nom_client' => $nom,
            ':email_client' => $email,
            ':telephone' => $telephone,
            ':statut' => 'En attente',
            ':Id_disponibilites' => $disponibilite,
            ':Id_services' => $service

        ]);

        $message = "Réservation enregistrée avec succès";

    } catch (PDOException $e) {

        $message = "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>Réservation</title>

</head>

<body>

<h1>Nouvelle réservation</h1>

<?php if (!empty($message)) : ?>

    <p><?= $message ?></p>

<?php endif; ?>

<form method="POST" id="reservationForm">

    <input
        type="text"
        name="nom"
        placeholder="Nom"
        required
    >

    <br><br>

    <input
        type="email"
        name="email"
        placeholder="Email"
        required
    >

    <br><br>

    <input
        type="text"
        name="telephone"
        placeholder="Téléphone"
        required
    >

    <br><br>

    <input
        type="date"
        name="date"
        required
    >

    <br><br>

    <input
        type="time"
        name="heure"
        required
    >

    <br><br>

    <!-- SERVICES -->

    <label>Service :</label>

    <select name="service" required>

        <option value="">
            Choisir un service
        </option>

        <?php

        $services = $pdo->query(
            "SELECT * FROM services"
        );

        while ($row = $services->fetch(PDO::FETCH_ASSOC)) :

        ?>

            <option value="<?= $row['Id_services'] ?>">

                <?= $row['nom'] ?>

            </option>

        <?php endwhile; ?>

    </select>

    <br><br>

    <!-- DISPONIBILITÉS -->

    <label>Disponibilité :</label>

    <select name="disponibilite" required>

        <option value="">
            Choisir une disponibilité
        </option>

        <?php

        $dispos = $pdo->query(
            "SELECT * FROM disponibilites
             WHERE actif = 1"
        );

        while ($row = $dispos->fetch(PDO::FETCH_ASSOC)) :

        ?>

            <option value="<?= $row['Id_disponibilites'] ?>">

                <?= $row['jour_semaine'] ?>
                -
                <?= $row['heure_debut'] ?>
                /
                <?= $row['heure_fin'] ?>

            </option>

        <?php endwhile; ?>

    </select>

    <br><br>

    <button type="submit">

        Réserver

    </button>

</form>

</body>
</html>
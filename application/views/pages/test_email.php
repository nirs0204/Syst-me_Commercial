<!-- Votre vue (par exemple, upload_file_view.php) -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de fichier</title>
</head>
<body>
    <h2>Formulaire d'envoi de fichier</h2>

    <?php echo form_open_multipart('CT_Email/upload_fichier'); ?>

    <label for="fichier">Sélectionnez un fichier :</label>
    <input type="file" name="fichier" id="fichier" />

    <input type="submit" value="Envoyer" />

    <?php echo form_close(); ?>
</body>
</html>

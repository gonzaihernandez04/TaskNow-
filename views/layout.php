<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bienvenido a TaskNow! Comienza a registrar tus proyectos y los pasos para completarlo. Crea tu perfil y registra lo que sea necesario. Hacelo simple">
    <title>TaskNow | <?php echo $titulo ?? ''?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Open+Sans&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>

    <?php echo $contenido; ?>
    <?php echo $script ?? ''; ?>

</body>
</html>
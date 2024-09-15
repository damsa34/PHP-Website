<!DOCTYPE html>
<html>
    <head>
        <title>Database Error</title>
    </head>
    <body>
        <?php if ($error): ?>
            <p>
                <strong>
                    <?php echo htmlspecialchars($error); ?>
                </strong>
            </p>
        <?php endif;?>
    </body>
</html>
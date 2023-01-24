<?php

require __DIR__ . '/../vendor/autoload.php';

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

if ($_REQUEST['content'] && !$_REQUEST['edit']) {
    $renderer = new ImageRenderer(new RendererStyle(400), new SvgImageBackEnd());
    $writer = new Writer($renderer);
    $qrCode = $writer->writeString($_REQUEST['content']);
    header("Content-Disposition: attachment; filename=\"{$_REQUEST['name']}.svg\"");
    header('Content-Type: image/svg+xml');
    echo $qrCode;
    exit;
}

?><!DOCTYPE html lang="en">
<html>
<head>
    <title>Quick QR Code</title>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
        <div>
            <label>Filename</label>
            <input type="text" name="name" value="<?= $_REQUEST['name'] ?: 'quick-qr' ?>" />
        </div>
        <div>
            <label>Content</label>
            <textarea name="content" cols="80" rows="5"><?= $_REQUEST['content'] ?></textarea>
        </div>
        <div>
            <button type="submit">Create QR Code</button>
        </div>
    </form>
</body>
</html>

<?php
function copyDir($src, $dst) {
    if (!is_dir($dst)) mkdir($dst, 0755, true);
    $dir = opendir($src);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                copyDir($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

echo "Upgrading Aether core...\n";
copyDir('c:/Users/kisal/Desktop/Projects/aether/src', 'c:/Users/kisal/Desktop/Projects/aether-site/aether/src');
copyDir('c:/Users/kisal/Desktop/Projects/aether/bin', 'c:/Users/kisal/Desktop/Projects/aether-site/aether/bin');
echo "Done.\n";

#!/usr/bin/env php
<?php
/**
 * a converter from md to html
 *
 * Usage $0 <file.md>
 */
require_once __DIR__ . '/vendor/autoload.php';


global $argv;
$file = $argv[1];
$outputDir = $argv[2];
$basename = basename($file, '.md');

$Parsedown = new Parsedown();
$mdContent = file_get_contents($file);
$html = $Parsedown->text($mdContent);

$html = preg_replace('/\.md/', '.html', $html);

$config['title'] = "Project Foobar Document";
$config['basename'] = basename($file, '.md');

$partialDir = __DIR__ . '/partial';

ob_start();

require_once $partialDir . '/_header.html';
echo $html;
require_once $partialDir . '/_footer.html';

$output = ob_get_contents();

$htmlFile = $basename . '.html';

file_put_contents($outputDir . '/' . $htmlFile, $output);

ob_end_clean();

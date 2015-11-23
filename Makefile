all : vendor html
	for md in *.md; do ./md2html.php $$md html; done
	mv html/README.html html/index.html

html:
	mkdir html

vendor: composer.json
	composer install

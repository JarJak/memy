memy.tk - Skarbnica Memów
=======
[![Build Status](https://travis-ci.org/JarJak/memy.svg?branch=master)](https://travis-ci.org/JarJak/memy)
[![Build Status](https://scrutinizer-ci.com/g/JarJak/memy/badges/build.png?b=master)](https://scrutinizer-ci.com/g/JarJak/memy/build-status/master)

http://memy.tk/

https://www.facebook.com/groups/508740382611596/

1.0 FEATURES:
------------
1. Prosta oprawa graficzna oparta o Twitter Bootstrap
	- przykładowy styl: http://startbootstrap.com/template-overviews/4-col-portfolio/
	- górne menu:
		- przeglądaj (główna)
		- dodaj
		- losuj i taguj
2. Fomularz uploadu plików 
  - select
  - multiselect
  - drag and drop
  - możliwość wrzucenia calego folderu z memami
3. Po wgraniu pliku/plików możliwość dodania tagów
  - http://timschlechter.github.io/bootstrap-tagsinput/examples/
4. Lista wgranych memów:
  - w kolejności wrzucenia
  - po danym tagu
5. Lista/chmura tagów
	- sortuj listę: alfabetycznie, po największej ilości tagów
6. Użytkownicy z FOSUserBundle z sensownymi rolami/uprawnieniami
7. Prosty panel admina oparty na CRUDzie
  - przykladowy styl: http://startbootstrap.com/template-overviews/sb-admin/
8. Losuj mema
9. Taguj - wybiera mema z najmniejszą ilością tagów i pozwala go edytować
10. Przy każdym dodanym obrazku/tagu/powiązaniu należy w bazie zapisać IP i datę (do wglądu w panelu admina)
11. Wyszukiwarka:
	- wpisuje się tagi z autocomplete, w locie sprawdza ilość dostępnych memów pod danym tagiem/tagami (wszystkie memy muszą należeć do wszystkich wybranych tagów)
        - http://timschlechter.github.io/bootstrap-tagsinput/examples/
  

1.1 FEATURES:
------------
1. Przy dodawaniu obrazków - sprawdzanie czy taki obrazek już istnieje
  - na podstawie tagów
  - na podstawie podobieństw: http://www.phash.org/
    - jesli wgrywany obrazek jest w wiekszej rozdzielczości/jakości to go podmień
2. Widok pojedynczego mema:
  - możliwość pobrania go jako plik (jak 'pobierz' na fb)
  - [do rozważenia] komentarze z FB
  - zgłoś mema do moderacji (tylko dla zarejestrowanych userów)
3. Widok listy:
  - możliwość pobrania wszystkich memów pod danym tagiem (z sensownym limitem)
4. Logowanie przez FB OAuth - na stronę i do panelu
  - opcja widoku moje memy
  - dodawanie memów do ulubionych

1.2 FEATURES:
--------------
1. Elasticsearch
  - http://stackoverflow.com/questions/16107605/how-to-do-facets-on-symfony2-foselasticabundle
  - http://stackoverflow.com/questions/7256405/faceted-search-solr-vs-good-old-filtering-via-php
  - https://github.com/FriendsOfSymfony/FOSElasticaBundle

TEST SUITE
--------------

### Structure of functional / integration test suite: ###

1) Application test suite - global suite, should be used only for multi-bundle integration feature tests
  - **location of .feature files:** ./features
  - **context class:** ./features/bootstrap/ApplicationContext.php

2) Bundles test suites - per-bundle suites, should be used only for bundle-related feature tests
  - **location of .feature files:** ./src/Memy/MemeBundle/Features/ *< example*
  - **context class:** ./features/bootstrap/Memy/MemeBundle/Features/Context/FeatureContext.php *< example*

### Usage and new feature creation: ###
Web access is provided via MinkContext base class, which should be used as FeatureContext parent class by extension.
MinkContext provides a set of helper steps like "I am on "/some-url-path"" or "I should see "some text"" (first provides navigation context, second provides full-page grep search).
Full MinkContext step reference is available here: https://github.com/Behat/MinkExtension/blob/master/src/Behat/MinkExtension/Context/MinkContext.php

To create a new bundle suite / feature in bundle suite (feature that is provided by bundle, not integrated with other bundles - those go to application suite as integration tests), do this:

**New bundle:**
1) open ./behat.yml file
2) in suites array add a new suite for your bundle with type: symfony_bundle and bundle: MemyYourBundleName
3) run in console:

    bin/behat "@MemyYourBundleName" --init

this will create a feature context class (remember to add "extends MinkContext" for web-based tests!) in ./features and Features directory in your bundle

**Existing bundle:**
4) go to:

    cd src/Memy/YourBundleName/Features

4) add a some-feature.feature file in Features directory
5) describe feature using Gherkin syntax in feature file
6) run

    bin/behat --append-snippets

this will add methods to feature context class, if you are using steps from MinkContext, remove them from your feature context class

**Executing tests**

Run:

    bin/robo build

or - on next runs:

    bin/robo behat

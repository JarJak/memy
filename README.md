memy.tk - Skarbnica Memów
=======

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

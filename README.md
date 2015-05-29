# Code Reposity - Demonstration
---
Beispiel Code für die Artikel-Liste in einem eBay Shop-Template.
> Es geht in erster Linie um den Source-Code und nicht das Layout. Die Grafiken sind aus einem original Projekt entnommen und verwendet worden. Der optische Stil wurde "so" erarbeitet und verwendet. Ziel war es, HTML fremden Mitarbeitern ein Tool zu geben, mit dem ein Standard HTML Layout produziert werden kann. Da das Listing für verschiedene Artikelgruppen auch unterschiedliche Ansichten enthält, wird über das Template jeweils eine andere datenbox.css übernommen, welche das gleiche Setup bietet aber eine andere Darstellung hat.

**Verwendet wurde:**
* phpStorm 8
* prepros.io (compiler)
* LESS

**LESS**
* Basis import.less wird durch den Compiler bei Änderungen neu kompuliert und ausgegeben
* In der import.less werden lediglich die Import-LESS-Dateien zusammengezogen
* Ändert sich eine der Import-Dateien, wird import.less wieder ausgegeben 

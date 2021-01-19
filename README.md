# Student-Delegate-Vote
************************************************  
  *  Nom : kichou.                               *
  *  Prenom : mohammed imed eddine.              *
  *                                              *
  ************************************************
  
  YOU CAN SEE THE FINAL PROJECT OUTPUT IN finalOutput directory

configuration du BD:
===================================
    host : localhost
    user : root
    password : 
    Nom du BD : infol2
===================================

!!!!! importer le ficher infol2.sql (projet/configs/infol2.sql) au phpmyadmin dans une base nommée "infol2".

le ficher infol2.sql contient tous les tableaux qui sert a la fonctionmment du WEB APP.
et contient aussi 4 etudiant pour section1 et 3 etudiant pour section 2
avec 7 candidat
et deux resultat .
===================================

projet propriétés: 

- page index (aucceil) => navBar contient aucceil(retour au aucceil),
                          contact (redirect vers site du USTOMB),
                          un form (sert a voir la resultat du vote) =>{
                             * tu doit enter votre numero du carte d'etudiant pour voir la resultat.
                             * si votre numero du carte n'est pas enregister dans la base du donnes,tu peux pas voir la resultat.
                             * si vous cliquez le button (results) est le champ du carte est vide un erreur sera generé (CHAMP VIDE!!).
                             * si vous cliquez le button (results) est le champ du carte est non valide un erreur sera generé (NON VALIDE!!).
                          },
                          un button (commencez) vas tu prendre à page du enregistrement du vos information.

- page register => une drop liste pour choisir votre section (section 1 ou 2),
                   champ pour numero du carte etudiant(e),
                   champ pour le nom d'etudiant(e),
                   champ pour le prenom d'etudiant(e),
                   un checkBox si tu voudrais de devien un candidat {
                       * !! le nombre max du candidat dans chaque section est 5 
                       * si le nombre des candidats a depasser 5 un message sera generer vos informe que tu peux pas devien un candidat.
                   }

                   (différente cas sure cette page)=>{
                       * si vous etes deja enregister sur BD mais pas encore voter tu sera redirect vers 
                         page de vote selon votre section (1/2),
                         mais si tu etais deja voté tu sera redirect vers page resultat.
                       * si vos information sont non valide ou champs sont vides erreur sera généer et tu doit verifiez vos information.
                       * si tous les champs sont valide et tu pas encore enregister tu redirect vers page de vote selon votre section(1/2).
                    }

- page section1 /section2 => une page pour votez choisir votre candidat et cliquer voter
                             !! tu doit choisir un candidat .

- page result => contitent les resultats du l'élection 
                 {
                     * partie pour section 1
                     * partie pour section 2
                     * les resultats contient les perssones qui ont beaucoup de voix par rapport d'autres candidats.
                 }


//////////////////////////////////////////////////////////////////////////////////////

remarque !!! tu peux pas accéder les pages section1,section2 et result par url directement.

le site web n'est pas completment responsive donc il est favorable de l'utiliser
sur des appareil qui ont largeur de > 950px

/******************************************************************************************************\
conception du BDD:
il exsite troi tableux Student,Candidat et vote
student => contient toute les etudiant du promo (id,numero du carte,section,nom,prenom)
candidat => contient toute les candidats du promo (id,student-id)
vote=>contient 4 columns (candidat-id,section,electer-student-id,vote-number(toujour = 1))

le result est recuperer par calculer le candidat qui a max du vote-number (dans le deux section)

# Portail Web de l'Institut National des Sciences de Gestion (INSG Gabon)

Intégration complète des contenus, identités visuelles, filières, actualités et médias officiels de l'**Institut National des Sciences de Gestion (INSG - Libreville, Gabon)** sur l'architecture et le design de référence d'un grand portail universitaire moderne.

Ce template front-end (HTML, CSS, Vanilla JS) est optimisé pour une intégration fluide avec le backend Laravel (`insg-site`).

---

## 📁 Structure du Projet

```text
insg-gabon2/
├── index.html                  # Page d'accueil officielle de l'INSG Gabon
├── about.html                  # Présentation de l'INSG, mot du Directeur et vision
├── nos-formations.html         # Offre globale des 8 filières Licence & Master
├── candidature-et-inscription.html # Concours Licence 1 et sélection Master
├── actualites.html             # Actualités et communiqués officiels
├── entreprises.html            # Espace Partenaires, stages et forum de l'emploi
├── plan-du-site.html           # Arborescence complète et sitemap
├── .htaccess                   # Réécriture d'URLs pour Apache / Laragon
├── README.md                   # Documentation du projet
└── assets/
    ├── css/
    │   ├── styles.css          # Styles structurels officiels
    │   └── custom.css          # Thème, méga-menus, carrousel héros et composants
    ├── js/
    │   └── main.js             # Interactions (menus déroulants, carrousel, tiroir mobile)
    ├── fonts/                  # Typographie Gotham et icônes vectorielles Icomoon
    └── images/                 # Visuels officiels de l'INSG (logo, campus, direction, partenaires)
        ├── insg-logo.jpeg      # Logo officiel de l'INSG
        ├── building.png        # Bâtiment principal de l'INSG
        ├── directeur-1.png     # Direction Générale de l'institut
        ├── rentree.png         # Bannière rentrée et inscriptions
        ├── partenariat.png     # Signature partenariat BGFI Bank
        ├── forum.png           # Forum de l'emploi et des stages
        ├── library.png         # Bibliothèque universitaire connectée
        ├── organigramme-insg.jpeg # Organigramme de gouvernance
        └── partners/           # Logos partenaires (BGFI, CNSS, UGB, Total, Airtel)
```

---

## 🏛️ Identité Institutionnelle de l'INSG

- **Nom officiel :** Institut National des Sciences de Gestion
- **Sigle :** INSG Gabon
- **Siège :** Boulevard Triomphal, Libreville, Gabon
- **Téléphone :** +241 01 23 45 67
- **Email :** `contact@insg-gabon.ga`
- **Couleurs institutionnelles :** Bleu Marine Profond (`#0b2240` / `#1f234b`) & Bordeaux / Carmin (`#a41034` / `#b31b2c`)
- **Chiffres clés :**
  - **3 200+** Étudiants formés chaque année
  - **8** Filières professionnelles d'excellence
  - **140+** Enseignants-chercheurs et experts professionnels
  - **92%** Taux d'insertion professionnelle

---

## 🎓 Les 8 Filières d'Excellence de l'INSG

1. **Finance** (Finance d'entreprise, marchés financiers, ingénierie financière)
2. **Comptabilité** (Comptabilité, contrôle, gestion financière)
3. **Marketing** (Marketing stratégique, communication, action commerciale)
4. **Gestion des Ressources Humaines** (Management du capital humain, droit social)
5. **Management des Organisations** (Stratégie d'entreprise, pilotage organisationnel)
6. **Banque & Institutions Financières** (Techniques bancaires, microfinance, conformité)
7. **Audit & Contrôle de Gestion** (Audit opérationnel, gouvernance, contrôle interne)
8. **Informatique de Gestion** (Systèmes d'information, transformation numérique)

   - Flèches de navigation précédent/suivant (`‹` et `›`) et puces indicatrices (`dots`).
   - Onglets thématiques inférieurs.

4. **Recherche de Formation & Profils :**
   - Moteur de recherche de formation avec filtres par niveau et discipline.
   - Cartes d'accès rapide par typologie d'usager.

5. **Agenda & Actualités :**
   - Cartes agenda avec médaillons de dates (mois / jour), titre, lieu et étiquette d'événement.
   - Section actualités avec article vedette et vignettes secondaires.

6. **Campus & Chiffres Clés :**
   - Mosaïque d'images de la vie universitaire.
   - Indicateurs institutionnels et liens vers les réseaux sociaux.

7. **Pied de page (Footer) :**
   - Coordonnées officielles, campus et contacts.
   - Plan du site complet par thématique.
   - Logos des labels de qualité et d'excellence (*HRS4R, DD&RS, Bienvenue en France*).
   - Liens légaux : mentions légales, accessibilité, politique de confidentialité, copyright.
   - Bouton flottant de retour en haut de page avec défilement fluide.

---

## 📄 Pages Internes Reproduites (200+ Pages)

L'ensemble des pages rattachées aux menus, sous-menus et pied de page du site officiel a été reproduit au format HTML/CSS/JS :

- **L'Université :** `l-universite-jean-moulin.html`, `histoire.html`, `gouvernance.html`, `organisation.html`, `grands-projets.html`, `fondation.html`, `chiffres-cles.html`, `nos-campus.html`, `carrieres-et-emploi.html`, `actualites.html`, etc.
- **Formation :** `nos-formations.html`, `formation.html`, `candidature-et-inscription.html`, `alternance-1.html`, `formation-continue-1.html`, `validation-des-acquis-de-l-experience-vae-1.html`, `calendriers-universitaires.html`, etc.
- **Recherche :** `recherche.html`, `la-recherche-a-luniversite-jean-moulin-1.html`, `unites-de-recherche.html`, `politique-de-recherche.html`, `science-ouverte-3.html`, `integrite-scientifique-1.html`, etc.
- **International :** `international.html`, `venir-a-lyon-3.html`, `partir-a-l-etranger.html`, etc.
- **Campus & Vie Étudiante :** `campus.html`, `vie-etudiante.html`, `bibliotheques-universitaires-3.html`, `culture.html`, `sport.html`, `sante-social.html`, etc.
- **Facultés, UFR & Instituts :** `faculte-de-droit.html`, `faculte-de-philosophie.html`, `faculte-des-humanites-lettres-et-societes-1.html`, `faculte-des-langues.html`, `iaelyon-school-of-management.html`, `iut-jean-moulin.html`, etc.
- **Profils :** `lyceen.html`, `etudiant.html`, `nouvel-etudiant.html`, `diplome.html`, `vacataire-enseignant.html`, `journaliste.html`, etc.
- **Informations & Pied de page :** `mentions-legales.html`, `plan-du-site.html`, `contact.html`, `accessibilite.html`, `donnees-personnelles.html`, `credits.html`, `gestion-des-cookies.html`, etc.
- **Plan du site complet :** Consultez [`plan-du-site.html`](file:///c:/laragon/www/insg-gabon2/plan-du-site.html) pour voir l'arborescence intégrale de toutes les pages disponibles.

---

## 🚀 Visualisation Locale

- **Via Laragon (Recommandé) :**
  Ouvrez votre navigateur sur :
  ```text
  http://insg-gabon2.test/
  ```
  ou
  ```text
  http://localhost/insg-gabon2/
  ```
  *Un fichier `.htaccess` est configuré pour gérer automatiquement les URLs propres sans extension `.html`.*

- **Ouverture directe :**
  Double-cliquez directement sur `index.html` pour l'ouvrir dans n'importe quel navigateur (tous les assets et liens sont en chemins relatifs locaux).

---

## 🔌 Recommandations pour l'Intégration Backend

Les blocs dynamiques sont repérés par des commentaires HTML explicites :
- `<!-- SECTION 1: HEADER ... -->` : dynamiser les liens de navigation, le profil utilisateur connecté/déconnecté.
- `<!-- SECTION 2: HERO BANNER & CAROUSEL ... -->` : boucler sur les diapositives `carousellyon3__item__wrapper` issues de la base de données (titre, image de fond, lien, description).
- `<!-- SECTION 3: RECHERCHE FORMATION ... -->` : brancher le formulaire de recherche sur votre contrôleur de filtre/recherche de formations.
- `<!-- SECTION 4: AGENDA & ÉVÉNEMENTS ... -->` : boucler sur les prochains événements avec date, titre et catégorie.
- `<!-- SECTION 5: ACTUALITÉS LYON 3 ... -->` : boucler sur les derniers articles publiés.
- `<!-- SECTION 7: FOOTER ... -->` : dynamiser les coordonnées et liens institutionnels.

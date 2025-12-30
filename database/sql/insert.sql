-- =========================
-- PRODUITS (15)
-- =========================
INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at)
VALUES (1, 'Riz', 'Cereale cultivee en Afrique', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at)
VALUES (2, 'Arachide', 'Plante oleagineuse tres utilisee', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at)
VALUES (3, 'Mais', 'Cereale polyvalente', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at)
VALUES (4, 'Mil', 'Cereale resistante a la secheresse', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at)
VALUES (5, 'Sorgho', 'Cereale riche en fibres', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at)
VALUES (6, 'Ble', 'Cereale utilisee pour le pain', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at)
VALUES (7, 'Tomate', 'Legume fruit tres cultive', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at)
VALUES (8, 'Oignon', 'Condiment essentiel en cuisine', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at)
VALUES (9, 'Pomme de terre', 'Tubercule riche en amidon', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at)
VALUES (10, 'Banane', 'Fruit tropical tres apprecie', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at)
VALUES (11, 'Mangue', 'Fruit tropical sucre', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at)
VALUES (12, 'Pasteque', 'Fruit rafraichissant', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at)
VALUES (13, 'Carotte', 'Legume racine riche en vitamine A', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at)
VALUES (14, 'Chou', 'Legume feuille utilise en cuisine', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at)
VALUES (15, 'Poivron', 'Legume fruit colore', SYSDATE, SYSDATE);

-- =========================
-- VARIETES DU MAIS (id produit = 3) — 6
-- =========================
INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (1, 'Mais jaune', 'Grains riches en amidon', 3, SYSDATE, SYSDATE);
INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (2, 'Mais blanc', 'Grains doux et digestes', 3, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (3, 'Mais sucre', 'Grains sucres', 3, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (4, 'Mais dur', 'Grains resistants', 3, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (5, 'Mais dente', 'Grains denteles', 3, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (6, 'Mais popcorn', 'Explose a la chaleur', 3, SYSDATE, SYSDATE);

-- =========================
-- VARIETES DU MIL (id produit = 4) — 4
-- =========================
INSERT INTO varietees VALUES (7, 'Mil local', 'Resistant a la secheresse', 4, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (8, 'Mil perle', 'Grains ronds', 4, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (9, 'Mil rouge', 'Grains colores', 4, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (10, 'Mil hybride', 'Haute productivite', 4, SYSDATE, SYSDATE);

-- =========================
-- VARIETES DU BLE (id produit = 6) — 5
-- =========================
INSERT INTO varietees VALUES (11, 'Ble tendre', 'Utilise pour le pain', 6, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (12, 'Ble dur', 'Utilise pour les pates', 6, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (13, 'Ble integral', 'Riche en fibres', 6, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (14, 'Ble hiver', 'Seme en automne', 6, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (15, 'Ble printemps', 'Seme au printemps', 6, SYSDATE, SYSDATE);

-- =========================
-- VARIETES DE LA TOMATE (id produit = 7) — 4
-- =========================
INSERT INTO varietees VALUES (16, 'Tomate cerise', 'Petits fruits rouges', 7, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (17, 'Tomate Roma', 'Chair ferme', 7, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (18, 'Tomate coeur de boeuf', 'Grosse taille', 7, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (19, 'Tomate jaune', 'Gout doux', 7, SYSDATE, SYSDATE);

-- =========================
-- VARIETES DE LA POMME DE TERRE (id produit = 9) — 4
-- =========================
INSERT INTO varietees VALUES (20, 'Pomme locale', 'Tubercule ferme', 9, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (21, 'Pomme douce', 'Chair tendre', 9, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (22, 'Pomme rouge', 'Peau coloree', 9, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (23, 'Pomme jaune', 'Chair fondante', 9, SYSDATE, SYSDATE);

-- =========================
-- VARIETES DE LA BANANE (id produit = 10) — 4
-- =========================
INSERT INTO varietees VALUES (24, 'Banane plantain', 'Utilisee pour la cuisson', 10, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (25, 'Banane dessert', 'Fruit sucre', 10, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (26, 'Banane rouge', 'Chair rose', 10, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (27, 'Banane verte', 'Texture ferme', 10, SYSDATE, SYSDATE);

-- =========================
-- VARIETES DE LA MANGUE (id produit = 11) — 4
-- =========================
INSERT INTO varietees VALUES (28, 'Mangue Kent', 'Chair sucree', 11, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (29, 'Mangue Keitt', 'Gros fruits', 11, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (30, 'Mangue Amelie', 'Saveur douce', 11, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (31, 'Mangue Palmer', 'Bonne conservation', 11, SYSDATE, SYSDATE);

-- =========================
-- VARIETES DE LA PASTEQUE (id produit = 12) — 3
-- =========================
INSERT INTO varietees VALUES (32, 'Pasteque rouge', 'Chair sucree', 12, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (33, 'Pasteque jaune', 'Chair douce', 12, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (34, 'Pasteque sans pepins', 'Facile a consommer', 12, SYSDATE, SYSDATE);

-- =========================
-- VARIETES DE LA CAROTTE (id produit = 13) — 5
-- =========================
INSERT INTO varietees VALUES (35, 'Carotte orange', 'Classique', 13, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (36, 'Carotte jaune', 'Gout doux', 13, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (37, 'Carotte violette', 'Couleur intense', 13, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (38, 'Carotte blanche', 'Texture croquante', 13, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (39, 'Carotte longue', 'Forme allongee', 13, SYSDATE, SYSDATE);

-- =========================
-- VARIETES DU CHOU (id produit = 14) — 6
-- =========================
INSERT INTO varietees VALUES (40, 'Chou vert', 'Feuilles croquantes', 14, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (41, 'Chou rouge', 'Couleur vive', 14, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (42, 'Chou frise', 'Texture frisee', 14, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (43, 'Chou chinois', 'Feuilles allongees', 14, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (44, 'Chou fleur', 'Inflorescence blanche', 14, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (45, 'Chou de Bruxelles', 'Petites pommes', 14, SYSDATE, SYSDATE);

-- =========================
-- VARIETES DU POIVRON (id produit = 15) — 7
-- =========================
INSERT INTO varietees VALUES (46, 'Poivron vert', 'Saveur douce', 15, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (47, 'Poivron rouge', 'Saveur sucree', 15, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (48, 'Poivron jaune', 'Saveur douce', 15, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (49, 'Poivron orange', 'Couleur vive', 15, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (50, 'Poivron doux', 'Peu piquant', 15, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (51, 'Poivron piquant', 'Gout releve', 15, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (52, 'Poivron long', 'Forme allongee', 15, SYSDATE, SYSDATE);

-- =========================
-- VARIETES DU RIZ (id produit = 1) — 5
-- =========================
INSERT INTO varietees VALUES (53, 'Riz local', 'Production locale', 1, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (54, 'Riz parfume', 'Arome agreable', 1, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (55, 'Riz basmati', 'Grains longs', 1, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (56, 'Riz complet', 'Riche en fibres', 1, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (57, 'Riz gluant', 'Texture collante', 1, SYSDATE, SYSDATE);

-- =========================
-- VARIETES DE L ARACHIDE (id produit = 2) — 4
-- =========================
INSERT INTO varietees VALUES (58, 'Arachide locale', 'Graines locales', 2, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (59, 'Arachide rouge', 'Couleur rouge', 2, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (60, 'Arachide blanche', 'Couleur claire', 2, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (61, 'Arachide huile', 'Riche en huile', 2, SYSDATE, SYSDATE);

-- =========================
-- VARIETES DU SORGHO (id produit = 5) — 5
-- =========================
INSERT INTO varietees VALUES (62, 'Sorgho rouge', 'Couleur rouge', 5, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (63, 'Sorgho blanc', 'Couleur claire', 5, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (64, 'Sorgho doux', 'Saveur douce', 5, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (65, 'Sorgho fourrager', 'Utilise en fourrage', 5, SYSDATE, SYSDATE);
INSERT INTO varietees VALUES (66, 'Sorgho hybride', 'Bonne productivite', 5, SYSDATE, SYSDATE);

COMMIT;

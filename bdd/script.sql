
create table categorie (
  idCategorie int primary key not null auto_increment,
  libele varchar(50)
);

create table plat (
  idPlat int primary key not null auto_increment,
  code varchar(10),
  prix int,
  intitule varchar(50),
  idCategorie int not null,
  image varchar(100),
  description varchar(1000)
  constraint FK_Categorie_Plat foreign key (idCategorie) references categorie(idCategorie)
);

create table menu (
  idMenu int primary key not null auto_increment,
  dateMenu date,
  constraint UC_Menu unique (dateMenu)
);

create table menuDetails (
  idMenu int not null,
  idPlat int not null,
  constraint FK_Menu_MenuDetails foreign key (idMenu) references menu(idMenu),
  constraint FK_Plat_MenuDetails foreign key (idPlat) references plat(idPlat),
  constraint UC_MenuDetails unique(idMenu,idPlat)
);

create table etudiant(
	idEtudiant int primary key not null auto_increment,
	numETU varchar(6),
	pwd varchar(40),
	nom varchar(20),
	dateNaissance date
);

create table favoris(
idEtudiant int,
idPlat int);

create unique index uc_numETU on etudiant(numETU);


create table commande(
	idCommande int primary key not null auto_increment,
	idEtudiant int,
  dateCommande date,
	foreign key (idEtudiant) references etudiant(idEtudiant)
);

create table commandePlat(
	idCommande int,
	idPlat int,
	quantite int,
	foreign key (idCommande) references commande(idCommande),
	foreign key (idPlat) references plat(idPlat)
);
create unique index uc_commandePlat on commandePlat(idCommande, idPlat);


create table token(
  idToken int primary key not null auto_increment,
  idEtudiant int,
  token varchar(40),
  foreign key (idEtudiant) references etudiant(idEtudiant)
);


insert into categorie (libele) values
  ('Entrée'),
  ('Plat de resistance'),
  ('Dessert');

insert into plat (code,prix,intitule,idCategorie,image,description) values
  ('001',3000,'Croquettes de polenta au fromage',1,'1.jpg',"pouleteka matsiro miteramenaka voafafifay formagy mitsonika tsara"),
  ('002',3500,'Feuilletés au thon',1,'2.jpg',"Thon goavana misy sauce milay mendy tsara tsy atahorana be menaka tena matsiro io ry namana a"),
  ('003',5000,'Poisson farçi',2,'3.jpg',"O ry namana a aza varina mijery description tsony fa tsy hahita matsiro noho io ianao...kozy e"),
  ('004',7000,'Cote pané',2,'4.jpg',"Cote pane otran le mahazatra e...tsy misy tantaraina betsaka fa tode staek pelapelaka ngeza be"),
  ('005',2000,'Glace au chocolat',3,'5.jpg',"raha tena nona de ity no mahavoky fa ataon ny serveur mitafotafo be otran tendrombohatra io a"),
  ('006',2500,'Salade de fruits',3,'6.jpg',"salade de fruits tena misy fruits fa tsy fruits imaginaire miam miam"),
  ('007',3000,'Gâteau à la vanille',3,'7.jpg',"Gateau be otran le amin mariage reny anao rery...mamy tsara ");

insert into menu (dateMenu) values
  ('2020-12-25'),
  ('2020-12-26');

insert into menuDetails (idMenu,idPlat) values
  (1,1),
  (1,2),
  (1,3),
  (1,5),
  (1,6),
  (2,1),
  (2,3),
  (2,4),
  (2,5),
  (2,7);


  insert into etudiant(numETU, pwd, nom, dateNaissance) values
  				('ETU001', sha1('123465'), 'Rakoto', '1999-10-10'),
  				('ETU002', sha1('123456'), 'Rabe', '2000-1-13');

  insert into commande(idEtudiant,dateCommande) values
  				(1,'2020-12-25'),
          (2,'2020-12-26'),
          (1,'2020-12-26');

  insert into commandePlat(idCommande, idPlat, quantite) values
  				(1, 6, 2),
          (1, 5, 1),
          (2, 2, 3),
          (2, 7, 2),
          (2, 5, 4),
          (3, 7, 2);

create table menuJournalier as (
  select plat.*, menu.*
  from menu
  join menuDetails on menu.idMenu = menuDetails.idMenu
  join plat on menuDetails.idPlat = plat.idPlat
);


create table platAPreparer as (
  select commandePlat.idPlat, sum(commandePlat.quantite) as quantite, commande.dateCommande
  from commandePlat join commande on commande.idCommande = commandePlat.idCommande
  group by commandePlat.idPlat, commande.dateCommande
);

ALTER TABLE plat ADD description varchar(1000);
UPDATE plat SET image = 3 , description="Poisson farci mendy tsara sady betsaka " WHERE idPlat=3 ;

insert into etudiant() values
          ('ETU001', sha1('123465'), 'Rakoto', '1999-10-10'),
          ('ETU002', sha1('123456'), 'Rabe', '2000-1-13');

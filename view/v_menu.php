<div class="list-group panel" id = "div1">
    <a href="index.php" class="navbar navbar-expand-lg navbar-light bg-ligh collapsed" id="menu" data-parent="#sidebar" > <i class="fa fa-home"></i>
        <span class="hidden-sm-down"> Home </span></a>

    <a href="#menu1" class="navbar navbar-expand-lg navbar-light bg-ligh collapsed" id="menu" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
        <i class="fas fa-chess-king"></i> <span class="hidden-sm-down"> Joueur</span> </a>
    <div class="collapse" id="menu1">
        <a  href="index.php?uc=joueur&action=listejoueur" class="navbar navbar-expand-lg navbar-light bg-ligh" id="sub" data-parent="#menu1sub2" ><i class="fa fa-list"></i> <span class="hidden-sm-down">Liste Joueurs</span></a>
    <a href="index.php?uc=joueur&action=addJoueur" class="navbar navbar-expand-lg navbar-light bg-ligh" id="sub" data-parent="#menu1" ><i class="fas fa-plus-square"></i> <span class="hidden-sm-down">Ajouter Joueur</span></a>
</div>

<a href="#menu2" class="navbar navbar-expand-lg navbar-light bg-ligh collapsed" id="menu" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
    <i class="fas fa-briefcase" ></i> <span class="hidden-sm-down"> Categorie</span> </a>
<div class="collapse" id="menu2">
    <a href="index.php?uc=categorie&action=listeCategories" class="navbar navbar-expand-lg navbar-light bg-ligh" id="sub" data-parent="#menu2" >
        <i class="fa fa-list"></i><span class="hidden-sm-down">Liste Categories</span></a>
    <a href="index.php?uc=categorie&action=addCategorie" class="navbar navbar-expand-lg navbar-light bg-ligh" id="sub" data-parent="#menu2" > <i class="fas fa-plus-square"></i> <span class="hidden-sm-down">Ajouter Categorie</span></a>

</div>
<a href="#menu3" class="navbar navbar-expand-lg navbar-light bg-ligh collapsed" id="menu" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
    <i class="fas fa-chess-board"></i> <span class="hidden-sm-down">Competition</span></a>
<div class="collapse" id="menu3">
    <a href="index.php?uc=competition&action=listeCompetition" class="navbar navbar-expand-lg navbar-light bg-ligh" id="sub" data-parent="#menu3" ><i class="fa fa-list"></i><span class="hidden-sm-down">Liste Competitions</span></a>
    <a href="index.php?uc=competition&action=addCompetition" class="navbar navbar-expand-lg navbar-light bg-ligh" id="sub" data-parent="#menu3" ><i class="fas fa-plus-square"></i> <span class="hidden-sm-down">Ajouter Competition</span></a>
    <a href="index.php?uc=participants&action=listeParticipants" class="navbar navbar-expand-lg navbar-light bg-ligh" id="sub" data-parent="#menu3"  ><i class="fa fa-list"></i> <span class="hidden-sm-down">Participants Aux Competitions</span></a>
    <a href="index.php?uc=participants&action=addParticipant" class="navbar navbar-expand-lg navbar-light bg-ligh" id="sub" data-parent="#menu3"  ><i class="fas fa-user-plus"></i><span class="hidden-sm-down">Inscrire Aux Competitions</span></a>
</div>
<a href="#menu4" class="navbar navbar-expand-lg navbar-light bg-ligh collapsed" id="menu" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
    <i class="fas fa-users"></i> <span class="hidden-sm-down"> Groupe</span></a>
<div class="collapse" id="menu4">
    <a href="index.php?uc=groupe&action=listeGroupes" class="navbar navbar-expand-lg navbar-light bg-ligh"  id="sub" data-parent="#menu4" ><i class="fa fa-list"></i><span class="hidden-sm-down">Liste Groupe</span></a>
    <a href="index.php?uc=groupe&action=addGroupe" class="navbar navbar-expand-lg navbar-light bg-ligh" id="sub" data-parent="#menu4" ><i class="fas fa-plus-square"></i> <span class="hidden-sm-down">Ajouter Groupe</span></a>
    <a href="index.php?uc=joueurGroupe&action=addJoueurGroupe" class="navbar navbar-expand-lg navbar-light bg-ligh" id="sub" data-parent="#menu4" ><i class="fas fa-user-plus"></i><span class="hidden-sm-down">Inscrire Aux Groupes</span></a>
</div>
</div>




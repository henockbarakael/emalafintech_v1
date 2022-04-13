<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="">
                    <a href="{{ route('caissier.dashboard') }}"><i class="la la-dashboard"></i> <span> Tableau de bord</span></a>
                </li>
                <li class="menu-title"> <span>Transfert d'argent</span> </li>
                <li>
                    <a href="{{ route('emala.sending.form') }}"><i class="fa fa-exchange"></i> <span>Envoi d'argent</span></a>
                </li>
                <li>
                    <a href="{{ route('emala.withdrawal.form') }}"><i class="fa fa-exchange"></i> <span>Retrait d'argent</span></a>
                </li>
                <li class="menu-title"> <span>Rechargement compte</span> </li>
                <li class="">
                    <a href="{{ route('caissier.emala.all') }}" ><i class="fa fa-calculator"></i><span> Balance Solde </span></a>
                </li>
                <li class="submenu">
                    <a href="#" ><i class="fa fa-refresh"></i><span>Rechargement</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        {{-- <li><a href="{{ route('caissier.demande.appro') }}">Demande</a></li> --}}
                        {{-- <li><a href="{{ route('caissier.demande.appro.all') }}">En attente</a></li><li><a href="{{ route('caissier.demande.appro') }}">Demande</a></li>
                        <li><a href="{{ route('caissier.demande.appro.all') }}">En attente</a></li> --}}
                    </ul>
                </li>
                <li class="menu-title"> <span>Rapport de transactions</span> </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-pie-chart"></i> <span>Emala</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('caissier.emala.all') }}">Toutes</a></li>
                        <li><a href="">Envoi</a></li>
                        <li><a href="">Retrait</a></li>
                        <li><a href="">Paiement</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-line-chart"></i> <span>Mobile money</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('caissier.emala.all') }}">Toutes</a></li>
                        <li><a href="">Envoi</a></li>
                        <li><a href="">Retrait</a></li>
                        <li><a href="">Paiement</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-area-chart"></i> <span>Moneygram</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('caissier.emala.all') }}">Toutes</a></li>
                        <li><a href="">Envoi</a></li>
                        <li><a href="">Retrait</a></li>
                        <li><a href="">Paiement</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-bar-chart-o"></i> <span>PayTV</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('caissier.emala.all') }}">Toutes</a></li>
                        <li><a href="">Envoi</a></li>
                        <li><a href="">Retrait</a></li>
                        <li><a href="">Paiement</a></li>
                    </ul>
                </li>
                <li class="menu-title"> <span>Messagerie</span> </li>
                <li class="submenu">
                    <a href="#" ><i class="fa fa-envelope-o"></i><span> Nouveau message </span> </a>
                    <a href="#" ><i class="fa fa-inbox"></i><span> Boîte de réception </span> </a>
                    <a href="#" ><i class="fa fa-send-o"></i><span> Messages envoyés </span> </a>
                    <a href="#" ><i class="fa fa-file-o"></i><span> Brouillons </span> </a>
                </li>
                <li class="menu-title">
                    <span>Configuration</span></li>
                    <li class="">
                        <a href="{{ route('profile_caissier') }}" ><i class="fa fa-envelope-o"></i><span> Mon compte </span> </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="{{ route('gerant.emala.all') }}">
                    <a href="{{ route('gerant.dashboard') }}"><i class="la la-dashboard"></i> <span> Dashboard Gérant</span></a>
                </li>
                <li class="menu-title"> <span>Sandbox</span> </li>
                <li class="submenu">
                    <a href="#"><i class="ti-wallet"></i> <span>Maisha API</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('maishapay.credit') }}">Credit</a></li>
                        <li><a href="{{ route('maishapay.debit') }}">Debit</a></li>
                    </ul>
                </li>
                <li class="menu-title"> <span>Transfert</span> </li>
                <li class="submenu">
                    <a href="#"><i class="ti-wallet"></i> <span>Emala</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('gerant.emala.all') }}">Toutes</a></li>
                        <li><a href="">Emala - Emala</a></li>
                        <li><a href="">Emala - Mobile Money</a></li>
                        <li><a href="">Emala - Moneygram</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="ti-wallet"></i> <span>Mobile Money</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('gerant.mobilemoney.all') }}">Toutes</a></li>
                        <li><a href="">Envoi</a></li>
                        <li><a href="">Retrait</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="ti-wallet"></i> <span>MoneyGram</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('gerant.moneygram.all') }}">Toutes</a></li>
                        <li><a href="">Envoi</a></li>
                        <li><a href="">Retrait</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="ti-wallet"></i> <span>PayTV</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('gerant.paytv.all') }}">Toutes</a></li>
                    </ul>
                </li>
                <li class="menu-title"> <span>Approvisionnement</span> </li>
                <li class="">
                    <a href="{{ route('management.caissier.solde') }}" ><i class="fa fa-list"></i><span>Solde de caisse</span>
                    </a>
                </li>
                <li class="">
                    <a href="#" ><i class="fa fa-list"></i><span>Liste de demande</span>
                    </a>
                </li>
                <li class="menu-title"> <span>Gestion de comptes</span> </li>
                <li class="">
                    <a href="{{route('compte.caisse')}}" ><i class="fa fa-user"></i><span> Ajouter un compte</span></a>
                </li>
                {{-- <li class="">
                    <a href="{{route('management.caisse.form')}}" ><i class="fa fa-shopping-bag"></i><span> Création caisse</span></a>
                </li> --}}
                <li class="">
                    <a href="{{route('management.caissier.liste')}}" ><i class="fa fa-list"></i><span>Liste de comptes</span>
                    </a>
                </li>
                {{-- <li class="">
                    <a href="{{route('management.caisse.liste')}}" ><i class="fa fa-list"></i><span>Liste de caisse</span>

                    </a>
                </li> --}}
                <li class="menu-title"> <span>Messagerie</span> </li>
                <li class="submenu">
                    <a href="#" ><i class="fa fa-envelope"></i><span> Ecrire </span> </a>
                    <a href="#" ><i class="fa fa-envelope"></i><span> Inbox </span> </a>
                    <a href="#" ><i class="fa fa-envelope"></i><span> Message envoyé </span> </a>
                    <a href="#" ><i class="fa fa-envelope"></i><span> Brouillons </span> </a>
                </li>
            </ul>
        </div>
    </div>
</div>

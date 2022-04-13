<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="">
                    <a href="{{route('home')}}">
                        <i class="la la-dashboard"></i>
                        <span> Dashboard</span>
                    </a>
                </li>

                <li class="menu-title"> <span>HISTORIQUE</span> </li>


                <li class="submenu">
                    <a href="#" class="ml-2"><i class="ti-wallet"></i><span> Transactions </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li><a href="{{ route('admin.emala.all') }}">Emala</a></li>
                        <li><a href="{{ route('admin.mobilemoney.all') }}">Mobile Money</a></li>
                        <li><a href="{{ route('admin.moneygram.all') }}">Moneygram</a></li>
                        <li><a href="{{ route('admin.paytv.all') }}">Pay TV</a></li>
                        {{-- <li><a href="{{ route('admin.emprunt.all') }}">Emprunt</a></li> --}}
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#" class="ml-2">
                        <i class="la la-user"></i> <span>Solde</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li><a href="{{ route('solde/wallet') }}" style="margin-left: 5px">Wallet</a></li>
                        <li><a href="{{ route('solde/agences') }}" style="margin-left: 5px">Agences</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="{{ route('activity/log') }}" class="ml-2"><i class="la la-list"></i> <span> Journal d'activité</span></a>
                </li>
                <li class="">
                    <a href="{{ route('activity/login/logout') }}" class="ml-2"><i class="la la-list"></i> <span> Activité utilisateur</span></a>
                </li>


                <li class="menu-title"> <span>UTILISATEUR</span> </li>
                <li class="">
                    <a href="{{ route('admin.list') }}" class="ml-2"><i class="la la-user-plus"></i> <span> Administrateur</span></a>
                </li>
                <li class="">
                    <a href="{{ route('gerant.list') }}" class="ml-2"><i class="la la-user-plus"></i> <span> Chef d'agence</span></a>
                </li>
                <li class="">
                    <a href="{{ route('userManagement') }}" class="ml-2"><i class="la la-user-plus"></i> <span> Utilisateur</span> </span></a>
                </li>

                <li class="menu-title"> <span>CONFIGURATION</span> </li>
                <li class="submenu">
                    <a href="#" class="ml-2">
                        <i class="la la-user"></i> <span> Rôles</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li><a href="{{ route('all/roles') }}" style="margin-left: 5px">Liste rôle</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#" class="ml-2">
                        <i class="la la-bank"></i> <span> Agences</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li><a href="{{ route('all/agences') }}" style="margin-left: 5px">Liste agence</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#" class="ml-2">
                        <i class="la la-user"></i> <span> Commissions</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li><a href="{{ route('all/commissions') }}" style="margin-left: 5px">Liste commission</a></li>
                    </ul>
                </li>
                <li class="menu-title"> <span>MESSAGERIE</span> </li>
                <li class="submenu">
                    <a href="#" class="ml-2"><i class="fa fa-envelope-o"></i><span> Ecrire </span> </a>
                    <a href="#" class="ml-2"><i class="fa fa-inbox"></i><span> Inbox </span> </a>
                    <a href="#" class="ml-2"><i class="fa fa-send-o"></i><span> Message envoyé </span> </a>
                    <a href="#" class="ml-2"><i class="fa fa-file-o"></i><span> Brouillons </span> </a>
                </li>
                {{-- <li class="submenu">
                    <a href="#" class="ml-2">
                        <i class="la la-user"></i> <span> Approvisionnement</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li><a href="{{ route('all/approvisionnement') }}" style="margin-left: 5px">Liste agence</a></li>
                    </ul>
                </li> --}}

            </ul>
        </div>
    </div>
</div>

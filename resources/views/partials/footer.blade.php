<footer class="scrollable-section pied_deco" data-section-title="Pied de page">
    <div id="retour_haut_page">
        <a href="#body" title="Haut de page"></a>
    </div>
    <div id="pied_page" role="contentinfo">
        <div class="footer_ligne footer_ligne1">
            <div class="footer_ligne1__col1">
                <div class="reseaux-sociaux">
                    <h2>Suivez-nous</h2>
                    <ul class="reseaux-sociaux__liste">
                        <li class="reseaux-sociaux__item">
                            <a href="https://www.facebook.com" target="_blank" rel="noopener" class="reseaux-sociaux__type-rubrique_0004" title="Facebook">
                                <img src="{{ asset('assets/images/facebook22x32_1512477766977-png.png') }}" alt="picto-Facebook" />
                            </a>
                        </li>
                        <li class="reseaux-sociaux__item">
                            <a href="https://www.instagram.com" target="_blank" rel="noopener" class="reseaux-sociaux__type-rubrique_0004" title="Instagram">
                                <img src="{{ asset('assets/images/instagram_1511884156826-png.png') }}" alt="picto-Instagram" />
                            </a>
                        </li>
                        <li class="reseaux-sociaux__item">
                            <a href="https://www.linkedin.com" target="_blank" rel="noopener" class="reseaux-sociaux__type-rubrique_0004" title="LinkedIn">
                                <img src="{{ asset('assets/images/linkedin_1511883384553-png.png') }}" alt="picto-LinkedIn" />
                            </a>
                        </li>
                        <li class="reseaux-sociaux__item">
                            <a href="https://www.youtube.com" target="_blank" rel="noopener" class="reseaux-sociaux__type-rubrique_0004" title="Youtube">
                                <img src="{{ asset('assets/images/youtube_1511883439147-png.png') }}" alt="picto-Youtube" />
                            </a>
                        </li>
                        <li class="reseaux-sociaux__item">
                            <a href="{{ route('contact') }}" class="reseaux-sociaux__type-rubrique_0001" title="Nous contacter">
                                <img src="{{ asset('assets/images/plus-de-reseaux_1581068539286-png.png') }}" alt="picto-Tous les réseaux sociaux" />
                            </a>
                        </li>
                    </ul>
                </div>

                <ul id="menu_pied_page">
                    <li><a href="{{ route('campus') }}">Campus Principal (Libreville)</a></li>
                    <li><a href="{{ route('formations.index', ['level' => 'Master']) }}">Pôle Masters &amp; Recherche</a></li>
                    <li><a href="{{ route('entreprises') }}">Incubateur des Métiers &amp; Entrepreneuriat</a></li>
                </ul>
            </div>

            <div class="footer_ligne1__col2">
                <div class="plan-site-footer">
                    <ul class="plan-site_col">
                        <li class="plan-site_lvl1">
                            <span>Institut</span>
                            <ul>
                                <li class="plan-site_lvl2"><a href="{{ route('about') }}">L'Institut National des Sciences de Gestion</a></li>
                                <li class="plan-site_lvl2"><a href="{{ route('about') }}#mot-directeur">Mot de la Direction Générale</a></li>
                                <li class="plan-site_lvl2"><a href="{{ route('about') }}#organigramme">Organisation &amp; Gouvernance</a></li>
                                <li class="plan-site_lvl2"><a href="{{ route('campus') }}">Nos campus &amp; infrastructures</a></li>
                                <li class="plan-site_lvl2"><a href="{{ route('actualites.index') }}">Actualités de l'Institut</a></li>
                            </ul>
                        </li>
                        <li class="plan-site_lvl1">
                            <span>Formations</span>
                            <ul>
                                <li class="plan-site_lvl2"><a href="{{ route('formations.index') }}">Catalogue des Formations</a></li>
                                <li class="plan-site_lvl2"><a href="{{ route('formations.index', ['level' => 'Licence']) }}">Licences Professionnelles</a></li>
                                <li class="plan-site_lvl2"><a href="{{ route('formations.index', ['level' => 'Master']) }}">Masters Spécialisés</a></li>
                                <li class="plan-site_lvl2"><a href="{{ route('formations.index', ['level' => 'BTS']) }}">Brevet de Technicien Supérieur</a></li>
                                <li class="plan-site_lvl2"><a href="{{ route('admissions') }}">Concours d'entrée &amp; Inscriptions</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="plan-site_col">
                        <li class="plan-site_lvl1">
                            <span>Entreprises</span>
                            <ul>
                                <li class="plan-site_lvl2"><a href="{{ route('entreprises') }}">Partenariats Écoles-Entreprises</a></li>
                                <li class="plan-site_lvl2"><a href="{{ route('entreprises') }}#stages">Offres de Stages &amp; Emplois</a></li>
                                <li class="plan-site_lvl2"><a href="{{ route('entreprises') }}#incubateur">Incubateur BGFI-INSG</a></li>
                                <li class="plan-site_lvl2"><a href="{{ route('contact') }}">Proposer un projet</a></li>
                            </ul>
                        </li>
                        <li class="plan-site_lvl1">
                            <span>Vie Étudiante</span>
                            <ul>
                                <li class="plan-site_lvl2"><a href="{{ route('vie-associative') }}">Associations &amp; BDE</a></li>
                                <li class="plan-site_lvl2"><a href="{{ route('vie-associative') }}#clubs">Clubs Sportifs &amp; Culturels</a></li>
                                <li class="plan-site_lvl2"><a href="{{ route('campus') }}">Bibliothèque Universitaire &amp; Salles multimédia</a></li>
                                <li class="plan-site_lvl2"><a href="{{ route('contact') }}">Assistance aux étudiants</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer_ligne footer_ligne2">
            <ul id="footer_partenaires">
                @if(isset($footerPartenaires) && $footerPartenaires->count() > 0)
                    @foreach($footerPartenaires as $p)
                        <li>
                            <a href="{{ $p->url ?? route('entreprises') }}" title="{{ $p->name }}" target="{{ $p->url ? '_blank' : '_self' }}" rel="noopener">
                                <img src="{{ $p->image_url }}" alt="{{ $p->name }}" style="max-height: 48px; width: auto; vertical-align: middle;">
                            </a>
                        </li>
                    @endforeach
                @else
                    <li>
                        <a href="{{ route('entreprises') }}" title="BGFI Bank"><img src="{{ asset('assets/images/partners/bgfi.png') }}" alt="BGFI Bank" style="max-height: 48px; width: auto; vertical-align: middle;"></a>
                    </li>
                    <li>
                        <a href="{{ route('entreprises') }}" title="CNSS Gabon"><img src="{{ asset('assets/images/partners/cnss.png') }}" alt="CNSS Gabon" style="max-height: 44px; width: auto; vertical-align: middle;"></a>
                    </li>
                    <li>
                        <a href="{{ route('entreprises') }}" title="Union Gabonaise de Banque"><img src="{{ asset('assets/images/partners/ugb.png') }}" alt="Union Gabonaise de Banque" style="max-height: 44px; width: auto; vertical-align: middle;"></a>
                    </li>
                    <li>
                        <a href="{{ route('entreprises') }}" title="TotalEnergies"><img src="{{ asset('assets/images/partners/total.jpeg') }}" alt="TotalEnergies" style="max-height: 48px; width: auto; vertical-align: middle;"></a>
                    </li>
                    <li>
                        <a href="{{ route('entreprises') }}" title="Airtel Gabon"><img src="{{ asset('assets/images/partners/airtel.png') }}" alt="Airtel Gabon" style="max-height: 40px; width: auto; vertical-align: middle;"></a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="footer_ligne footer_ligne3">
            <ul id="menu_mentionslegales">
                <li><a href="{{ route('formations.index') }}">Carrières et formations</a></li>
                <li><a href="{{ route('contact') }}">Contactez-nous</a></li>
                <li><a href="{{ route('campus') }}">Plan d'accès</a></li>
                <li><a href="{{ route('contact') }}">Assistance &amp; Support</a></li>
                <li><a href="{{ route('admin.login') }}" style="color: #cbd5e1; font-weight: 600;"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="vertical-align: middle; margin-right: 3px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>Administration</a></li>
                <li>
                    <a href="{{ route('home') }}" title="Enseignement Supérieur Gabonais">
                        <img src="{{ asset('assets/images/insg-logo.png') }}" alt="Enseignement Supérieur Gabonais"/>
                    </a>
                </li>
                <li>
                    <a href="{{ route('home') }}" title="INSG Excellence">
                        <img src="{{ asset('assets/images/logo-hrs4r-blanc-footer_1578490239225-png.png') }}" alt="INSG Gabon"/>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</footer>


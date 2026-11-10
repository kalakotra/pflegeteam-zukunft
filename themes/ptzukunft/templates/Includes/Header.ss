<% with $SiteConfig %>
<div class="topbar d-none d-md-block" role="region" aria-label="<%t App.QuickInfo 'Adresse, Bürozeiten und Jobs' %>">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
        <ul class="topbar__info list-unstyled d-flex flex-wrap gap-4 mb-0">
            <% if $Street %><li><% include Icon Name='map', Class='icon-sm' %>$Street, $PostalCode $City</li><% end_if %>
            <% if $OpeningHoursGrouped %><li><% include Icon Name='clock', Class='icon-sm' %><%t App.Office 'Büro' %> <% loop $OpeningHoursGrouped %><% if not $IsFirst %> · <% end_if %>$Label $Times<% end_loop %></li><% end_if %>
        </ul>
        <% if $HiringBadge && $Top.CareerPage %>
        <a class="topbar__jobs" href="$Top.CareerPage.Link"><span class="badge text-bg-accent">$HiringBadge</span><% if $HiringText %> $HiringText<% end_if %> <% include Icon Name='arrow', Class='icon-sm' %></a>
        <% end_if %>
    </div>
</div>
<% end_with %>
<header class="site-header" data-sticky-header>
    <nav class="navbar navbar-expand-lg" aria-label="<%t App.MainNav 'Hauptnavigation' %>">
        <div class="container">
            <a class="navbar-brand" href="$BaseHref" rel="home">
                <img src="$resourceURL('themes/ptzukunft/images/logo.svg')" alt="$SiteConfig.Title.ATT – <%t App.Home 'Startseite' %>" width="227" height="60" class="site-header__logo">
            </a>
            <div class="d-flex align-items-center gap-2 d-lg-none">
                <% if $SiteConfig.Phone %><a class="btn btn-outline-primary btn-icon" href="$SiteConfig.PhoneLink" aria-label="<%t App.CallUs 'Anrufen: {phone}' phone=$SiteConfig.Phone %>"><% include Icon Name='phone' %></a><% end_if %>
                <button class="btn btn-light btn-icon" type="button" data-bs-toggle="offcanvas" data-bs-target="#site-nav" aria-controls="site-nav" aria-label="<%t App.OpenMenu 'Menü öffnen' %>">
                    <% include Icon Name='menu' %>
                </button>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="site-nav" aria-labelledby="site-nav-label">
                <div class="offcanvas-header">
                    <p class="offcanvas-title h5 mb-0" id="site-nav-label"><%t App.Menu 'Menü' %></p>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="<%t App.CloseMenu 'Menü schließen' %>"></button>
                </div>
                <div class="offcanvas-body align-items-lg-center">
                    <% include Navigation %>
                    <div class="site-header__actions d-flex flex-column flex-lg-row align-items-lg-center gap-3 ms-lg-4 mt-4 mt-lg-0">
                        <% if $SiteConfig.Phone %><a class="site-header__phone d-none d-xl-inline-flex" href="$SiteConfig.PhoneLink"><% include Icon Name='phone', Class='icon-sm' %>$SiteConfig.Phone</a><% end_if %>
                        <% if $ContactPage %><a href="$ContactPage.Link" class="btn btn-primary"><%t App.RequestCare 'Pflege anfragen' %></a><% end_if %>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

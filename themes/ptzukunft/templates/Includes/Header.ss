<header class="site-header" data-sticky-header>
    <nav class="navbar navbar-expand-lg" aria-label="<%t App.MainNav 'Hauptnavigation' %>">
        <div class="container">
            <a class="navbar-brand" href="$BaseHref" rel="home">
                <img src="$resourceURL('themes/ptzukunft/images/logo.svg')" alt="$SiteConfig.Title.ATT – <%t App.Home 'Startseite' %>" width="212" height="56" class="site-header__logo">
            </a>
            <button class="navbar-toggler-clean d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#site-nav" aria-controls="site-nav" aria-label="<%t App.OpenMenu 'Menü öffnen' %>">
                <% include Icon Name='menu' %>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="site-nav" aria-labelledby="site-nav-label">
                <div class="offcanvas-header">
                    <p class="offcanvas-title h5 mb-0" id="site-nav-label"><%t App.Menu 'Menü' %></p>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="<%t App.CloseMenu 'Menü schließen' %>"></button>
                </div>
                <div class="offcanvas-body align-items-lg-center">
                    <% include Navigation %>
                    <% if $SiteConfig.Phone %><a class="site-header__phone" href="$SiteConfig.PhoneLink">$SiteConfig.Phone</a><% end_if %>
                </div>
            </div>
        </div>
    </nav>
</header>

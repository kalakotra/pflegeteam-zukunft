<footer class="site-footer">
    <div class="container">
        <div class="site-footer__main">
            <img src="$resourceURL('themes/ptzukunft/images/logo.svg')" alt="$SiteConfig.Title.ATT" width="167" height="44" class="site-footer__logo" loading="lazy">
            <nav aria-label="<%t App.FooterNav 'Fußzeile' %>">
                <ul class="site-footer__links list-unstyled">
                    <% loop $Menu(1) %><li><a href="$Link">$MenuTitle</a></li><% end_loop %>
                    <% with $Page('impressum') %><li><a href="$Link">$MenuTitle</a></li><% end_with %>
                    <% with $Page('datenschutz') %><li><a href="$Link">$MenuTitle</a></li><% end_with %>
                </ul>
            </nav>
        </div>
        <p class="site-footer__meta">&copy; $Now.Year $SiteConfig.Title<% if $SiteConfig.FooterText %> · $SiteConfig.FooterText<% end_if %></p>
    </div>
</footer>

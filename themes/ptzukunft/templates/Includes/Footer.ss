<footer class="site-footer" data-bs-theme="dark">
    <div class="container">
        <div class="row g-4 g-lg-5 site-footer__main">
            <% with $SiteConfig %>
            <div class="col-sm-6 col-lg-4">
                <img src="$resourceURL('themes/ptzukunft/images/logo-light.svg')" alt="$Title.ATT" width="227" height="60" class="site-footer__logo" loading="lazy">
                <% if $FooterText %><p class="mt-3 mb-0">$FooterText</p><% end_if %>
                <% if $FooterSeal.exists %>
                    <% if $FooterSealLink.exists %><a href="$FooterSealLink.URL" class="d-inline-block mt-3"<% if $FooterSealLink.OpenInNew %> target="_blank" rel="noopener"<% end_if %>><% end_if %>
                    <% with $FooterSeal.ScaleMaxWidth(160) %><img src="$URL" width="$Width" height="$Height" alt="$Up.FooterSeal.Title.ATT" loading="lazy" class="site-footer__seal"><% end_with %>
                    <% if $FooterSealLink.exists %></a><% end_if %>
                <% end_if %>
            </div>
            <div class="col-sm-6 col-lg-3">
                <h2 class="site-footer__title"><%t App.Contact 'Kontakt' %></h2>
                <address class="mb-3">
                    $Title<br>
                    $Street<br>
                    $PostalCode $City
                </address>
                <ul class="list-unstyled site-footer__contact">
                    <% if $Phone %><li><a href="$PhoneLink"><% include Icon Name='phone', Class='icon-sm' %>$Phone</a></li><% end_if %>
                    <% if $Email %><li><a href="mailto:$Email"><% include Icon Name='mail', Class='icon-sm' %>$Email</a></li><% end_if %>
                    <% if $RouteURL %><li><a href="$RouteURL" target="_blank" rel="noopener"><% include Icon Name='map', Class='icon-sm' %><%t App.PlanRoute 'Route planen' %></a></li><% end_if %>
                </ul>
            </div>
            <% end_with %>
            <% with $Page('leistungen') %>
            <div class="col-sm-6 col-lg-3">
                <h2 class="site-footer__title"><a href="$Link">$MenuTitle</a></h2>
                <ul class="list-unstyled site-footer__links">
                    <% loop $Children %>
                    <li><a href="$Link">$MenuTitle</a></li>
                    <% end_loop %>
                </ul>
            </div>
            <% end_with %>
            <div class="col-sm-6 col-lg-2">
                <h2 class="site-footer__title"><%t App.Office 'Büro' %></h2>
                <% with $SiteConfig %><% include OpeningHours %><% end_with %>
                <% if $CareerPage %>
                <a class="site-footer__jobs" href="$CareerPage.Link"><%t App.JobsWithUs 'Jobs bei uns' %> <% include Icon Name='arrow', Class='icon-sm' %></a>
                <% end_if %>
            </div>
        </div>
        <div class="site-footer__bottom d-flex flex-wrap justify-content-between gap-3">
            <p class="mb-0">&copy; $Now.Year $SiteConfig.Title</p>
            <ul class="list-unstyled d-flex flex-wrap gap-4 mb-0">
                <% with $Page('impressum') %><li><a href="$Link">$MenuTitle</a></li><% end_with %>
                <% with $Page('datenschutz') %><li><a href="$Link">$MenuTitle</a></li><% end_with %>
            </ul>
        </div>
    </div>
</footer>

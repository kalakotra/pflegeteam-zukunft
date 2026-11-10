$HeaderElement

<div class="container column-layout">
    <div class="row g-4 g-lg-5">
        <div class="col-lg-8 column-layout__main">
            <% loop $MainElements %>
                $Me
            <% end_loop %>
        </div>
        <aside class="col-lg-4" aria-label="<%t App.ServiceSidebar 'Weitere Informationen' %>">
            <div class="side-stack">
                <% if $SiblingServices %>
                <nav class="side-nav card" aria-labelledby="service-nav-title">
                    <h2 class="side-nav__title h5" id="service-nav-title"><%t App.OurServices 'Unsere Leistungen' %></h2>
                    <ul class="list-unstyled mb-0">
                        <% loop $SiblingServices %>
                        <li><a href="$Link" class="<% if $isCurrent %>active<% end_if %>"<% if $isCurrent %> aria-current="page"<% end_if %>>$MenuTitle</a></li>
                        <% end_loop %>
                    </ul>
                </nav>
                <% end_if %>
                <% with $SiteConfig %>
                <div class="side-cta card text-bg-primary" data-bs-theme="dark">
                    <div class="card-body">
                        <h2 class="h4"><%t App.RequestCare 'Pflege anfragen' %></h2>
                        <p><%t App.FreeAdvice 'Kostenlose Beratung – wir melden uns schnell zurück.' %></p>
                        <% include OpeningHours %>
                        <% if $Phone %><a href="$PhoneLink" class="btn btn-light w-100 mt-3"><% include Icon Name='phone', Class='icon-sm' %>$Phone</a><% end_if %>
                    </div>
                </div>
                <% end_with %>
                <% if $CareerPage && $SiteConfig.HiringBadge %>
                <a class="side-jobs card" href="$CareerPage.Link">
                    <span class="side-jobs__badge">$SiteConfig.HiringBadge</span>
                    <span class="side-jobs__title"><% if $SiteConfig.HiringText %>$SiteConfig.HiringText<% else %>$CareerPage.MenuTitle<% end_if %></span>
                    <span class="side-jobs__more"><%t App.ViewJobs 'Offene Stellen ansehen' %> <% include Icon Name='arrow', Class='icon-sm' %></span>
                </a>
                <% end_if %>
            </div>
        </aside>
    </div>
</div>

$BottomArea

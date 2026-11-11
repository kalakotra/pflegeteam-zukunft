$HeaderElement

<div class="container column-layout">
    <div class="row g-4 g-lg-5">
        <div class="col-lg-7 column-layout__main">
            <% loop $MainElements %>
                $Me
            <% end_loop %>
        </div>
        <aside class="col-lg-4 offset-lg-1" aria-label="<%t App.ServiceSidebar 'Weitere Informationen' %>">
            <div class="side-stack">
                <% if $SiblingServices %>
                <nav class="side-nav" aria-labelledby="service-nav-title">
                    <h2 class="side-nav__title" id="service-nav-title"><%t App.OurServices 'Unsere Leistungen' %></h2>
                    <ul class="list-unstyled mb-0">
                        <% loop $SiblingServices %>
                        <li><a href="$Link"<% if $isCurrent %> class="active" aria-current="page"<% end_if %>>$MenuTitle</a></li>
                        <% end_loop %>
                    </ul>
                </nav>
                <% end_if %>
                <% with $SiteConfig %>
                <div class="side-box">
                    <h2 class="side-box__title"><%t App.QuestionsCare 'Fragen zur Pflege?' %></h2>
                    <p class="mb-2"><%t App.FreeAdviceShort 'Kostenlose Beratung' %><% loop $OpeningHoursGrouped %>, $Label $Times<% end_loop %>.</p>
                    <% if $Phone %><a class="side-box__phone" href="$PhoneLink">$Phone</a><% end_if %>
                </div>
                <% end_with %>
                <% if $CareerPage && $SiteConfig.HiringBadge %>
                <p class="side-hiring"><span class="kicker">$SiteConfig.HiringBadge:</span> <a href="$CareerPage.Link">$CareerPage.MenuTitle</a></p>
                <% end_if %>
            </div>
        </aside>
    </div>
</div>

<% loop $BottomArea.ElementControllers %>$Me<% end_loop %>

$HeaderElement

<div class="container column-layout">
    <div class="row g-4 g-lg-5">
        <div class="col-lg-7 column-layout__main">
            <% if $JobDescription %>
            <div class="typography job-description">$JobDescription</div>
            <% end_if %>
            <% loop $MainElements %>
                $Me
            <% end_loop %>
        </div>
        <aside class="col-lg-4 offset-lg-1" aria-label="<%t App.JobFacts 'Eckdaten der Stelle' %>">
            <div class="side-stack">
                <% if $Facts %>
                <div class="side-facts">
                    <h2 class="side-nav__title"><%t App.JobFacts 'Eckdaten der Stelle' %></h2>
                    <dl class="mb-0">
                        <% loop $Facts %>
                        <div class="side-facts__row"><dt>$Label</dt><dd>$Value</dd></div>
                        <% end_loop %>
                    </dl>
                </div>
                <% end_if %>
                <div class="side-box">
                    <h2 class="side-box__title"><%t App.ApplyNow 'Jetzt bewerben' %></h2>
                    <p class="mb-3"><%t App.ApplyFast 'In 2 Minuten – ohne Anschreiben.' %></p>
                    <% if $ApplyLink %><a href="$ApplyLink" class="btn btn-primary"><%t App.ToApplication 'Zur Kurzbewerbung' %></a><% end_if %>
                    <% if $SiteConfig.Phone %><p class="mt-3 mb-0"><%t App.OrCall 'Oder anrufen:' %> <a class="side-box__phone d-inline" href="$SiteConfig.PhoneLink">$SiteConfig.Phone</a></p><% end_if %>
                </div>
                <% if $SiblingJobs %>
                <nav class="side-nav" aria-labelledby="jobs-nav-title">
                    <h2 class="side-nav__title" id="jobs-nav-title"><%t App.MoreJobs 'Weitere Stellen' %></h2>
                    <ul class="list-unstyled mb-0">
                        <% loop $SiblingJobs %><li><a href="$Link">$MenuTitle</a></li><% end_loop %>
                    </ul>
                </nav>
                <% end_if %>
            </div>
        </aside>
    </div>
</div>

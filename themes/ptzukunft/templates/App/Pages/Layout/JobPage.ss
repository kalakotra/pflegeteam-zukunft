$HeaderElement

<div class="container column-layout">
    <div class="row g-4 g-lg-5">
        <div class="col-lg-8 column-layout__main">
            <% if $JobDescription %>
            <div class="typography job-description">$JobDescription</div>
            <% end_if %>
            <% loop $MainElements %>
                $Me
            <% end_loop %>
        </div>
        <aside class="col-lg-4" aria-label="<%t App.JobFacts 'Eckdaten der Stelle' %>">
            <div class="side-stack">
                <% if $Facts %>
                <div class="card job-facts">
                    <div class="card-body">
                        <h2 class="h5"><%t App.JobFacts 'Eckdaten der Stelle' %></h2>
                        <dl class="job-facts__list mb-0">
                            <% loop $Facts %>
                            <div class="job-facts__row">
                                <dt><% include Icon Name=$Key, Class='icon-sm' %>$Label</dt>
                                <dd>$Value</dd>
                            </div>
                            <% end_loop %>
                        </dl>
                    </div>
                </div>
                <% end_if %>
                <div class="side-cta card text-bg-accent" data-bs-theme="dark">
                    <div class="card-body">
                        <h2 class="h4"><%t App.ApplyNow 'Jetzt bewerben' %></h2>
                        <p><%t App.ApplyFast 'In 2 Minuten – ohne Anschreiben.' %></p>
                        <% if $ApplyLink %><a href="$ApplyLink" class="btn btn-light w-100"><%t App.ToApplication 'Zur Kurzbewerbung' %></a><% end_if %>
                        <% if $SiteConfig.Phone %><a href="$SiteConfig.PhoneLink" class="btn btn-outline-light w-100 mt-2"><% include Icon Name='phone', Class='icon-sm' %>$SiteConfig.Phone</a><% end_if %>
                    </div>
                </div>
                <% if $SiblingJobs %>
                <nav class="side-nav card" aria-labelledby="jobs-nav-title">
                    <h2 class="side-nav__title h5" id="jobs-nav-title"><%t App.MoreJobs 'Weitere Stellen' %></h2>
                    <ul class="list-unstyled mb-0">
                        <% loop $SiblingJobs %><li><a href="$Link">$MenuTitle</a></li><% end_loop %>
                    </ul>
                </nav>
                <% end_if %>
            </div>
        </aside>
    </div>
</div>

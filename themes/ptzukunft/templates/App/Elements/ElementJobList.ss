<div class="job-list">
    <% if $Heading || $Intro %>
    <header class="section-head">
        <% if $Eyebrow %><p class="eyebrow">$Eyebrow</p><% end_if %>
        $Heading('section-head__title')
        <% if $Intro %><p class="section-head__intro">$Intro</p><% end_if %>
    </header>
    <% end_if %>
    <% if $Jobs %>
    <ul class="list-unstyled d-grid gap-3 mb-0">
        <% loop $Jobs %>
        <li>
            <article class="job-card card">
                <div class="card-body">
                    <div class="job-card__main">
                        <$Up.ChildHeadingTag class="job-card__title"><a class="stretched-link" href="$Link">$Title</a></$Up.ChildHeadingTag>
                        <% if $Teaser %><p class="job-card__teaser">$Teaser</p><% end_if %>
                        <ul class="job-card__facts list-unstyled">
                            <% loop $Facts %><li>$Value</li><% end_loop %>
                        </ul>
                    </div>
                    <span class="btn btn-primary job-card__cta" aria-hidden="true"><%t App.DetailsApply 'Details & bewerben' %></span>
                </div>
            </article>
        </li>
        <% end_loop %>
    </ul>
    <% else %>
    <p class="job-list__empty"><%t App.NoJobs 'Aktuell keine Ausschreibung – Initiativbewerbungen sind jederzeit willkommen.' %></p>
    <% end_if %>
</div>

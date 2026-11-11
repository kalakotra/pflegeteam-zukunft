<div class="feature-list feature-list--list feature-list--side job-list">
    <header class="feature-list__head">
        $Heading('section-title')
        <% if $Intro %><p class="feature-list__intro">$Intro</p><% end_if %>
    </header>
    <% if $Jobs %>
    <ul class="feature-list__items list-unstyled">
        <% loop $Jobs %>
        <li class="feature-list__item">
            <a class="feature-list__link" href="$Link">
                <span>
                    <$Up.ChildHeadingTag class="feature-list__title">$Title</$Up.ChildHeadingTag>
                    <span class="feature-list__text"><% loop $Facts.Limit(3) %><% if not $IsFirst %> · <% end_if %>$Value<% end_loop %></span>
                </span>
                <span class="feature-list__arrow" aria-hidden="true">→</span>
            </a>
        </li>
        <% end_loop %>
    </ul>
    <% else %>
    <p class="job-list__empty"><%t App.NoJobs 'Aktuell keine Ausschreibung – Initiativbewerbungen sind jederzeit willkommen.' %></p>
    <% end_if %>
</div>

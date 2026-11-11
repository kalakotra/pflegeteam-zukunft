$HeaderElement

<section class="element section-space" aria-labelledby="services-heading">
    <div class="container">
        <div class="feature-list feature-list--list feature-list--side">
            <header class="feature-list__head">
                <h2 class="section-title" id="services-heading"><%t App.OurServices 'Unsere Leistungen' %></h2>
            </header>
            <ul class="feature-list__items list-unstyled">
                <% loop $Children %>
                <li class="feature-list__item">
                    <a class="feature-list__link" href="$Link">
                        <span>
                            <h3 class="feature-list__title">$MenuTitle</h3>
                            <% if $Teaser %><span class="feature-list__text">$Teaser</span><% end_if %>
                        </span>
                        <span class="feature-list__arrow" aria-hidden="true">→</span>
                    </a>
                </li>
                <% end_loop %>
            </ul>
        </div>
    </div>
</section>

<% loop $MainElements %>
    $Me
<% end_loop %>

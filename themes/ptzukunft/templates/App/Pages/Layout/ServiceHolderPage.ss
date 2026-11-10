$HeaderElement

<% if $Services %>
<section class="section py-5 py-lg-6" aria-labelledby="services-heading">
    <div class="container">
        <h2 id="services-heading" class="visually-hidden">$Title</h2>
        <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-lg-3">
            <% loop $Services %>
            <div class="col">
                <article class="card feature-card feature-card--image h-100">
                    <% if $TeaserImage.exists %>
                    <% with $TeaserImage.FillMax(640,440) %><img src="$URL" width="$Width" height="$Height" alt="$Up.TeaserImageAltText.ATT" class="card-img-top" loading="lazy"><% end_with %>
                    <% end_if %>
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title h5"><a href="$Link" class="stretched-link feature-card__link">$MenuTitle</a></h3>
                        <% if $Teaser %><p class="card-text flex-grow-1">$Teaser</p><% end_if %>
                        <span class="feature-card__more" aria-hidden="true"><%t App.MoreAbout 'Mehr zu {title}' title=$MenuTitle %> <% include Icon Name='arrow', Class='icon-sm' %></span>
                    </div>
                </article>
            </div>
            <% end_loop %>
        </div>
    </div>
</section>
<% end_if %>

<% loop $MainElements %>
    $Me
<% end_loop %>

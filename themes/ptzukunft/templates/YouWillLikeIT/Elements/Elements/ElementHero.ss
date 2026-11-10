<div class="hero hero--$Variant<% if $Image.exists %> hero--has-image<% end_if %>">
    <div class="row g-4 g-lg-5 align-items-center">
        <div class="<% if $Image.exists %>col-lg-7<% else %>col-lg-9<% end_if %> hero__body">
            <% if $ShowBreadcrumbs && $Variant != 'home' %>$Page.Breadcrumbs<% end_if %>
            <% if $Eyebrow %><p class="eyebrow">$Eyebrow</p><% end_if %>
            $Heading('hero__title')
            <% if $Lead %><p class="hero__lead lead">$Lead</p><% end_if %>
            <% if $Variant == 'accent' %><% include CtaButtons Tone='accent', Class='mt-4' %><% else %><% include CtaButtons Tone='light', Class='mt-4' %><% end_if %>
            <% if $Variant == 'home' && $TrustItemList %>
            <ul class="hero__trust list-unstyled">
                <% loop $TrustItemList %>
                <li><span class="hero__trust-icon"><% include Icon Name=$Icon %></span>$Text</li>
                <% end_loop %>
            </ul>
            <% end_if %>
        </div>
        <% if $Image.exists %>
        <div class="col-lg-5 hero__media">
            <% with $Image.FillMax(960,1000) %>
            <img class="hero__image" src="$URL" width="$Width" height="$Height" alt="$Up.ImageAltText.ATT"<% if $Up.IsFirstElement %> fetchpriority="high"<% else %> loading="lazy"<% end_if %> decoding="async">
            <% end_with %>
            <% if $HasTeaser %>
            <a class="hero-teaser" href="$TeaserLink.URL">
                <% if $TeaserBadge %><span class="hero-teaser__badge">$TeaserBadge</span><% end_if %>
                <span class="hero-teaser__title">$TeaserTitle</span>
                <% if $TeaserText %><span class="hero-teaser__text">$TeaserText</span><% end_if %>
                <span class="hero-teaser__more">$TeaserLink.Title <% include Icon Name='arrow', Class='icon-sm' %></span>
            </a>
            <% end_if %>
        </div>
        <% end_if %>
    </div>
</div>

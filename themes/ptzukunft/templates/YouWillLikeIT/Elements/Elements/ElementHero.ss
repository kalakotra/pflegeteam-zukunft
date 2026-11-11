<% if $Variant == 'image' && $Image.exists %>
<div class="hero hero--image">
    <% with $Image %>
    <picture class="hero__picture">
        <source media="(max-width: 767.98px)" srcset="$FillMax(800,640).URL" width="$FillMax(800,640).Width" height="$FillMax(800,640).Height">
        <img class="hero__image" src="$FillMax(1920,820).URL" width="$FillMax(1920,820).Width" height="$FillMax(1920,820).Height" alt="$Up.ImageAltText.ATT"<% if $Up.IsFirstElement %> fetchpriority="high"<% else %> loading="lazy"<% end_if %> decoding="async">
    </picture>
    <% end_with %>
    <div class="container hero__container">
        <div class="hero__panel">
            <% if $ShowBreadcrumbs %>$Page.Breadcrumbs<% end_if %>
            $Heading('hero__title')
            <% if $Lead %><p class="hero__lead">$Lead</p><% end_if %>
            <% include TextLinks Class='mb-0' %>
        </div>
    </div>
</div>
<% else %>
<div class="container">
    <div class="hero hero--compact row g-4 g-lg-5 align-items-center">
        <div class="<% if $Image.exists %>col-lg-6<% else %>col-lg-9<% end_if %>">
            <% if $ShowBreadcrumbs %>$Page.Breadcrumbs<% end_if %>
            $Heading('hero__title')
            <% if $Lead %><p class="hero__lead">$Lead</p><% end_if %>
            <% include TextLinks Class='mb-0' %>
        </div>
        <% if $Image.exists %>
        <div class="col-lg-5 offset-lg-1">
            <% with $Image.FillMax(960,820) %>
            <img class="hero__image" src="$URL" width="$Width" height="$Height" alt="$Up.ImageAltText.ATT"<% if $Up.IsFirstElement %> fetchpriority="high"<% else %> loading="lazy"<% end_if %> decoding="async">
            <% end_with %>
        </div>
        <% end_if %>
    </div>
</div>
<% end_if %>

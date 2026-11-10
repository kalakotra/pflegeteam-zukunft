<div class="text-media text-media--image-$ImagePosition<% if $HasCard %> text-media--card<% end_if %>">
    <div class="row g-4 g-lg-5 align-items-center">
        <% if $HasCard || $Image.exists %>
        <div class="col-lg-6 col-xl-5 text-media__media<% if $ImagePosition == 'right' %> order-lg-2 offset-xl-1<% end_if %>">
            <% if $HasCard %>
            <div class="highlight-card card">
                <div class="card-body">
                    <% if $CardEyebrow %><p class="highlight-card__eyebrow">$CardEyebrow</p><% end_if %>
                    <p class="highlight-card__value"><span class="highlight-card__number">$CardValue</span><% if $CardLabel %> <span class="highlight-card__label">$CardLabel</span><% end_if %></p>
                    <% if $CardRowList %>
                    <dl class="highlight-card__rows">
                        <% loop $CardRowList %><div><dt>$Label</dt><dd>$Value</dd></div><% end_loop %>
                    </dl>
                    <% end_if %>
                    <% if $CardLink.exists %><a class="highlight-card__link" href="$CardLink.URL"<% if $CardLink.OpenInNew %> target="_blank" rel="noopener"<% end_if %>>$CardLink.Title</a><% end_if %>
                </div>
            </div>
            <% else %>
            <figure class="text-media__figure mb-0">
                <% with $Image.FillMax(1040,880) %>
                <img class="text-media__image" src="$URL" width="$Width" height="$Height" alt="$Up.ImageAltText.ATT"<% if $Up.IsFirstElement %> fetchpriority="high"<% else %> loading="lazy"<% end_if %> decoding="async">
                <% end_with %>
            </figure>
            <% end_if %>
        </div>
        <% end_if %>
        <div class="<% if $HasCard || $Image.exists %>col-lg-6<% if $ImagePosition == 'left' %> offset-xl-1<% end_if %><% else %>col-lg-10 col-xl-8<% end_if %> text-media__body">
            <% if $Eyebrow %><p class="eyebrow">$Eyebrow</p><% end_if %>
            $Heading('text-media__title')
            <% if $Content %><div class="typography">$Content</div><% end_if %>
            <% if $ChipList %>
            <ul class="chips list-unstyled">
                <% loop $ChipList %><li>$Text</li><% end_loop %>
            </ul>
            <% end_if %>
            <% if $IsDarkSection %><% include CtaButtons Tone='dark', Class='mt-4' %><% else %><% include CtaButtons Tone='light', Class='mt-4' %><% end_if %>
        </div>
    </div>
</div>

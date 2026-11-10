<div class="feature-grid feature-grid--$Variant">
    <% if $Heading || $Intro %>
    <header class="section-head section-head--$HeaderAlign">
        <div class="section-head__text">
            <% if $Eyebrow %><p class="eyebrow">$Eyebrow</p><% end_if %>
            $Heading('section-head__title')
        </div>
        <% if $Intro %><p class="section-head__intro">$Intro</p><% end_if %>
    </header>
    <% end_if %>
    <% if $SortedItems.exists %>
        <% if $Variant == 'steps' %>
        <ol class="row g-4 list-unstyled mb-0 $ColumnClass">
            <% loop $SortedItems %>
            <li class="col">
                <div class="feature-step card h-100">
                    <span class="feature-step__no" aria-hidden="true">$Pos</span>
                    <$Up.ChildHeadingTag class="feature-step__title">$Title</$Up.ChildHeadingTag>
                    <% if $Text %><p class="mb-0">$Text</p><% end_if %>
                </div>
            </li>
            <% end_loop %>
        </ol>
        <% else_if $Variant == 'check-list' %>
        <ul class="list-check feature-checks mb-0">
            <% loop $SortedItems %>
            <li><strong>$Title</strong><% if $Text %> – $Text<% end_if %></li>
            <% end_loop %>
        </ul>
        <% else %>
        <ul class="row g-4 list-unstyled mb-0 $ColumnClass">
            <% loop $SortedItems %>
            <li class="col">
                <article class="card feature-card feature-card--$Up.Variant h-100<% if $Link.exists %> feature-card--linked<% end_if %>">
                    <% if $Up.Variant == 'image-cards' && $Image.exists %>
                        <% with $Image.FillMax(800,500) %>
                        <img class="card-img-top" src="$URL" width="$Width" height="$Height" alt="$Up.ImageAltText.ATT" loading="lazy" decoding="async">
                        <% end_with %>
                    <% end_if %>
                    <div class="card-body d-flex flex-column">
                        <% if $Up.Variant == 'icon-cards' && $Icon %><span class="feature-card__icon"><% include Icon Name=$Icon %></span><% end_if %>
                        <$Up.ChildHeadingTag class="feature-card__title"><% if $Link.exists %><a class="stretched-link" href="$Link.URL"<% if $Link.OpenInNew %> target="_blank" rel="noopener"<% end_if %>>$Title</a><% else %>$Title<% end_if %></$Up.ChildHeadingTag>
                        <% if $Text %><p class="feature-card__text">$Text</p><% end_if %>
                        <% if $Link.exists %><span class="feature-card__more" aria-hidden="true">$Link.Title <% include Icon Name='arrow', Class='icon-sm' %></span><% end_if %>
                    </div>
                </article>
            </li>
            <% end_loop %>
        </ul>
        <% end_if %>
    <% end_if %>
    <% if $IsDarkSection %><% include CtaButtons Tone='dark', Class='mt-5' %><% else %><% include CtaButtons Tone='light', Class='mt-5' %><% end_if %>
</div>

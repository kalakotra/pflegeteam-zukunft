<div class="feature-list feature-list--$Variant feature-list--$Layout">
    <% if $Heading || $Intro %>
    <header class="feature-list__head">
        $Heading('section-title')
        <% if $Intro %><p class="feature-list__intro">$Intro</p><% end_if %>
        <% include TextLinks Class='mb-0' %>
    </header>
    <% end_if %>
    <% if $SortedItems.exists %>
    <ul class="feature-list__items list-unstyled">
        <% loop $SortedItems %>
        <li class="feature-list__item">
            <% if $Link.exists %>
            <a class="feature-list__link" href="$Link.URL"<% if $Link.OpenInNew %> target="_blank" rel="noopener"<% end_if %>>
                <span>
                    <$Up.ChildHeadingTag class="feature-list__title">$Title</$Up.ChildHeadingTag>
                    <% if $Text %><span class="feature-list__text">$Text</span><% end_if %>
                </span>
                <span class="feature-list__arrow" aria-hidden="true">→</span>
            </a>
            <% else %>
            <$Up.ChildHeadingTag class="feature-list__title">$Title</$Up.ChildHeadingTag>
            <% if $Text %><span class="feature-list__text">$Text</span><% end_if %>
            <% end_if %>
        </li>
        <% end_loop %>
    </ul>
    <% end_if %>
</div>

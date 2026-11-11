<%-- Element links as quiet text links (underlined, arrow-free). Primary = first link. --%>
<% if $SortedCTALinks.exists %>
<p class="text-links<% if $Class %> $Class<% end_if %>">
    <% loop $SortedCTALinks %>
    <a class="text-link" href="$URL"<% if $OpenInNew %> target="_blank" rel="noopener"<% end_if %>>$Title</a>
    <% end_loop %>
</p>
<% end_if %>

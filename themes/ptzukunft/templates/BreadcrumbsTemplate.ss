<% if $Pages %>
<nav class="breadcrumbs" aria-label="<%t App.Breadcrumbs 'Brotkrumen' %>">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="$BaseHref"><%t App.Home 'Startseite' %></a></li>
        <% loop $Pages %>
        <% if $IsLast %>
        <li class="breadcrumb-item active" aria-current="page">$MenuTitle</li>
        <% else %>
        <li class="breadcrumb-item"><a href="$Link">$MenuTitle</a></li>
        <% end_if %>
        <% end_loop %>
    </ol>
</nav>
<% end_if %>

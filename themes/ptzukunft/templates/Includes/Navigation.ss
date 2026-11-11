<ul class="navbar-nav ms-lg-auto">
    <% loop $Menu(1) %>
    <% if $Children && not $IsCareerPage %>
    <li class="nav-item dropdown">
        <div class="nav-split">
            <a class="nav-link<% if $LinkOrSection == 'section' %> active<% end_if %>" href="$Link"<% if $isCurrent %> aria-current="page"<% end_if %>>$MenuTitle</a>
            <button class="nav-link dropdown-toggle dropdown-toggle-split" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden"><%t App.SubmenuFor 'Untermenü {title}' title=$MenuTitle %></span>
            </button>
            <ul class="dropdown-menu">
                <% loop $Children %>
                <li><a class="dropdown-item<% if $isCurrent %> active<% end_if %>" href="$Link"<% if $isCurrent %> aria-current="page"<% end_if %>>$MenuTitle</a></li>
                <% end_loop %>
            </ul>
        </div>
    </li>
    <% else %>
    <li class="nav-item">
        <a class="nav-link<% if $LinkOrSection == 'section' %> active<% end_if %>" href="$Link"<% if $isCurrent %> aria-current="page"<% end_if %>>$MenuTitle</a>
    </li>
    <% end_if %>
    <% end_loop %>
</ul>

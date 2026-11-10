<%-- Mobile only (< 768px): call + jobs (recruiting is the secondary goal of the site). --%>
<div class="action-bar d-md-none" role="region" aria-label="<%t App.QuickActions 'Schnellzugriff' %>">
    <% if $SiteConfig.Phone %>
    <a href="$SiteConfig.PhoneLink" class="btn btn-outline-primary"><% include Icon Name='phone', Class='icon-sm' %><%t App.Call 'Anrufen' %></a>
    <% end_if %>
    <% if $CareerPage && $SiteConfig.HiringBadge %>
    <a href="$CareerPage.Link" class="btn btn-accent"><% include Icon Name='briefcase', Class='icon-sm' %><%t App.Jobs 'Jobs' %></a>
    <% else_if $ContactPage %>
    <a href="$ContactPage.Link" class="btn btn-primary"><% include Icon Name='mail', Class='icon-sm' %><%t App.Request 'Anfragen' %></a>
    <% end_if %>
</div>

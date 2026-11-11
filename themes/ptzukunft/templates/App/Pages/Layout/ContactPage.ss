$HeaderElement

<div class="container section-space contact-layout pt-0">
    <div class="row g-4 g-lg-5">
        <% with $SiteConfig %>
        <section class="col-lg-4" aria-labelledby="contact-details-title">
            <h2 class="section-title" id="contact-details-title"><%t App.ReachUs 'So erreichen Sie uns' %></h2>
            <dl class="contact-details">
                <% if $Phone %><div><dt><%t App.Phone 'Telefon' %></dt><dd><a class="contact-strip__phone" href="$PhoneLink">$Phone</a></dd></div><% end_if %>
                <div><dt><%t App.OfficeHours 'Bürozeiten' %></dt><dd><% include OpeningHours %></dd></div>
                <div><dt><%t App.Address 'Adresse' %></dt><dd>$Title<br>$Street<br>$PostalCode $City<% if $RouteURL %><br><a href="$RouteURL" target="_blank" rel="noopener"><%t App.PlanRoute 'Route planen' %></a><% end_if %></dd></div>
                <% if $Email %><div><dt><%t App.Email 'E-Mail' %></dt><dd><a href="mailto:$Email">$Email</a></dd></div><% end_if %>
                <% if $Fax %><div><dt><%t App.Fax 'Fax' %></dt><dd>$Fax</dd></div><% end_if %>
            </dl>
            <% if $MapEmbedURL %>
            <div class="map-consent" data-map-consent data-src="$MapEmbedURL.ATT" data-title="<%t App.MapTitle 'Karte: Anfahrt zum Pflegeteam Zukunft' %>">
                <p><%t App.MapConsent 'Beim Laden der Karte werden Daten an Google übertragen. Mehr dazu in der Datenschutzerklärung.' %></p>
                <button type="button" class="btn btn-outline-primary" data-map-consent-button><%t App.LoadMap 'Karte laden' %></button>
            </div>
            <% end_if %>
        </section>
        <% end_with %>
        <div class="col-lg-7 offset-lg-1">
            <% loop $MainElements %>
                $Me
            <% end_loop %>
        </div>
    </div>
</div>

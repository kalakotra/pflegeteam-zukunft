<% with $SiteConfig %>
<section class="contact-strip" aria-labelledby="contact-strip-title">
    <div class="container">
        <h2 class="contact-strip__title" id="contact-strip-title"><%t App.ReachUs 'So erreichen Sie uns' %></h2>
        <div class="row g-4 g-lg-5">
            <% if $Phone %>
            <div class="col-md-4">
                <p class="contact-strip__label"><%t App.Phone 'Telefon' %></p>
                <p class="mb-1"><a class="contact-strip__phone" href="$PhoneLink">$Phone</a></p>
                <% loop $OpeningHoursGrouped %><p class="mb-0">$Label $Times</p><% end_loop %>
            </div>
            <% end_if %>
            <div class="col-md-4">
                <p class="contact-strip__label"><%t App.Address 'Adresse' %></p>
                <address class="mb-1">$Title<br>$Street, $PostalCode $City</address>
                <% if $RouteURL %><a href="$RouteURL" target="_blank" rel="noopener"><%t App.PlanRoute 'Route planen' %></a><% end_if %>
            </div>
            <div class="col-md-4">
                <p class="contact-strip__label"><%t App.WriteUs 'Schreiben Sie uns' %></p>
                <% if $Email %><p class="mb-3"><a href="mailto:$Email">$Email</a></p><% end_if %>
                <% if $Top.ContactPage %><a class="btn btn-primary" href="$Top.ContactPage.Link"><%t App.RequestCare 'Pflege anfragen' %></a><% end_if %>
            </div>
        </div>
    </div>
</section>
<% end_with %>
